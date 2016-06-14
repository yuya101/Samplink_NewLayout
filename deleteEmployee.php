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

	if(isset($_REQUEST['aid']))
	{
		$mQuery = new MainQuery();

		$aid = base64_decode($_REQUEST['aid']);

		$sql = "select photograph, qualification1, qualification2, qualification3, qualification4, qualification5, addressproof, idproof from admin_detail where aid=".$aid;
		$num = $mQuery->checkNumRows($sql);

		if($num > 0)
		{
			$result = $mQuery->getResultAll($sql);

			foreach($result as $r)
    		{
    			if($r['photograph'] != "-"){unlink($textFilePath.$r['photograph']);}
    			if($r['qualification1'] != "-"){unlink($textFilePath.$r['qualification1']);}
    			if($r['qualification2'] != "-"){unlink($textFilePath.$r['qualification2']);}
    			if($r['qualification3'] != "-"){unlink($textFilePath.$r['qualification3']);}
    			if($r['qualification4'] != "-"){unlink($textFilePath.$r['qualification4']);}
    			if($r['qualification5'] != "-"){unlink($textFilePath.$r['qualification5']);}
    			if($r['addressproof'] != "-"){unlink($textFilePath.$r['addressproof']);}
    			if($r['idproof'] != "-"){unlink($textFilePath.$r['idproof']);}
    		}  //----------  foreach($result as $r)

    		unset($result, $r);
		}  //---------  if($num > 0)


		$sql = "delete from admin where aid=".$aid;
		$mQuery->querySQL($sql);

		$sql = "delete from admin_detail where aid=".$aid;
		$mQuery->querySQL($sql);


		unset($mQuery);


		header('location:index.php?p=manageEmployee');
	}
	else
	{
		header('location:index.php');
	}   //------------  if(isset($_REQUEST['aid']))
}
else
{
	header('location:login.php');
}
?>
