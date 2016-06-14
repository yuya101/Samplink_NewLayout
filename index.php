<?php
ob_start();
session_start();
session_cache_expire(20);  // TimeOut in scale of minutes.
// error_reporting(E_ALL);
// ini_set( 'display_errors','1');
$cache_expire = session_cache_expire();


if((@$_REQUEST['flag'] == "logOut") and (isset($_SESSION['mLoginID'])))
{
	header("location:includes/control/logOutUser_Ctl.php");
}
else
{
	include("includes/class/autoload.php");
	include("includes/view/header.php");
}
?>
