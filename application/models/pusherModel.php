<?php
class PusherModel extends Model
{
    public function __construct()
	    {
		parent::__construct();					
		}

	public function activity_trigger() 
	{
		require_once('./inc/Pusher.php');
		require_once('./inc/Activity.php');	
		$activity_type = App::request($_GET['activity_type']);
		$activity_data = null;
		$email = null;
		$activity_data = App::request($_GET['activity_data']);
		$email = App::request($_GET['email']);		
		$action_text = getActionText($activity_type, $activity_data);		
		$activity = new Activity($activity_type, $action_text, $email);		
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		$pusher->trigger('site-activity', $activity_type, $activity->getMessage());
				
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
	exit;
	}
	
	public function notify_endpoint($vars) // $vars[0] message, $vars[1] channel
	{
		require_once ('./inc/Pusher.php');
		$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
		$message = Model::Sanitize($vars[0]);
		$data = array('message' => $message);
		$channel = $vars[1];		
		$pusher->trigger($channel, 'notification', $data);
		exit;
	}
		


	
}
	
?>
