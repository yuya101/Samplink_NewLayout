<?php 
session_start();
if($_REQUEST['task']=='add'){ //หากมีการ Submit ข้อมูลผ่าน From มา
	if($_SESSION['security_code']!=$_POST['secret_code']) { // Check 
		echo "<p>คุณใส่รหัสตัวอักษรไม่ถูกต้องกรุณากรอกใหม่</p>";
	}else{
		echo "<p>รหัสถูกต้อง (สามารถใส่โค๊ดบันทีก หรือโค๊ดอะไรก็ได้ที่ต้องการ)</p>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form method="post" action="?task=add">
<input name="name" type="text" /><br /><br />
<input name="detail" type="text" /><br /><br />
<iframe name="a"src="captcha.php?width=100&height=40&characters=5" alt="captcha" frameborder="0" width="120" height="60" scrolling="no"></iframe>
<a href="captcha.php?width=100&height=40&characters=5" target="a"><img src="images/refresh.gif" width="13" height="13"  border="0" /></a><br />
<br />
พิมพ์อักขระ ตามที่คุณเห็นในภาพ  วิธีการนี้จะช่วยป้องกันการลงทะเบียนโดยอัตโนมัติ<br />
<input name="secret_code" type="text" /><br /><br />
<input  type="submit" value="submit" />
</form>
</body>
</html>