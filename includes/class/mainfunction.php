<?php
require_once("dimText.php");
require_once($classPath."datefunction.php");
require_once($classPath."simpleImage.php");

class MainFunction
{	
	private $fileName;
	private $dFunc, $dateNow, $timeStamp;
	private $strFileName, $extension;
	
	
	public function __construct()
	{
		// Construction Method
	}
	
	
	public function chgSpecialCharInputText($tempItem)
	{
		if($tempItem == "")
		{
			$tempItem = "-";
		}
		else
		{
			$tempItem = trim($tempItem);
			$tempItem = htmlspecialchars($tempItem);
			$tempItem = addslashes($tempItem);
			//$tempItem = $this->dataCleasing($tempItem);  ใช้แล้วเกิดปัญหากับภาษาไทย
		}
		
		return $tempItem;
	}
	
	
	public function dataCleasing($data)
	{
		$data = strip_tags ($data); // remove HTML Tags
		  // remove Incorrect encoding characters
		$data = preg_replace ( '/[^(\x20-\x7F)]*/', "", $data ); 
		$data = str_replace ( "\n", "", $data );//remove Enter
		$data = str_replace ( ",", "", $data );//remove Comma
		$data = str_replace ( "\t", "", $data );//remove TAB
		$data = str_replace ( "\r\n", "", $data );//remove Enter
		$data = trim($data);
		return $data;
	}
	
	
	public function chgSpecialCharInputNumber($tempItem)
	{
		if(($tempItem == "0") or ($tempItem == ""))
		{
			$tempItem = "0";
		}
		else
		{
			$tempItem = trim($tempItem);
			$tempItem = htmlspecialchars($tempItem);
			$tempItem = addslashes($tempItem);
		}
		
		return $tempItem;
	}
	
	
	public function decodeCharFromDB($tempItem)
	{
		$tempItem = stripcslashes($tempItem);
		$tempItem = htmlspecialchars_decode($tempItem);
		
		return $tempItem;
	}	
	
	
	public function convertToURL($text) 
	{
		$text = preg_replace("/([a-zA-Z]+:\/\/[a-z0-9\_\.\-]+"."[a-z]{2,6}[a-zA-Z0-9\/\*\-\_\?\&\%\=\,\+\.]+)/"," <a href=\"$1\" target=\"_blank\" class='linkPink'>$1</a>", $text);
		$text = preg_replace("/[^a-z]+[^:\/\/](www\."."[^\.]+[\w][\.|\/][a-zA-Z0-9\/\*\-\_\?\&\%\=\,\+\.]+)/"," <a href='' target=''>$1</a>", $text);
		$text = preg_replace("/([\s|\,\>])([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-z" . "A-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})" . "([A-Za-z0-9\!\?\@\#\$\%\^\&\*\(\)\_\-\=\+]*)" . "([\s|\.|\,\<])/i", "$1<a href=\"mailto:$2$3\">$2</a>$4",
		$text);
		return $text;
	}
	
	
	
	public function uploadOneFile($uploadPath, $fileBoxName, $fileStartNewName)
	{	
		$dFunc = new DateFunction();
		
		$dateNow = $dFunc->getDateChris();
		$timeStamp = $dFunc->changeTimeToHHMMSS($dFunc->getTimeNow());
	
		$strFileName = "-";
		
		if($_FILES[$fileBoxName]["name"][0] != "")
		{
			$extension = pathinfo($_FILES[$fileBoxName]["name"][0], PATHINFO_EXTENSION);
			$strFileName = $fileStartNewName.$dateNow.$timeStamp.".".$extension;
			move_uploaded_file($_FILES[$fileBoxName]["tmp_name"][0], $uploadPath.$strFileName);	
			
			$this->resizeImage($uploadPath.$strFileName, $uploadPath.$fileStartNewName.$dateNow.$timeStamp."Small.".$extension, strtolower($extension), 120, 120);
			
			unset($extension);
		}
		
		unset($dFunc, $dateNow, $timeStamp);
		
		return $strFileName;
	}
	
	
	
	public function uploadMulitFile($uploadPath, $fileBoxName, $fileStartNewName, $fileNO)
	{	
		$dFunc = new DateFunction();
		
		$dateNow = $dFunc->getDateChris();
		$timeStamp = $dFunc->changeTimeToHHMMSS($dFunc->getTimeNow());
		$fileStartNewName = $fileStartNewName.$fileNO;
	
		$strFileName = "-";
		
		if($_FILES[$fileBoxName]["name"][$fileNO] != "")
		{
			$extension = pathinfo($_FILES[$fileBoxName]["name"][$fileNO], PATHINFO_EXTENSION);
			$strFileName = $fileStartNewName.$dateNow.$timeStamp.".".$extension;
			move_uploaded_file($_FILES[$fileBoxName]["tmp_name"][$fileNO], $uploadPath.$strFileName);	
			
			$this->resizeImage($uploadPath.$strFileName, $uploadPath.$fileStartNewName.$dateNow.$timeStamp."Small.".$extension, strtolower($extension), 120, 120);
			
			unset($extension);
		}
		
		unset($dFunc, $dateNow, $timeStamp);
		
		return $strFileName;
	}
	
	
	
