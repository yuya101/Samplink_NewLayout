<?php
header("Content-Type: text/plain; charset=UTF-8");

require("../class/autoload.php");

if(isset($_REQUEST['selectID']))
{	
	$sql = "select DISTRICT_ID, DISTRICT_NAME from district where AMPHUR_ID=".$_REQUEST['selectID']." order by DISTRICT_NAME";
	$mqFunc = new MainQuery();
	$result = $mqFunc->getResultAll($sql);
	
	foreach($result as $r)
	{
		echo $r['DISTRICT_ID']."-".$r['DISTRICT_NAME'].",";
	}
	
	unset($sql, $mqFunc, $result, $r);
}
?>