<?php
    {
    	if(isset($_POST['submitted']))
		{
			$result = App::fetchModel( 'login','Login');
			if( $result === true )
			{
				App::fetchModel('base','RedirectToURL','?controller=dashboard&task=display');
				exit;
			}
			else 
				{
				$result = array_pop($result);
				ControllerLogin::display($result);
				exit;
				}
		}
		echo 4;
		ControllerLogin::display();
		exit;
	}