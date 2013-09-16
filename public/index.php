<?php
/**
 * DEMO Customer Managment Application
 *
 * @author Dionis L. <github@dionis.me>
 */

/** Define few constants */
define('DS',		DIRECTORY_SEPARATOR);
define('ROOT',		dirname(dirname(__FILE__)));
define('WEBROOT',	'/');

/** Autoload any required class */
function __autoload($className){
	$file = ROOT.DS.str_replace('\\',DS,strtolower($className)).'.php';
	if(file_exists($file)){
		require_once($file);
	}
	else {
		throw new Exception("Couldn't load class: ".$className);
	}
}

$config = array();
require_once ROOT.'/config/routes.php';
require_once ROOT.'/config/db.php';
$app = new Library\App($config);
$app->run();
?>