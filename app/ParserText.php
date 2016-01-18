<?php

class ParserText extends Parser
{
	protected $pattern = '';
	protected $searchText = '';
	
	public function setSearchText($text)
	{
		if (is_string($text)) {
			$this->searchText = $text;
		}
	}
	
	public function parse()
	{
		$this->pattern = "#\b([\w\p{L}]*{$this->searchText}[\w\p{L}]*)\b#uUi";
		
		return parent::parse();
	}
}
