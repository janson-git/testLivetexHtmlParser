<?php

class Url
{
	public static function base($useProtocol = true)
	{
		$baseServerName = $_SERVER['SERVER_NAME'];
		$subServerName  = SERVER_NAME;
		
		$serverName = $baseServerName . $subServerName;
		if ($useProtocol) {
			$serverName = 'http://' . $serverName;
		}
		return $serverName;
	}
	
	public static function generate($resourcePath)
	{
		$baseUrl = self::base();
		$url = $baseUrl . ltrim($resourcePath, '/');
		return $url;
	}
}
