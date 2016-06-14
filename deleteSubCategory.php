<?php
ob_start();
session_start();
session_cache_expire(20);  // TimeOut in scale of minutes.
// error_reporting(E_ALL);
// ini_set( 'display_errors','1');
$cache_expire = session_cache_expire();

if(isset($_SESSION['memberID']))
{
	include("includes/class/autoload.php");

	if(isset($_REQUEST['subcatID']))
	{
		$mQuery = new MainQuery();

		$subcatID = base64_decode($_REQUEST['subcatID']);

		$sql = "select subcatPicture from product_subcategory where subcatID=".$subcatID;
		$num = $mQuery->checkNumRows($sql);

		if($num > 0)
		{
			$result = $mQuery->getResultAll($sql);

			foreach($result as $r)
    		{
				if($r['subcatPicture'] != "-"){unlink($textFilePath.$r['subcatPicture']);}
    		}
		}  //-----------  if($num > 0)
		
		
		$sql = "delete from product_subcategory where subcatID=".$subcatID;
		$mQuery->querySQL($sql);


		unset($mQuery);

		header('location:admin.php?p=manageSubCategory');
	}
	else
	{
		header('location:admin.php');
	}   //------------  if(isset($_REQUEST['aid']))
}
else
{
	header('location:login.php');
}
?>
