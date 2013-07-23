<?php
class PusherModel extends Model
{
    public function __construct()
	    {
		parent::__construct();
		$model = App::fetchModel('user');
		if(!$model::detectLogin())
			{
			$model::RedirectToURL('index.php?controller=login&task=display');
			exit;
			}
		if(!App::fetchModel('user', 'detectActive', $_SESSION['user_id']))
			{
			$model::RedirectToURL('index.php?controller=login&task=display');
			exit;
			}				
		}
		
	public function trigger_init() {
	echo here;
	$channel = $_REQUEST['activity_channel'];
	$text = $_REQUEST['action_text'];
	$name = $_SESSION['name_of_user'];
	$type = $_REQUEST['activity_type'];
	$this->trigger_activity($channel, $text, $name, $type);
	exit;
	}

	public function trigger_activity($channel, $text, $name, $type) 
	{
		require_once('inc/Pusher.php');
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
	
	
	public function notify_endpoint($vars) // $vars[0] message, $vars[1] channel
	{
		require_once ('./inc/Pusher.php');
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		$message = Model::Sanitize($vars[0]);
		$data = array('message' => $message);
		$channel = $vars[1];		
		$pusher->trigger($channel, 'notification', $data);
		return true;
	}
	
	public function pusher_auth() {		
		require_once('inc/Pusher.php');		
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
		require('inc/Pusher.php');
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
	
}
	
?>
