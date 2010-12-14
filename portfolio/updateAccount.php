<?php
include 'dataconnect.php';

$idUser = mysql_real_escape_string($_POST['idUser']);
$userFirstName = mysql_real_escape_string($_POST['userFirstName']);
$userEmail = mysql_real_escape_string($_POST['userEmail']);
$userPhone = mysql_real_escape_string($_POST['userPhone']);
$userPW = mysql_real_escape_string($_POST['userPW']);
$userPassword = md5($userPW);
$sql="UPDATE User SET userFirstName='$userFirstName',userEmail='$userEmail',userPhone='$userPhone',userPW='$userPW',userPassword='$userPassword' WHERE idUser='$idUser'";


mysql_query($sql);
if (!mysql_query($sql,$link))
  {
  die('Error: ' . mysql_error() . 'in query '.$sql);
  }
else {
		header("Location: account.php");
}
mysql_close($link);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta HTTP-EQUIV="REFRESH" content="1; url=account.php">
</head>
<body>
</body>