<?php

class Controller
{
	/**
	 * @var View
	 */
	protected $view = null;
	
	public function __construct()
	{
		$this->view = new View($this);
	}
	
	public function beforeAction() {}
	
	public function afterAction() {}
}
