<?php
require_once("dimText.php");
require_once($classPath."connect_db.php");

class TheSampleFunction
{
	private $connect;
	private $query, $result, $num, $sql;
	private $uid;
	
	
	public function __construct()
	{
		// Construction Method
	}
	
	public function getTopicPoint($topicID)
	{
		$connect = new Connect_DB();
		
		$sql = "select topicPoint from point_topic where topicID=".$topicID;
		$this->query = mysql_query($sql, $connect->getConn());
		$this->num = mysql_num_rows($this->query);
		
		if($this->num > 0)
		{
			$this->result = mysql_fetch_assoc($this->query);
			$this->uid = (int)$this->result['topicPoint'];
		}
		else
		{
			$this->uid = 0;
		}
		
		$this->close_db();
		
		unset($connect);
		
		return $this->uid;
	}	
	
	
	public function close_db()
	{
		mysql_close();
	}
}
?> 