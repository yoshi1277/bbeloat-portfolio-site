<?php
include 'dataconnect.php';

$jobID = mysql_real_escape_string($_POST['jobID']);
$jobName = mysql_real_escape_string($_POST['jobName']);
$jobInfo = mysql_real_escape_string($_POST['jobInfo']);
$jobNotes = mysql_real_escape_string($_POST['jobNotes']);
$jobETA = mysql_real_escape_string($_POST['jobETA']);
$jobURL = mysql_real_escape_string($_POST['jobURL']);
$clientID = mysql_real_escape_string($_POST['clientID']);
$jobStatus = mysql_real_escape_string($_POST['jobStatus']);
If (isset($_POST["Update"]))
{
  $sql="UPDATE Status SET clientID='$clientID',jobURL='$jobURL',jobName='$jobName',jobInfo='$jobInfo',jobNotes='$jobNotes',jobStatus = $jobStatus,jobETA='$jobETA' WHERE jobID='$jobID'";
}
elseif (isset($_POST["Delete"]))
{
  $sql="DELETE FROM Status WHERE jobID='$jobID'";
}
mysql_query($sql);
if (!mysql_query($sql,$link))
  {
  die('Error: ' . mysql_error() . 'in query '.$sql);
  }
else {
		header("Location: status.php");
}
mysql_close($link);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta HTTP-EQUIV="REFRESH" content="0; url=status.php">
</head>
<body>


</body>