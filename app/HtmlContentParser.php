<?php

class HtmlContentParser
{
	const SEARCH_TYPE_LINKS  = 0;
	const SEARCH_TYPE_IMAGES = 1;
	const SEARCH_TYPE_TEXT   = 2;
	
	protected $parsingType;
	protected $searchText = '';
	protected $content = '';
	
	public function __construct($parsingType = 0, $content = '')
	{
		$this->parsingType = $parsingType;

		$allowedTypes = array(self::SEARCH_TYPE_LINKS, self::SEARCH_TYPE_IMAGES, self::SEARCH_TYPE_TEXT);
		if (!is_numeric($parsingType) || !in_array($parsingType, $allowedTypes)) {
			$this->parsingType = self::SEARCH_TYPE_LINKS;
		}
		
		$this->content = $content;
	}

	/**
	 * Set parsing mode for parser. 
	 * @param integer $parsingType
	 * @throws Exception
	 */
	public function setParsingType($parsingType)
	{
		if (in_array($parsingType, array(self::SEARCH_TYPE_LINKS, self::SEARCH_TYPE_IMAGES, self::SEARCH_TYPE_TEXT))) {
			$this->parsingType = $parsingType;
		} else {
			throw new Exception('Wrong parsing type');
		}
	}

	/**
	 * Set html content for parsing.
	 * @param $content
	 * @throws Exception
	 */
	public function setContent($content)
	{
		if (is_string($content)) {
			$this->content = $content;
		} else {
			throw new Exception('Content to parse must be a string type!');
		}
	}
	
	public function setSearchText($text)
	{
		$this->searchText = $text;
	}

	/**
	 * Parse content by given parsing type
	 * @return Array
	 */
	public function parse()
	{
		switch ((integer) $this->parsingType) {
			case self::SEARCH_TYPE_IMAGES:
				$parser = new ParserImages($this->content);
				break;
			case self::SEARCH_TYPE_TEXT:
				$parser = new ParserText($this->content);
				$parser->setSearchText($this->searchText);
				break;
			default:
				$parser = new ParserLinks($this->content);
				break;
		}
		return $parser->parse();
	}
}
