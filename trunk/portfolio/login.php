<?php
session_start();

include 'dataconnect.php';

//username and password sent from form.
$userName = $_POST["userName"];
$password = $_POST["password"];

//encrypt password
$encryptPassword = md5($password);

$query = "SELECT idUser,userName,userPassword,userType,userFirstName FROM User WHERE userName='$userName' and userPassword='$encryptPassword'";
$result = mysql_query($query, $link);
$row = mysql_fetch_assoc($result);
$userType = $row[userType];
	if($userType == 1)
	{
		$_SESSION["type"] = "admin";
		$_SESSION["firstName"] = $row[userFirstName];
		$_SESSION["idUser"] = $row[idUser];
		header("Location: portfolio.php");
	}
	elseif($userType == 2)
	{
		$_SESSION["type"] = "user";
		$_SESSION["firstName"] = $row[userFirstName];
		$_SESSION["idUser"] = $row[idUser];
		header("Location: portfolio.php");
	}
	else
	{
		$_SESSION["type"] = "failed";
		header("Location:portfolio.php");
	}
?>