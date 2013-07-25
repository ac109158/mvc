<?php
class PusherModel extends Model
{
    public function __construct()
	    {
		parent::__construct();
		require_once ('./inc/Pusher.php');
		}
		
		
		public function pusher_init()
		{
			require_once ('./inc/Pusher.php');
			$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
			return $pusher;
		}
		
	public function trigger_init() {
	$channel = $_REQUEST['activity_channel'];
	$text = $_REQUEST['action_text'];
	$name = $_SESSION['name_of_user'];
	$type = $_REQUEST['activity_type'];
	$this->trigger_activity($channel, $text, $name, $type);
	exit;
	}

	public function trigger_activity($channel, $text, $name, $type) 
	{
		//require_once('inc/Pusher.php');
		require_once('inc/Activity.php');
		$activity = new Activity($type, $text, $name);
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		$pusher->trigger($channel, $type, $activity->getMessage());
		return true;
	}
	
	public function chain_activity($channel, $text, $name, $type,$pusher) 
	{
		//require_once('inc/Pusher.php');
		require_once('inc/Activity.php');
		$activity = new Activity($type, $text, $name);
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		$pusher->trigger($channel, $type, $activity->getMessage());
		return true;
	}
	
	function getActionText($activity_type, $activity_data) 
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
	{
		//require_once ('./inc/Pusher.php');
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		if ($vars[2] == 0 || $vars[2] == 2) 
		{
			$message = Model::Sanitize($vars[0]);
			$message .= "<br><br />Sent by: <strong>". $vars[3]. '</strong>';
			$data = array('message' => $message);
			$channel = $vars[1];		
			$pusher->trigger($channel, 'notification', $data);
		}
		if ($vars[2] == 1 || $vars[2] == 2) 
		{
			$this->chain_activity($vars[1], $vars[0], $vars[3], 'page-load', $pusher);
		}
		return true;
	}
	
	public function pusher_auth() {		
		//require_once('inc/Pusher.php');		
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
		//require('inc/Pusher.php');
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
		/* require_once('../config.php'); */
		
		/* date_default_timezone_set('UTC'); */
		
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
		$options = $chat_info;		
		$activity = new Activity('chat-message', $options['text'], $options);		
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		$data = $activity->getMessage();		
		$response = $pusher->trigger($channel_name, 'chat_message', $data, null, true);
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');		
		$result = array('activity' => $data, 'pusherResponse' => $response);
		echo(json_encode($result));
	}
		
	function get_channel_name($http_referer) 
	{
	  // not allowed :, / % #
	  $pattern = "/(\W)+/";
	  $channel_name = preg_replace($pattern, '-', $http_referer);
	  return $channel_name;
	}
		
	function sanitize_input($chat_info) {
	  $email = isset($chat_info['email'])?$chat_info['email']:'';
	  
	  $options = array();
	  $options['displayName'] = substr(htmlspecialchars($chat_info['nickname']), 0, 30);
	  $options['text'] = substr(htmlspecialchars($chat_info['text']), 0, 300);
	  $options['email'] = substr(htmlspecialchars($email), 0, 100);
	  $options['get_gravatar'] = true;
	  return $options;
	}
			
	
	
	
}
	
?>
