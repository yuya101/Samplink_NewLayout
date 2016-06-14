<?php
header("Content-Type: text/plain; charset=UTF-8");

require("../class/autoload.php");

if(isset($_REQUEST['selectID']))
{
	$sql = "select AMPHUR_ID, AMPHUR_NAME from amphur where PROVINCE_ID=".$_REQUEST['selectID']." order by AMPHUR_NAME";
	$mqFunc = new MainQuery();
	$result = $mqFunc->getResultAll($sql);
	
	foreach($result as $r)
	{
		echo $r['AMPHUR_ID']."-".$r['AMPHUR_NAME'].",";
	}
	
	unset($sql, $mqFunc, $result, $r);
}
?>