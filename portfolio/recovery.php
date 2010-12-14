<?php
session_start();
$type = $_SESSION["type"];
$firstName = $_SESSION["firstName"];
$idUser = $_SESSION["idUser"];
include 'dataconnect.php';
$userEmail = mysql_real_escape_string($_POST['userEmail']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Web Designer Brian Beloat - Password Recovery</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header"><img src="img/logo.png" alt="Insert Logo Here" name="Insert_logo" width="180" height="160" id="Insert_logo" style="background:none;" />
  <!--button one-->
  <div id="portfolioButton" style="height:30; width:90; position:absolute; left:210px; top:70px;">
  	<a href="portfolioEntry.php"><img src="img/portfolio.jpg" width="90" height="30" id="portfolio_button" alt="Portfolio" /></a></div>
  <!--button two-->
  <div id="projectsButton" style="height:30; width:90; position:absolute; left:340px; top:70px;">
  	<a href="jobEntry.php"><img src="img/projects.jpg" width="90" height="30" id="projects_button" alt="Projects" /></a></div>
  <!--button three-->
  <div id="accountButton" style="height:30; width:90; position:absolute; left:470px; top:70px;">
  <a href="account.php"><img src="img/account.jpg" width="90" height="30" id="account_button" alt="Account" /></a></div>
  <!-- button four -->
  <div id="exitButton" style="height:30; width:90; position:absolute; left:600px; top:70px;">
  	<a href="portfolio.php"><img src="img/exit.jpg" width="90" height="30" id="exit_button" alt="Exit" /></a></div>
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
    $query = "SELECT * FROM User";
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
	        echo '<br /><div id="jobTitle">'."Please check user database!".'</div>'."\n";
   		exit;
	}

	// While a row of data exists, put that row in $row as an associative array
	// Note: If you're expecting just one row, no need to use a loop
	while ($row = mysql_fetch_assoc($result)) {
		if ($row[userEmail] == $userEmail)
		{
			$subject = "Password Recovery - BrianBeloat.com";
 			$body = "Your password is: ".$row[userPW];
 			if (mail($userEmail, $subject, $body)) {
   				echo '<br /><div id="jobTitle">'."Your password has been sent. Please wait up to 15 minutes.".'<br /><br />'."\n";
				echo "<br /><br />".'<a class="jobTitle" href="iforgot.php">'."Return</a><br /></div>";
				exit;
 			}
			else {
   				echo '<br /><div id="jobTitle">'."Email send incomplete. Please contact us directly!".'<br /><br />'."\n";
				echo "<br /><br />".'<a class="jobTitle" href="about.php">'."Our Contact Info</a><br /></div>";
  			}
		}
		else
		{
			$matchingmail = false;
		}
	}
	
	if ($matchingmail == false)
	{
		echo '<br /><div id="jobTitle">'."Email address not found, please try again".'<br /><br />'."\n";
		echo "<br /><br />".'<a class="jobTitle" href="iforgot.php">'."Return</a><br /></div>";
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
