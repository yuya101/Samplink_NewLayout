<?php
require_once("dimText.php");
require_once($classPath."connect_db.php");

class Authenticate
{
	private $connect;
	private $query, $result, $num;
	public $aid;
	
	
	public function __construct()
	{
		// Construction Method
	}
	
	public function activeLogin($sqlTemp, $adminID)
	{	
		$connect = new Connect_DB();
		
		$this->query = mysql_query($sqlTemp, $connect->getConn());
		$this->num = mysql_num_rows($this->query);
		
		if($this->num > 0)
		{
			$this->result = mysql_fetch_array($this->query, 1);
			$this->aid = $this->result[$adminID];
			unset($this->result);
		}
		
		$this->close_db();
		unset($connect);
		
		return $this->num;
	}
	
	public function close_db()
	{
		mysql_close();
	}
}
?> 