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
<title>Admin CPanel</title>
<link rel="stylesheet" href="/css/skel.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" href="/css/style-xlarge.css" />
<script src="/js/jquery.min.js"></script>
<script src="/js/skel.min.js"></script>
<script src="/js/skel-layers.min.js"></script>
<script src="/js/init.js"></script>
</head>
<body>
<header id="header" class="skel-layers-fixed">
     <center><p>Admin CPanel</p></center>
				<nav id="nav">
           <ul>
		      <li><img src="images/logo.png" height="43" width="43"></img></li>
           <li><a href="logout.php">Logout</a></li>
           </ul>
			</nav>
</header>
<ul>
<li><a href='index.php?s=users'><p>Manage users<p></a></li>
<li><a href='index.php?s=resources'><p>Manage resources<p></a></li>
<li><a href='index.php?s=mods'><p>Manage moderators<p></a></li>
<li></li>
<li></li>
</ul>
</body>
<p><a href="http://boxofdevs.ml">Powered by BoxManager - Copyright © BoxOfDevs Team 2016.</a></p>
</html>
