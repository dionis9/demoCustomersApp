<?php
namespace Library;
/**
 * It's the heart of our application.
 *
 * @author Dionis L. <github@dionis.me>
 */
class App {
	/** @var array $config Configurations array saved in config directory. */
	private static $config = array();
	/**
	 * Sets config
	 *
	 * @param array $config Configurations array saved in config directory.
	 */
	public function __construct(array $config){
		self::$config = $config;
	}
	/**
	 * Let's get it started :) Matches route to the controller and print it out.
	 */
	public function run(){
		$currentRoute = str_replace(WEBROOT,'/',$_SERVER['REQUEST_URI']);
		if(!isset(self::$config['routes'][$currentRoute])){
			$controller = new \App\Controllers\ErrorController('http404');
		}
		else {
			$controllerName = '\\App\\Controllers\\'.ucfirst(self::$config['routes'][$currentRoute]['controller']).'Controller';
			$controller = new $controllerName(self::$config['routes'][$currentRoute]['action']);
		}
		echo $controller;
	}
	/**
	 * Get all the config data necessary to connect to a db
	 *
	 * @param string $dbalias Alias of a db we want to connect to
	 * @return array Settings for a database connection, like host, user, etc.
	 */
	public static function getDBConfig($dbalias = 'default'){
		if(isset(self::$config['db'][$dbalias]))
			return self::$config['db'][$dbalias];
		else
			return array();
	}
}
?>
