<?php
session_start();
$type = $_SESSION["type"];
$firstName = $_SESSION["firstName"];
include 'dataconnect.php';

// Original PHP code by Chirp Internet: www.chirp.com.au // Please acknowledge use of this code by including this header.
function myTruncate($string, $limit, $break=".", $pad="...") { 
	// return with no change if string is shorter than $limit
	if(strlen($string) <= $limit) return $string; 

	// is $break present between $limit and the end of the string?
	if(false !== ($breakpoint = strpos($string, $break, $limit))) { 
		if($breakpoint < strlen($string) - 1) { 
			$string = substr($string, 0, $breakpoint) . $pad; 
		}
	} return $string;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Web Designer Brian Beloat - Portfolio</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
  <div class="header"><img src="img/logo.png" alt="Insert Logo Here" name="Insert_logo" width="180" height="160" id="Insert_logo" style="background:none;" />
  <!--button one-->
  <div id="portfolioButton" style="height:30; width:90; position:absolute; left:210px; top:70px;">
  	<a href="portfolio.php"><img src="img/portfolio.jpg" width="90" height="30" id="portfolio_button" alt="Portfolio" /></a></div>
  <!--button two-->
  <div id="projectsButton" style="height:30; width:90; position:absolute; left:340px; top:70px;">
  	<a href="status.php"><img src="img/projects.jpg" width="90" height="30" id="projects_button" alt="Projects" /></a></div>
  <!--button three depends on the user type-->
  <?
  	if ($type == "admin")
	{
		echo '<div id="adminButton" style="height:30; width:90; position:absolute; left:470px; top:70px;">';
  		echo '<a href="admin.php"><img src="img/admin.jpg" width="90" height="30" id="admin_button" alt="Admin" /></a></div>'."\n";
	}
	elseif (($type != "admin")&&($type != "user"))
	{
		echo '<div id="accountButton" style="height:30; width:90; position:absolute; left:470px; top:70px;">';
  		echo '<a href="register.php"><img src="img/account.jpg" width="90" height="30" id="register_button" alt="Register" /></a></div>'."\n";
	}
	else
	{
		echo '<div id="accountButton" style="height:30; width:90; position:absolute; left:470px; top:70px;">';
  		echo '<a href="account.php"><img src="img/account.jpg" width="90" height="30" id="account_button" alt="Account" /></a></div>'."\n";
	}
  ?>
  <!--button four-->
  <div id="aboutButton" style="height:30; width:90; position:absolute; left:600px; top:70px;">
  	<a href="about.php"><img src="img/about.jpg" width="90" height="30" id="about_button" alt="About" /></a></div>
  <!--login/logout window-->
  <div id="login" style="height:160; width:190; color:white; right:0px; margin-left:auto; top:30px; position:absolute;" align="right">
  <?
  	if (($type != "admin")&&($type != "user"))
	{
		echo '<form id="loginForm" action="login.php" method="post">'."\n";
		echo '<label for="userName">Username:</label><input name="userName" id="userName" class="required"><br />'."\n";
		echo '<label for="password">Password:</label><input type="password" name="password" id="password"<br /><br />'."\n";
		echo '<a class="entryTitle" href="register.php">Register</a>'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<input type="submit" value="Login"><br />'."\n";
		echo '</form>'."\n";
		echo '<a class="entryTitle" href="iforgot.php">Forgotten Password?</a>';	
	}
	else
	{
		echo '<center><b>Welcome, '.$firstName.'!</b></center>'."\n";
		echo '<br /><br /><a class="entryTitle" href="logout.php">Logout</a>'."\n";
	}
  ?>
  </div>
  <!-- end .header --></div>
  <div class="content">
    <?
    $query = "SELECT * FROM Portfolio";
	$result = mysql_query($query);

	if ($result == "")
		{
			$numResults = 0;
		}
		else 
		{
			$numResults = mysql_num_rows($result);
		}

	if ($numResults == 0) {
	    echo '<br /><div id="jobTitle">'."There are no portfolio items available at this time!".'</div>'."\n";
   		exit;
	}

	// While a row of data exists, put that row in $row as an associative array
	// Note: If you're expecting just one row, no need to use a loop
	while ($row = mysql_fetch_assoc($result)) {
		$convDate = strtotime($row["entryDate"]);
		echo '<div id="portfolioTitle">'."\n".'<b>'.$row["entryTitle"]." - " . date('M d, Y',$convDate) . "</b></br></div>"."\n";
		$shortDesc = myTruncate($row["entryText"],150,'.');
		echo '<div id="portfolioText">'.$shortDesc.'<br />'."\n";
		echo "<a class='entryTitle' href='portfolioView.php?idEntry=". $row["idEntry"] ."'>";
		echo 'More...</a>'."\n".'<br /><br />'."\n";
 	    if ($row["entryPhoto1"] != '') echo '<b>Pictures:</b><br />'.'<img src="'.$row["entryPhoto1"].'"><br /><br />'."\n";
		if ($row["entryPhoto2"] != '') echo '<img src="'.$row["entryPhoto2"].'"><br /><br />'."\n";
		if ($row["entryPhoto3"] != '') echo '<img src="'.$row["entryPhoto3"].'"><br /><br />'."\n";
		if ($row["entryPhoto4"] != '') echo '<img src="'.$row["entryPhoto4"].'"><br /><br />'."\n";
	   	echo '</div><br />';
	}
	//end .content
	mysql_free_result($result);
	mysql_close($link);
    ?>
  </div>
  <div class="footer">
        <center>
       		<b>Site Design by <script type="text/javascript" language="javascript">
<!--
// Email obfuscator script 2.1 by Tim Williams, University of Arizona
// Random encryption key feature by Andrew Moulden, Site Engineering Ltd
// This code is freeware provided these four comment lines remain intact
// A wizard to generate this code is at http://www.jottings.com/obfuscator/
{ coded = "t7eEu@DuVSADEC7Sh.t78"
  key = "sXe2mvRQOc0ZwnpkGYaxDo5Eq8z4TrtfJiAlFBgSHU7dNM39jWuhy6VIC1KPLb"
  shift=coded.length
  link=""
  for (i=0; i<coded.length; i++) {
    if (key.indexOf(coded.charAt(i))==-1) {
      ltr = coded.charAt(i)
      link += (ltr)
    }
    else {     
      ltr = (key.indexOf(coded.charAt(i))-shift+key.length) % key.length
      link += (key.charAt(ltr))
    }
  }
document.write("<a class='entryTitle' href='mailto:"+link+"'>Brian Beloat</a>")
}
//-->
</script><noscript>Sorry, you need Javascript on to email me.</noscript></b><br />
            Website Code <a class="entryTitle" href="https://code.google.com/p/bbeloat-portfolio-site/">Available Here</a><br />
        </center>
  <!-- end .footer --></div>
</div><!-- end .container -->
</body>
</html>