<?php

class Router
{
	public $controller = null;
	public $action     = null;
	public $params     = array();
	
	public function __construct()
	{
		$uri = str_replace(SERVER_NAME, '', $_SERVER['REQUEST_URI']);
		
		// uri separates for: controller/action/param1/param2/...
		$uri   = trim($uri, '/');
		$parts = explode('/', $uri);
		
		foreach ($parts as $key => $item) {
			switch ($key) {
				case '0':
					$this->controller = strtolower($item);
					break;
				
				case '1':
					$this->action = strtolower($item);
					break;
				
				default:
					array_push($this->params, $item);
					break;
			}
		}
	}
}
