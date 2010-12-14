<?php
include 'dataconnect.php';

$idEntry = mysql_real_escape_string($_POST['idEntry']);
$entryTitle = mysql_real_escape_string($_POST['entryTitle']);
$entryText = mysql_real_escape_string($_POST['entryText']);
$entryPhoto1 = mysql_real_escape_string($_POST['entryPhoto1']);
$entryPhoto2 = mysql_real_escape_string($_POST['entryPhoto2']);
$entryPhoto3 = mysql_real_escape_string($_POST['entryPhoto3']);
$entryPhoto4 = mysql_real_escape_string($_POST['entryPhoto4']);
If (isset($_POST["Update"]))
{
  $sql="UPDATE Portfolio SET entryTitle='$entryTitle',entryText='$entryText',entryPhoto1='$entryPhoto1',entryPhoto2='$entryPhoto2',entryPhoto3='$entryPhoto3',entryPhoto4='$entryPhoto4' WHERE idEntry='$idEntry'";
}
elseif (isset($_POST["Delete"]))
{
  $sql="DELETE FROM Portfolio WHERE idEntry='$idEntry'";
}
mysql_query($sql);
if (!mysql_query($sql,$link))
  {
  die('Error: ' . mysql_error() . 'in query '.$sql);
  }
else {
		header("Location: portfolio.php");
}
mysql_close($link);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta HTTP-EQUIV="REFRESH" content="0; url=portfolio.php">
</head>
<body>
</body>