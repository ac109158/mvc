<?php require_once VIEW . 'dash_header.php' ?>
<div id="dashboard_wrapper">
<div id="dashboard_top">
	<div id="dashboard_group_chat_panel">
	</div>
	<div id="dashboard_main_panel_wrapper">
<!-- 		<?php require_once 'file_upload/index.php' ?> -->
	</div> <?php // end of dashboard_main_panel_wrapper ?>
	
	<div id="dashboard_options_panel"> </div>	
	<div id="dashboard_side_panel">
		<div id="side_panel_content">
			<div id="side_panel_info_panel">
				<?php echo $_SESSION['name_of_user'] ?>	
			</div>
			<div id="side_panel_notify_panel">
				<?php require_once 'inc/notify.php'; ?>	
			</div>
			<div id="side_panel_stream_panel">
				<?php require_once 'inc/activity_stream.php'; ?>	
			</div>
	</div> 
	</div> <?php //end of dashboard_side _panel; ?>
	
	</div> <?php // end of dashboard_top ?>
	</div> <?php //end of dashbaord_wrapper ?>
	
	
	<div id="dashboard_bottom">
	
	</div><?php //end of dashboard _bottom ?>