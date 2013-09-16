<?php
namespace Library;
/**
 * An abstract class of a contoller. Controller might contain multiple action.
 * Business logic is located in an action.
 *
 * @author Dionis L. <github@dionis.me>
 */
abstract class Controller {

	/** @var string HTML code which will be printed out */
	private $view = 'No view.';

	private $action = '';
	private $controller = '';

	/**
	 * Executes an action of a controller
	 *
	 * @param string $action Name of the action which should be executed withit a controller
	 */
	public function __construct($action = ''){
		$this->action = strtolower($action);
		$this->controller = strtolower(preg_replace('#.*\\\([^\\\]+)Controller#i','$1',get_called_class()));
		$this->view = $this->{$this->action.'Action'}();
	}

	/**
	 * Returns the view as a string
	 *
	 * @return string View
	 */
	public function __toString() {

		if(!is_array($this->view))
			return (string)$this->view;

		if(isset($this->view['json'])){
			header('Content-Type: application/json; charset=utf-8');
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
			header("Cache-Control: no-cache,must-revalidate");
			header("Pragma: no-cache");
			return json_encode($this->view['json']);
		}

		$viewFile = ROOT.DS.'app'.DS.'views'.DS.$this->controller.DS.$this->action.'.phtml';

		// load view template
		ob_start();
		foreach($this->view as $i=>$v){
			${$i} = $v;
		}
		include $viewFile;
		$body = ob_get_contents();
		ob_end_clean();

		// load layout template
		$layoutFile = ROOT.DS.'app'.DS.'views'.DS.'layout'.DS.'layout.phtml';
		ob_start();
		include $layoutFile;
		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}
}
?>
