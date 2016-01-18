<?php

class Parser
{
	protected $content = '';
	protected $pattern = '';
	protected $results = array();

	public function __construct($content)
	{
		$this->content = $content;
	}

	/**
	 * Parse content for data
	 * @return array
	 */
	public function parse()
	{
		if (empty($this->pattern)) {
			return array();
		}

		$result = preg_match_all($this->pattern, $this->content, $matches);
		$this->results = $matches[1];
		return $matches[1];
	}
}
