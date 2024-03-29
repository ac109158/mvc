<?php session_start(); ?>
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
	
	//print_r($_REQUEST);
	require './lib/App.php';
	$app = new App();
	$url = $app::init();
	//print_r($url);
	if(!$app::execute($url['controller'], $url['task']))
	{
	if(true)
		{
		$app::execute('dashboard', 'display');
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