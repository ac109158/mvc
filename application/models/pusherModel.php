<?php
class PusherModel extends Model
{
    public function __construct()
	    {
		parent::__construct();
		require_once ('./inc/Pusher.php'); // this gets used in pretty much every function at some point
		}
		
		
		public function pusher_init() // not used at this point
		{
			$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
			return $pusher;
		}
		
	public function trigger_init() { // this recieves get requests that come directly from the user actions
	$channel = $_REQUEST['activity_channel'];
	$text = $_REQUEST['action_text'];
	$name = $_SESSION['name_of_user'];
	$type = $_REQUEST['activity_type'];
	$this->trigger_activity($channel, $text, $name, $type); // 
	exit;
	}

	public function trigger_activity($channel, $text, $name, $type) // this recieves trigger_inits, but is separated so it can be directly called from any of the models.  
	{
		require_once('inc/Activity.php');
		$activity = new Activity($type, $text, $name);
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		$pusher->trigger($channel, $type, $activity->getMessage());
		return true;
	}
	
	public function chain_activity($channel, $text, $name, $type,$pusher) // this function is passed a pusher object that already exists by notify_endpoint, the idea is to not have to use another web socket connection
	{ //At this point this is a separate function, in case this portion is reusable at some time in the future but could just be put directly into notify end_point 
		require_once('inc/Activity.php');
		$activity = new Activity($type, $text, $name);
		$activity = $activity->getMessage();
		$pusher->trigger($channel, $type, $activity);
		print_r($activity);

		$activity_id = $activity['id'];
		$author_id = $_SESSION['user_id'];
		$author_name = $activity['actor']['displayName'];
		$timestamp = $activity['published'];
		$date = date('mdy');
		$text = $activity['body'];
		$qry = "(activity_id, author_id, author_name, text, channel, timestamp, session_id) VALUES ('$activity_id', '$author_id', '$author_name' ,'$text','$channel', '$timestamp','$date')";
		$this->saveToDatabase('activity_stream', $qry);

		return true;
	}
	
