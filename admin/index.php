<?php
error_reporting(-1);
require_once("../login/membersite_config.php");
if(!$fgmembersite->isAdmin()) header("location: login.php");
if(!isset($_GET["s"])) {
    $_GET["s"] = "index";
}
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
<?php
switch($_GET["s"]) {
case "index":
echo <<<A
<li><a href='index.php?s=users'><p>Manage users<p></a></li>
<li><a href='index.php?s=resources'><p>Manage resources<p></a></li>
<li><a href='index.php?s=mods'><p>Manage resource approvers<p></a></li>
<li></li>
<li></li>
A;
break;
case "users":
// @UltimateMCraft May you do this?
break;
case "resources":
echo "<li><a href='index.php?s=index'><p>Back to index<p></a></li>";
foreach(array_diff(scandir("../resources"), [".", ".."]) as $res) {
    $infos = json_decode(file_get_contents("../resources/$res"));
    $id = str_ireplace(".json", "", $res);
    echo "<li><p>{$infos->Name}<p><a href='../reader.php?thread=$id'><button class='alt'>View</button></a><a href='index.php?s=resources&deleteRes=$id'><button class='alt'>Delete</button></a><a href='edit.php?id=$id'><button class='alt'>Edit</button></a></li>";
}
break;
}
?>
</ul>
</body>
<p><a href="http://boxofdevs.com">Powered by BoxManager - Copyright © BoxOfDevs Team 2016.</a></p>
</html>
