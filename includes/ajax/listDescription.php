<?php
header("Content-Type: text/plain; charset=UTF-8");

require("../class/autoload.php");

if(isset($_REQUEST['selectID']))
{
	$sql = "select * from product_cat_header where catID=".$_REQUEST['selectID'];
	$mqFunc = new MainQuery();
	$num = $mqFunc->checkNumRows($sql);
			
	if($num > 0)
	{
		$result = $mqFunc->getResultAll($sql);
		foreach($result as $r)
		{
			for($i=1; $i<=20; $i++)
			{
				echo $r['header'.$i]."*;*";
			}
		}
	}
	else
	{
		echo "ไม่พบข้อมูลที่ท่านต้องการค่ะ*;*";
	}
	
	unset($sql, $mqFunc);
}
?>