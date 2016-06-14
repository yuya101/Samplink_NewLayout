<?php
header("Content-Type: text/plain; charset=UTF-8");

require("../class/autoload.php");

if(isset($_REQUEST['selectID']))
{
	$sql = "select catID, catName from product_category where typeID=".$_REQUEST['selectID'];
	$mqFunc = new MainQuery();
	$num = $mqFunc->checkNumRows($sql);
			
	if($num > 0)
	{
		$result = $mqFunc->getResultAll($sql);
		foreach($result as $r)
		{
			echo $r['catID']."-".$r['catName'].",";
		}
	}
	else
	{
		echo "99999-ไม่พบข้อมูลที่ท่านต้องการค่ะ,";
	}
	
	unset($sql, $mqFunc);
}
?>