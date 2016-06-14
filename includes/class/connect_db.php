<?php
require_once("dimText.php");
require_once($configPath."config.php");

class Connect_DB
{
	private $conn;
	
	public function __construct()
	{		
		$this->conn=mysql_pconnect(DB_HOST, DB_USERNAME, DB_PASS) or die("Could not connect to MySQL Database");
		mysql_select_db(DB_NAME) or die("Could not select to database");
		mysql_query("SET NAMES UTF8");
	}
	
	public function getConn()
	{
		return $this->conn;
	}
	
	public function freeConn()
	{
		mysql_close($this->conn);
	}
}
?>