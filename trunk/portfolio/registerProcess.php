<?php
session_start();
$type = $_SESSION["type"];
$firstName = $_SESSION["firstName"];
$idUser = $_SESSION["idUser"];
include 'dataconnect.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Web Designer Brian Beloat - Regsiter</title>
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
		<div id="jobText">
  		<?
			$userName = mysql_real_escape_string($_POST['userName']);
			$userFirstName = mysql_real_escape_string($_POST['userFirstName']);
			$userEmail = mysql_real_escape_string($_POST['userEmail']);
			$userPhone = mysql_real_escape_string($_POST['userPhone']);
			$userPW = md5(mysql_real_escape_string($_POST['userPW']));
			$userPW2 = md5(mysql_real_escape_string($_POST['userPW2']));
			
			$query = "SELECT * FROM User";
			$result = mysql_query($query);

			$numResults = mysql_num_rows($result);

			if (mysql_num_rows($result) == 0) {
	    		echo "No Entries Found";
   				exit;
			}

			// While a row of data exists, put that row in $row as an associative array
			// Note: If you're expecting just one row, no need to use a loop
			while ($row = mysql_fetch_assoc($result)) {
				if ($row[userName] != $userName)
				{
					$usermatch = false;
				}
				else
				{
					$usermatch = true;
				}
			}
			
			if ($username == '')
				{
					$blankfield = true;
				}
			elseif ($userFirstName == '')
				{
					$blankfield = true;
				}
			elseif ($userEmail == '')
				{
					$blankfield = true;
				}
			elseif ($userPhone == '')
				{
					$blankfield = true;
				}
			else $blankfield = false;
			
			if(($userPW == $userPW2)&&($usermatch == false)&&($blankfield == false))
			{
			$sql = "INSERT INTO User(userName,userFirstName,userEmail,userPhone,userPassword,userType) VALUES ('$userName','$userFirstName','$userEmail','$userPhone','$userPW',2)";
			
			$result = mysql_query($sql,$link);

			if ($result == false)
			{
				echo "<br>";
				echo mysql_error();
				echo "Oh no, that didn't work at all!";
				echo "<br /><br />".'<a class="jobTitle" href="register.php">'."Return</a><br /><br />";
			}
			else 
			{
				echo "<br>";
				echo "Account successfully created!";
				echo '<br /><br /><a class="jobTitle" href="portfolio.php">Return</a><br /><br />';
			}
			}
			elseif ($usermatch == true)
			{
				echo "<br>";
				echo "That username is already taken!";
				echo "<br /><br />".'<a class="jobTitle" href="register.php">'."Try Again</a><br /><br />";
			}
			elseif ($blankfield == true)
			{
				echo "<br>";
				echo "Fields cannot be blank! Try again!";
				echo "<br /><br />".'<a class="jobTitle" href="register.php">'."Try Again</a><br /><br />";
			}
			else
			{
				echo "<br>";
				echo "Passwords do not match!";
				echo "<br /><br />".'<a class="jobTitle" href="register.php">'."Try Again</a><br /><br />";
			}
			
	?>
		</div>
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