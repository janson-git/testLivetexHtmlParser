<?php

namespace Controller;

class IndexController extends \Controller
{
	public function indexAction()
	{
		$this->view->render();
	}
	
	public function searchAction()
	{
		$url  = isset($_REQUEST['url']) ? $_REQUEST['url'] : '';
		$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '0';
		$text = isset($_REQUEST['text']) ? $_REQUEST['text'] : '';

		// VALIDATE
		$errors = array();
		if (empty($url)) {
			$errors[] = 'Cannot parse content for undefined url';
		}
		if (!is_numeric($type)) {
			$errors[] = 'Wrong search type given';
		}
		if ($type == \HtmlContentParser::SEARCH_TYPE_TEXT && empty($text)) {
			$errors[] = 'Undefined text for search on page';
		}
		
		if (!empty($errors)) {
			$result = array('status' => 'error', 'error' => join("\n", $errors));
			
			$this->view->renderJsonData($result);
			exit;
		}
		
		
		if (strpos($url, 'http://') === false) {
			$url = 'http://' . $url;
		}

		// GET PAGE CONTENT AND PARSE IT
		$pageContent = \Http::getUrlContent($url);

		$parser = new \HtmlContentParser($type, $pageContent);
		$parser->setSearchText($text);
		$result = $parser->parse();

		// SAVE RESULT TO DATABASE
		\App::db()->query("INSERT INTO `parsing_data` (`host`, `type`,`data`, `count`) VALUES (?, ?, ?, ?)", 
			array($url, $type, serialize($result), count($result)));
		
		// OUTPUT JSON
		$result = array( 'status' => 'ok', 'error' => '' );
		$this->view->renderJsonData($result);
		exit;
	}
}
