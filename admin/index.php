<?php
session_start(); //Start the session
define(ADMIN,$_SESSION['name']); //Get the user name from the previously registered super global variable
if(!session_is_registered("admin")){ //If session not registered
header("location:login.php"); // Redirect to login.php page
}
else //Continue to current page
header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Admin CP</title>
</head>
<body>
    <h1>Welcome To Admin Page <?php echo ADMIN /*Echo the username */ ?></h1>
    <p><a href="logout.php">Logout</a></p> <!-- A link for the logout page -->
    <p>ADMIN PAGE CONTENTS HERE</p>
</body>
<p><a href="http://boxofdevs.ml>Powered by BoxManager - Copyright © BoxOfDevs Team 2016.</a></p>
</html>
