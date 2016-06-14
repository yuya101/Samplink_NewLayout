<?php
require_once("dimText.php");
require_once($classPath."connect_db.php");

class MainQuery
{
	private $connect;
	private $query, $result, $num, $sql;
	private $uid;
	
	
	public function __construct()
	{
		// Construction Method
	}
	
	public function checkNumRows($sqlTemp)  //  ------ For Check Count Row 
	{
		$connect = new Connect_DB();
		
		$this->query = mysql_query($sqlTemp, $connect->getConn());
		$this->num = mysql_num_rows($this->query);
		$this->close_db();
		
		unset($connect);
		
		return $this->num;
	}
	
	
	public function getPrimaryID($sqlTemp, $wantID)  //  ---------  For Get target Primary id
	{
		$connect = new Connect_DB();
		
		$this->query = mysql_query($sqlTemp, $connect->getConn());
		$this->num = mysql_num_rows($this->query);
		
		if($this->num > 0)
		{
			//$this->result = mysql_fetch_assoc($this->query, 1);
			$this->result = mysql_fetch_assoc($this->query);
			$this->uid = (int)$this->result[$wantID];
		}
		else
		{
			$this->uid = 0;
		}
		
		$this->close_db();
		unset($connect);
		
		return $this->uid;
	}
	
	
	public function getNewPrimaryID($sqlTemp, $wantID)  //  ---------  For Get next Primary id
	{
		$connect = new Connect_DB();
		
		$this->query = mysql_query($sqlTemp, $connect->getConn());
		$this->num = mysql_num_rows($this->query);
		
		if($this->num > 0)
		{
			//$this->result = mysql_fetch_assoc($this->query, 1);
			$this->result = mysql_fetch_assoc($this->query);
			$this->uid = (int)$this->result[$wantID] + 1;
		}
		else
		{
			$this->uid = 1;
		}
		
		$this->close_db();
		unset($connect);
		
		return $this->uid;
	}
	
	
	public function querySQL($sqlTemp)  //-------- For Query SQL
	{
		$connect = new Connect_DB();
		
		mysql_query($sqlTemp, $connect->getConn());
		$this->close_db();
		
		unset($connect);
	}
	
	
	public function getResultAll($sqlTemp)  //--------- For Fetch SQL Result Set 
	{
		$connect = new Connect_DB();
		
		$this->query = mysql_query($sqlTemp, $connect->getConn());
		$this->num = mysql_num_rows($this->query);
		
		if($this->num > 0)
		{
			while($this->result = mysql_fetch_assoc($this->query))
			{
				$allResult[] = $this->result;
			}
		}
		
		$this->close_db();
		
		unset($connect);
		
		return $allResult;
	}
	
	
	public function getResultOneRecord($sqlTemp, $wantRecord)  //--------- For Fetch SQL Result 1 Record
	{
		$connect = new Connect_DB();
		
		$oneResult = "";
		
		$this->query = mysql_query($sqlTemp, $connect->getConn());
		$this->num = mysql_num_rows($this->query);
		
		if($this->num > 0)
		{
			while($this->result = mysql_fetch_assoc($this->query))
			{
				$oneResult = $this->result[$wantRecord];
			}
		}
		
		$this->close_db();
		
		unset($connect);
		
		return $oneResult;
	}
	
	
	public function getRandomRecord($tmpSQL, $recChkID, $noOfRec)
	{		
		$connect = new Connect_DB();
		$noOfRec = intval($noOfRec);  //--------------- จำนวน Record ที่ต้องการ Random
		
		$this->query = mysql_query($tmpSQL, $connect->getConn());
		$this->num = mysql_num_rows($this->query);
		$maxValue = $this->num;
		
		for($i=0; $i<$noOfRec; $i++)
		{
			$randomNo = rand(1, $maxValue);
			$this->sql = $tmpSQL.' and '.$recChkID.'='.$randomNo;
			$this->query = mysql_query($this->sql, $connect->getConn());
			$this->num = mysql_num_rows($this->query);
				
			if($this->num > 0)
			{
				if(isset($randomRec))
				{
					if(in_array($randomNo, $randomRec))
					{
						$i = $i - 1;
					}
					else
					{
						$randomRec[$i] = $randomNo;
					}
				}
				else
				{
					$randomRec[$i] = $randomNo;
				}
			}
			else
			{
				$i = $i - 1;
			} //-----------  if($this->num > 0)			
		}  //---------  for($i=0; $i<$noOfRec; $i++)
		
		$this->close_db();		
		unset($connect);
				
		return $randomRec;
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