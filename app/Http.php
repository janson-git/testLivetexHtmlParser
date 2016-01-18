<?php

class Http
{
	public static function getUrlContent($url)
	{
		$curl = curl_init($url);
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		
		$content = curl_exec($curl);
		if ($content === false) {
			throw new Exception("Cannot download url content");
		}
		return $content;
	}
}
