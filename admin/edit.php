<?php
error_reporting(-1);
require_once("../login/membersite_config.php");
if(!$fgmembersite->isAdmin()) header("Location: httplocation: login.php");
if(!isset($_GET["id"])) {
    header("Location: httplocation: index.php?s=resources");
}
if(isset($_GET["save"])) {
    $json = json_decode(file_get_contents("resources/{$_GET['id']}.json"));
    $json->Text = htmlspecialchars_decode($_GET["save"]);
    file_put_contents("resources/{$_GET['id']}.json", json_encode($json));
    echo "<script>alert('Saved !');</script>";
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
<table>
<tr><td><button class="alt" onClick="document.getElementById('save').src = 'edit.php?id=<? echo $_GET['id']; ?>&save=' + document.getElementById('desc').value;">Save</button><td><td><button class="alt">Cancel</button></td></tr>
</table>
<input style="width: 100%; height: 100%;" type="text" id="desc" value="<?php echo json_decode(file_get_contents("resources/{$_GET['id']}.json"))->Text; ?>" />
<iframe id="save" src="" style='width: 0%; height: 0%;' frameborder=0></iframe>
</body>