	function getActionText($activity_type, $activity_data) // at this point this function no longer serves a purpose
	{
		  $action_text = 'just did something unrecognizable.';
		  switch($activity_type) 
		  {
		    case 'page-load':
		      $action_text = 'just navigated to the Activity Streams example page.';
		      break;
		    case 'test-event':
		      $action_text = 'just clicked the <em>Send Test</em> button.';
		      break;
		    case 'scroll':
		      $action_text = 'just scrolled to the '. $activity_data['position'] . ' of the page';
		      break;
		    case 'like':
		      $action_text = 'just liked: "'. $activity_data['text'] . '"';
		      break;
		  }
	return $action_text;
	}
	
	
	public function notify_endpoint($vars) // $vars[0] message, $vars[1] channel, $vars[2] method, $vars[3] name
	{  // this function recieves the input from the user from the notication center
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID); // init pusher object
		if ($vars[2] == 0 || $vars[2] == 2) // check to see if method was only notification or asked for both
		{  // since it is either specified to be only notification or both, it is okay to just trigger the notification at this point
			$message = Model::Sanitize($vars[0]); 
			$message .= "<br><br />Sent by: <strong>". $vars[3]. '</strong>'; // specify the author of the message
			$data = array('message' => $message); // format content as to what the pusher function expects
			$channel = $vars[1]; // assign the channel that the author specified the content should be sent to 
			$pusher->trigger($channel, 'notification', $data); //trigger notification to intended receipients
		}
		if ($vars[2] == 1 || $vars[2] == 2) // if true this means author intended the message to only be streamed or both
		{
			$this->chain_activity($vars[1], $vars[0], $vars[3], 'page-load', $pusher);  // since the message was intended to be streamed, it is okay to go trigger a stream activty
		}
		return true;
	}
	
	public function pusher_auth() {	
		$name = $_SESSION['name_of_user']; // chose the way to get this get,post session ...etc
		$user_id = $_SESSION['user_id']; // chose the way to get this get,post session ...etc
		$channel_name = $_POST['channel_name']; // never change 
		$socket_id = $_POST['socket_id']; // never change		
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		$presence_data = array('name' => $name);
		echo $pusher->presence_auth($channel_name, $socket_id, $user_id, $presence_data);
		exit;
		}
		
	public function pusher_server() 
	{
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		if ($_REQUEST['typing'] == "false")
		{
			$pusher->trigger('presence-mychanel', 'send-event', array('message' => htmlspecialchars ( $_REQUEST['msg']), 'from' => $_REQUEST['from'], 'to' => str_replace('#', '', $_REQUEST['to'])));
		}
		else if ($_REQUEST['typing'] == "true")
			$pusher->trigger('presence-mychanel', 'typing-event', array('message' => $_REQUEST['typing'], 'from' => $_REQUEST['from'], 'to' => str_replace('#', '', $_REQUEST['to'])));
		else
		{
			$pusher->trigger('presence-mychanel', 'typing-event', array('message' => 'null', 'from' => $_REQUEST['from'], 'to' => str_replace('#', '', $_REQUEST['to'])));
		}
		exit;
	}
	

	public function pusher_chat() {
		require_once('inc/Pusher.php');
		require_once('inc/GroupChatActivity.php');		
		$chat_info = $_REQUEST['chat_info'];
		
		$channel_name = null;
		
		if( !isset($_REQUEST['chat_info']) ){
		  header("HTTP/1.0 400 Bad Request");
		  echo('chat_info must be provided');
		}		
		if( !isset($_SERVER['HTTP_REFERER']) ) {
		  header("HTTP/1.0 400 Bad Request");
		  echo('channel name could not be determined from HTTP_REFERER');
		}		
		$channel_name = $this->get_channel_name($_SERVER['HTTP_REFERER']);		
		$options = $this->sanitize_input($chat_info);		
		$activity = new Activity('chat-message', $options['text'], $options);
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		$data = $activity->getMessage();		
		$response = $pusher->trigger($channel_name, 'chat_message', $data, null, true);
		$message_id = $data['id'];
		$author_id = $_SESSION['user_id'];
		$author_name = $_SESSION['name_of_user'];
		$timestamp = $data['published'];
		$date = date('mdy');
		$text = $data['body'];
		$qry = "(message_id, author_id, author_name, text, timestamp, session_id) VALUES ('$message_id', '$author_id', '$author_name' ,'$text','$timestamp','$date')";
		$this->saveToDatabase('group_chat', $qry);
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');		
		$result = array('activity' => $data, 'pusherResponse' => $response);
/* 		echo(json_encode($result)); */ // this is for debuggin purposes, not necessary for functionaoity
		exit;
	}
		
	function get_channel_name($http_referer) //this is used in the pusher chat to determine the url location of the chat
	{
	  // not allowed :, / % #
	  $pattern = "/(\W)+/";
	  $channel_name = preg_replace($pattern, '-', $http_referer);
	  return $channel_name;
	}
	
	function getChatList()
	{
	 $users = array(); 
	 $table = 'fgusers3';
	 $role = $_SESSION['role'];
	$qry = "Select user_id, profile_pic, CONCAT(first_name,' ', last_name) as name from $table WHERE (role = '$role' AND status = 1) ORDER BY name ASC";
	$result = $this->widgetHistory($qry);
	$chat =array();
	foreach ($result as $key => $value){
	$chat["$value[0]"] = array($value[2], 'images/assets/homer.gif', 'http://html5-ninja.com');
	}
	
	echo json_encode($chat);
	}
		
	function sanitize_input($chat_info) {
	  $email = isset($chat_info['email'])?$chat_info['email']:'';
	  
	  $options = array();
	  $options['displayName'] = substr(htmlspecialchars($chat_info['nickname']), 0, 30);
	  $options['text'] = substr(htmlspecialchars($chat_info['text']), 0, 300);
	  $options['email'] = substr(htmlspecialchars($email), 0, 100);
	  $options['get_gravatar'] = true; //
	  return $options;
	}
	
	public function saveToDatabase($table, $query)
	{
		$MySql_username 	= DB_USER; //mysql username
		$MySql_password 	= DB_PASS; //mysql password
		$MySql_hostname 	= DB_HOST; //hostname
		$MySql_databasename = DB_NAME; //databasename	
		$dbconn = mysql_connect($MySql_hostname, $MySql_username, $MySql_password)or die("Unable to connect to MySQL");
		mysql_select_db($MySql_databasename,$dbconn); // not sure if i want to put fail messaging here or not yet
		mysql_query("INSERT INTO $table $query");
		mysql_close($dbconn);
	}
	
	function widgetHistory($qry) {
			$messages = array();
			$MySql_username 	= DB_USER; //mysql username
			$MySql_password 	= DB_PASS; //mysql password
			$MySql_hostname 	= DB_HOST; //hostname
			$MySql_databasename = DB_NAME; //databasename	
			$dbconn = mysql_connect($MySql_hostname, $MySql_username, $MySql_password)or die("Unable to connect to MySQL");
			mysql_select_db($MySql_databasename,$dbconn);		
			$result = mysql_query($qry,$dbconn);
			mysql_close($dbconn);
			while ($row = mysql_fetch_row($result)) {
			$messages[] = $row;
			}			
			return $messages;			
		}	
			
	
	
	
}
	
?>
