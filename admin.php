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
	include("includes/view/headerAdmin.php");
	include("includes/view/centerAdmin.php");
	include("includes/view/footerAdmin.php");
}
else
{
	header('location:login.php');
}
?>
