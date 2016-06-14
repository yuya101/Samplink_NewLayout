<?php
require_once("dimText.php");
require_once($classPath."connect_db.php");

session_start();
  
class Captcha {
	 
	   public $font;  // เปลี่ยน font ได้ตามต้องการ
	 
	   function generateCode($characters) {
		  $possible = 'abcdefghjkmnpqrstvwxyz';  // ตัวอักษรที่ต้องการจะเอาสุ่มเป็น Captcha
		  $code = '';
		  $i = 0;
		  while ($i < $characters) { 
			 $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			 $i++;
		  }
		  return $code;
	   }
	 
	   function Captcha($width='120',$height='40',$characters='6',$font) {
		  $this->font = $font;
		  $code = $this->generateCode($characters);
		  $font_size = $height * 0.9;  // font size ที่จะโชว์ใน Captcha
		  $image = imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		  $background_color = imagecolorallocate($image, 255, 255, 255);  // กำหนดสีในส่วนต่่างๆ
		  $text_color = imagecolorallocate($image, 141, 192, 42);
		  $noise_color = imagecolorallocate($image, 172, 208, 95);
		  for( $i=0; $i<($width*$height)/5; $i++ ) { // สุ่มจุดภาพพื้นหลัง
			 imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		  }
		  for( $i=0; $i<($width*$height)/200; $i++ ) { // สุ่มเ้ส้นภาพพื้นหลัง
			 imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		  }
		  /* สร้าง Text box และเพิ่ม Text */
		  $textbox = imagettfbbox($font_size, 0, $this->font, $code) or die('Error in imagettfbbox function');
		  $x = ($width - $textbox[4])/2;
		  $y = ($height - $textbox[5])/2;
		  imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code) or die('Error in imagettftext function');
		  /* display captcha image ไปที่ browser */
		  header('Content-Type: image/jpeg');
		  imagejpeg($image);
		  imagedestroy($image);
		  $_SESSION['security_code'] = $code;
	   }
	 
	}
	 
	$width = isset($_GET['width']) && $_GET['height'] < 600 ? $_GET['width'] : '120';
	$height = isset($_GET['height']) && $_GET['height'] < 200 ? $_GET['height'] : '40';
	$characters = isset($_GET['characters']) && $_GET['characters'] > 2 ? $_GET['characters'] : '6';
	$font = $imagePath."font.ttf";
	 
	$captcha = new Captcha($width,$height,$characters,$font);
?> 