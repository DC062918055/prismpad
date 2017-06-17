<?php
	session_start();
	if($_SESSION["userId"] != "") {
		header("Location: /prismpad?page=launch");
		die();
	}
	else {
		echo "<script type='text/javascript'>";
		echo "function showRegister() { document.getElementById('register').style.display='block'; }";
		echo "function hideRegister() { document.getElementById('register').style.display='none'; }";
		echo "</script>";
		echo "<script type='text/javascript' src='assets/scripts/registerCheck.js'></script>";
		echo "<div class='login' id='displayBoxLogin'></div>";
		echo "<div class='login' id='contentBoxLogin'>";
		echo "<center><form action='assets/scripts/login.php' method='post' enctype='multipart/form-data'>";
		echo "<h1>myPrism Account</h1>";
		echo "<input class='loginField' type='text' name='username' placeholder='Username' autofocus><br>";
		echo "<div class='space'></div>";
		echo "<input class='loginField' type='password' name='password' placeholder='Password'><br>";
		if($_SESSION["incorrect"]) {
			echo "<span class='error'>Incorrect username or password.</span><br>";
		}
		else if($_SESSION["blank"]) {
			echo "<span class='error'>Please enter a username and password.</span>";
		}
		else {
			echo "<div class='space'></div>";
		}
		$_SESSION["incorrect"] = "";
		echo "<input class='loginButton' type='submit' value='Login'><span class='or'>&nbsp;or&nbsp;</span><input class='loginButton' type='button' value='Register' onclick='showRegister()'></center>";
		echo "</form>";
		echo "</div>";
		echo "<div class='register' id='register'>";
		echo "<img class='right' src='assets/close.png' onclick='hideRegister();'>";
		echo "<h1 class='font-black'>Create a myPrism Account</h1>";
		echo "<div class='registerForm'>";
		echo "<div class='spaceHeader'></div>";
		echo "<form action='assets/scripts/register.php' onsubmit='return checkForm()' method='post' enctype='multipart/form-data' autocomplete='off'>";
		echo "<input type='text' class='registerField' id='firstName' name='fName' placeholder='First Name'>&nbsp;<span class='registerError' id='firstNameError'></span>";
		echo "<div class='spaceRegister'></div>";
		echo "<input type='text' class='registerField' id='surName' name='sName' placeholder='Surname'>&nbsp;<span class='registerError' id='surNameError'></span>";
		echo "<div class='spaceRegister'></div>";
		echo "<input type='text' class='registerField' id='emailAddress' name='eAddr' placeholder='Email Address'>&nbsp;<span class='registerError' id='emailAddressError'></span>";
		echo "<div class='spaceRegister'></div>";
		echo "<input type='text' class='registerField' id='userName' name='uName' placeholder='Username'>&nbsp;<span class='registerHint'>4 to 16 letters and numbers only.</span>&nbsp;<span class='registerError' id='userNameError'></span>";
		echo "<div class='spaceRegister'></div>";
		echo "<input type='password' class='registerField' id='passWord' name='pWord' placeholder='Password'>&nbsp;<span class='registerHint'>6 to 24 characters only.</span>&nbsp;<span class='registerError' id='passWordError'></span>";
		echo "<div class='spaceRegister'></div>";
		echo "<input type='password' class='registerField' id='confirmPassWord' name='conPWord' placeholder='Confirm Password'>&nbsp;<span class='registerError' id='confirmPassWordError'></span>";
		echo "<div class='spaceRegister'></div>";
		echo "<input type='submit' class='registerButton' value='Register'>";
		echo "</form>";
		echo "</div>";
		echo "</div>";
		if($_SESSION["userTaken"] == True) {
			echo "<script type='text/javascript'>";
			echo "document.getElementById('userNameError').innerHTML = 'That username is already taken.';";
			echo "</script>";
		}
		if($_SESSION["registerDisplay"] == True) {
                        echo "<script type='text/javascript'>";
                        echo "showRegister();";
                        echo "</script>";
                }

	}
?>
