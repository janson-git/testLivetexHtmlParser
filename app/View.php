<?php

class View
{
	protected $viewsFolder  = '';
	protected $folder       = '';
	protected $file         = '';
	protected $templateVars = array();
	
	protected $templateExt = '.php';
	
	public function __construct($controller = null)
	{
		$this->viewsFolder = APP_PATH . DIRECTORY_SEPARATOR . 'View';
		
		if (!is_null($controller)) {
			$controllerClass = get_class($controller);
			$this->folder = strtolower( str_replace('Controller', '', $controllerClass) );
			$this->folder = trim($this->folder, '/\\ ');
		}
	}

	/**
	 * Assign variable to template
	 * @param $name
	 * @param $value
	 */
	public function assign($name, $value)
	{
		$this->templateVars[$name] = $value;
	}

	/**
	 * Render template. If not given, template name will identically to action name
	 * @param null|string $templateName
	 * @throws Exception
	 */
	public function render($templateName = null)
	{
		if (is_null($templateName)) {
			// gets name of callee action
			$backtrace = debug_backtrace();
			if (!isset($backtrace[1]['function'])) {
				throw new Exception('Unknown file name to render');
			}
			$templateName = $backtrace[1]['function'];
			$templateName = str_replace('Action', '', $templateName);
		}
		if (substr($templateName, 0, -4) !== $this->templateExt) {
			$templateName .= $this->templateExt;
		}
		
		extract($this->templateVars);
		
		$filepath = $this->viewsFolder . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $templateName;
		
		if (file_exists($filepath)) {
			include $filepath;
		} else {
			throw new Exception('Template \'' . $templateName . '\' not found!');
		}
	}

	/**
	 * display $data as json.
	 * @param $data
	 */
	public function renderJsonData($data)
	{
		echo json_encode($data);
	}
}
