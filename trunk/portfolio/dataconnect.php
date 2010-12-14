<?php
//change these below to match your server
$hostname='hostname.goes.here';
$username='username';
$password='password';
$link = mysql_connect($hostname,$username,$password);
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
else
{
	//change portfolioname to the name of your portfolio
	mysql_select_db('portfolioname') or die('Could not select database.');
}
?>