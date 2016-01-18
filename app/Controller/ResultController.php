<?php

namespace Controller;

class ResultController extends \Controller
{
	public function indexAction()
	{
		$results = \App::db()->query("SELECT id, host, type, count FROM parsing_data");
		
		$types = array(
			\HtmlContentParser::SEARCH_TYPE_LINKS  => 'Links',
			\HtmlContentParser::SEARCH_TYPE_IMAGES => 'Images',
			\HtmlContentParser::SEARCH_TYPE_TEXT   => 'Text',
		);
		
		$this->view->assign('results', $results);
		$this->view->assign('types', $types);
		
		$this->view->render();
	}
	
	public function viewAction($id)
	{
		$result = \App::db()->query("SELECT * FROM parsing_data WHERE `id` = ?", array($id))->fetch();

		$data = unserialize($result['data']);
		
		$this->view->assign('data', $data);
		
		$this->view->render();
	}
}