	public function uploadAndDeleteOneFile($uploadPath, $fileBoxName, $fileStartNewName, $deletePicName)
	{	
		$dFunc = new DateFunction();
		
		$dateNow = $dFunc->getDateChris();
		$timeStamp = $dFunc->changeTimeToHHMMSS($dFunc->getTimeNow());
	
		$strFileName = "-";
		
		if($_FILES[$fileBoxName]["name"][0] != "")
		{
			$extension = pathinfo($_FILES[$fileBoxName]["name"][0], PATHINFO_EXTENSION);
			$strFileName = $fileStartNewName.$dateNow.$timeStamp.".".$extension;
			move_uploaded_file($_FILES[$fileBoxName]["tmp_name"][0], $uploadPath.$strFileName);	
			
			$this->resizeImage($uploadPath.$strFileName, $uploadPath.$fileStartNewName.$dateNow.$timeStamp."Small.".$extension, strtolower($extension), 120, 120);
			
			unlink($uploadPath.$deletePicName);
			
			$delfile = pathinfo($deletePicName);
			$delSmallFile = $delfile['filename']."Small.".$delfile['extension'];
			unlink($uploadPath.$delSmallFile);
			
			unset($extension, $delSmallFile);
		}
		
		unset($dFunc, $dateNow, $timeStamp);
		
		return $strFileName;
	}
	
	
	
	public function uploadMulitFileAndDeleteOld($uploadPath, $fileBoxName, $fileStartNewName, $fileNO, $deletePicName)
	{	
		$dFunc = new DateFunction();
		
		$dateNow = $dFunc->getDateChris();
		$timeStamp = $dFunc->changeTimeToHHMMSS($dFunc->getTimeNow());
		$fileStartNewName = $fileStartNewName.$fileNO;
	
		$strFileName = "-";
		
		if($_FILES[$fileBoxName]["name"][$fileNO] != "")
		{
			$extension = pathinfo($_FILES[$fileBoxName]["name"][$fileNO], PATHINFO_EXTENSION);
			$strFileName = $fileStartNewName.$dateNow.$timeStamp.".".$extension;
			move_uploaded_file($_FILES[$fileBoxName]["tmp_name"][$fileNO], $uploadPath.$strFileName);	
			
			$this->resizeImage($uploadPath.$strFileName, $uploadPath.$fileStartNewName.$dateNow.$timeStamp."Small.".$extension, strtolower($extension), 120, 120);
			
			unlink($uploadPath.$deletePicName);
			
			$delfile = pathinfo($deletePicName);
			$delSmallFile = $delfile['filename']."Small.".$delfile['extension'];
			unlink($uploadPath.$delSmallFile);
			
			unset($extension, $delSmallFile);
		}
		
		unset($dFunc, $dateNow, $timeStamp);
		
		return $strFileName;
	}
	
	
	public function resizeImage($filename, $newfile, $fileExtension, $width, $height) 
	{ 
		if(($fileExtension == "jpg") or ($fileExtension == "jpeg") or ($fileExtension == "png") or ($fileExtension == "gif"))
		{
			$imageResize = new SimpleImage();
			$imageResize->load($filename);
			$imageResize->resize($width, $height);
			$imageResize->save($newfile);
		}
	} 
	
	
	public function deleteOneFile($uploadPath, $deleteFileName)
	{	
		unlink($uploadPath.$deleteFileName);
		
		$delfile = pathinfo($deleteFileName);
		$delSmallFile = $delfile['filename']."Small.".$delfile['extension'];
		unlink($uploadPath.$delSmallFile);
		
		return true;
	}
	
	
	public function cutHTTPFromLinkYoutube($text)
	{
		$find = 'http';
		$pos = strpos($text, $find);
		$newStr = substr($text, $pos);
		$find = '"';
		$pos = strpos($newStr, $find);
		$newStr = substr($newStr, 0, $pos);
		
		return $newStr;
	}
	
	
	public function thumbImageName($realImgName)
	{		
		if(($realImgName != "-") or ($realImgName != ""))
		{
			$realImgName = pathinfo($realImgName);
			$extension = @$realImgName['extension'];
			$filename = @$realImgName['filename'];
			$newFile = $filename."Small.".$extension;
			
			return $newFile;
		}
		else
		{
			return "";
		}
	}
	
	
	public function calProductPrice($proPrice, $proDiscount)
	{
		$findTxt = strpos($proDiscount, '%');
		$proPrice = intval($proPrice);
		
		if($findTxt > 0)
		{
			$proDiscount = str_replace('%', '', $proDiscount);
			$proDiscount = intval($proDiscount);
			$proDiscount = ($proPrice * $proDiscount)/100;
			$finalPrice = ceil($proPrice - $proDiscount);
		}
		else
		{
			$proDiscount = intval($proDiscount);
			$finalPrice = $proPrice - $proDiscount;
		}
		
		return $finalPrice;
	}
	
	
	public function changeToUTFBlankCheck($tempText)
	{		
		if(mb_detect_encoding($tempText, 'UTF-8'))
		{
			$tempText = $tempText;
			$tempText = htmlspecialchars($tempText);
			$tempText = addslashes($tempText);
		}
		else
		{
			$tempText = trim(iconv('TIS-620', 'UTF-8', $tempText));
			$tempText = htmlspecialchars($tempText);
			$tempText = addslashes($tempText);
		}
		
		if($tempText == '')
		{
			$tempText = '-';
		}
		
		return $tempText;
	}
	
	
	public function changeToUTFBlankCheckZero($tempText)
	{					
		if(mb_detect_encoding($tempText, 'UTF-8'))
		{
			$tempText = $tempText;
			$tempText = htmlspecialchars($tempText);
			$tempText = addslashes($tempText);
		}
		else
		{
			$tempText = trim(iconv('TIS-620', 'UTF-8', $tempText));
			$tempText = htmlspecialchars($tempText);
			$tempText = addslashes($tempText);
		}
		
		if(($tempText == '') or ($tempText == '-'))
		{
			$tempText = 0;
		}
		
		return (int)$tempText;
	}
	
}  // ---- End Class

/*$test = new MainFunction();
$tt = $test->uploadOneFile(1,2);
echo $tt;*/
?> 