<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
$appDir = "/thesample_newlayout";
$fullURL = "http://".$_SERVER['HTTP_HOST'];

$textFilePath = $dir.$appDir."/upload/";
$configPath = $dir.$appDir."/includes/config/";
$classPath = $dir.$appDir."/includes/class/";
$imagePath = $dir.$appDir."/img/";
$jsonPath = $dir.$appDir."/includes/json/";
$ajaxPath = $dir.$appDir."/includes/ajax/";
$pdfPath = $dir.$appDir."/includes/class/importClass/fpdf/";
$uploadPath = "upload/";
$uploadFolderPath = $fullURL.$appDir."/upload/";


require_once($classPath."dimText.php");
require_once($classPath."mainfunction.php");
require_once($classPath."mainquery.php");
require_once($classPath."datefunction.php");
require_once($pdfPath."fpdf.php");
require_once($classPath."PDF.php");
require_once($configPath."calValue.php");
require_once($classPath."thesamplefunction.php");
?>
