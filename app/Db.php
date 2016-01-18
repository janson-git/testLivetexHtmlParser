<?php

class Db
{
	/**
	 * @var null|PDO
	 */
	protected $pdo = null;
	
	public function __construct()
	{
		if (is_null($this->pdo)) {
			$this->pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASS);
		}
		return $this->pdo;
	}

	/**
	 * @param $sql
	 * @param array $data
	 * @return mixed
	 */
	public function query($sql, $data = array())
	{
		$query = $this->pdo->prepare($sql);
		$query->execute($data);
		return $query;
	}
	
}
