<?php 
	/**
	 *Written by Andy 6/10/13
	 *This program is to familarize myself with the Model View Controller structure
	 *
	 */
/* Get the controller from the url
*******************************************************
* $task = $_REQUEST['task'];
$controller = $_REQUEST['controller'];

$path = '/controllers/'.$controller.'.php';
if( file_exists($path) ) {
	require_once $path;
}

$classname = 'Controller'.ucfirst($controller);
$controller = new $classname();

$controller->execute( $task );
*
**********************************************************/
function main()
	{
	require './lib/App.php';
	$app = new App();
	$url = $app::init();
	//print_r($url);
	if(!$app::execute($url['controller'], $url['task'], $url['action'], $url['key']))
	{
	//echo "instruction failed";
	if($app::checkLogin())
		{
		$app::execute('dashboard', 'index');
		exit;
		}
	$app::execute('index', 'index');
	exit;
	}
	}
                                           
/**********************************************************
**                   
*/
main();	 
?>