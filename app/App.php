<?php

class App
{
	/**
	 * @var Router
	 */
	protected $router = null;
	protected static $db = null;
	
	public function __construct()
	{
		$this->router = new Router();
	}

	/**
	 * Start application, get routing data and execute request
	 */
	public function execute()
	{
		if (empty($this->router->controller) || !is_string($this->router->controller)) {
			$this->router->controller = 'index';
		}
		if (empty($this->router->action) || !is_string($this->router->action)) {
			$this->router->action = 'index';
		}
		
		try {
			$controllerName = "\Controller\\" . ucfirst($this->router->controller) . 'Controller';
			$actionName     = ucfirst($this->router->action) . 'Action';

			$controller = new $controllerName;

			$controller->beforeAction();
			call_user_func_array(array($controller, $actionName), $this->router->params);
			$controller->afterAction();
			
		} catch (Exception $e) {
			echo $e->getMessage() . "<br /> in <b>{$e->getFile()}</b> line <b>{$e->getLine()}</b>";
			exit;
		}
	}

	/**
	 * @return Db
	 */
	public static function db()
	{
		if (is_null(self::$db)) {
			self::$db = new Db();
		}
		return self::$db;
	}
}
