<?php
class Database
{
	private $DATABASE_NAME		=	'crud_project';
	private $DATABASE_HOST		=	'localhost';
	private $DATABASE_USERNAME	=	'root';
	private $DATABASE_PASSWORD	=	'';

	private $conn				=	null;

	public function connect() {
		$this->conn = null;

		try {
			$this->conn = new PDO("mysql:host=".$this->DATABASE_HOST.";charset=utf8;dbname=".$this->DATABASE_NAME, $this->DATABASE_USERNAME, $this->DATABASE_PASSWORD);
			$this->conn->exec("set names utf8");
		} catch(PDOException $exception) {
			echo "Connection error: ".$exception->getMessage();
		}

		return $this->conn;
	}
}