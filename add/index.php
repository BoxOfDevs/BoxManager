<?php
error_reporting(-1);
require_once("./login/membersite_config.php"); // Check config

if(!$fgmembersite->CheckLogin()) // Check login
{
	echo "<script>alert('You're not logged in ! PLease login before adding anything.');location.replace('login.php');</script>";
}
$error = "";

if(!isset($_POST['ResourceName']) or empty($_POST['ResourceName'])) {
	$error = "Please enter your resource name.";
} elseif(!isset($_POST['ResourceSDesc']) or empty($_POST['ResourceSDesc'])) {
	$error = "Please enter your resource small description. It will be show under your resource name on the pages.";
} elseif(!isset($_POST['ResourceVersion']) or empty($_POST['ResourceVersion'])) {
	$error = "Please enter your resource version. You can use versions such as 1.0.";
} elseif(!isset($_POST['ResourceDesc']) or empty($_POST['ResourceDesc'])) {
	$error = "Please enter your resource description.";
} elseif(!isset($_POST['DownloadLink']) or empty($_POST['DownloadLink'])) {
	$error = "Please enter a resource link to download.";
	// Use: <input type=file id=’file’ "/>
} elseif($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = $_POST['AuthorAccName'];
	$password = $_POST['AuthorAccPass'];
	// use the MySQL setup on what did you use @UltimateMCraft
	if($is_user === true) {
		$resourcename =$_POST['ResourceName'];
		$resourcesdesc = $_POST['ResourceSDesc'];
		$resourcev = $_POST['ResourceVersion'];
		$resourcedesc = $_POST['ResourceDesc'];
		$downloadlink = $_POST['DownloadLink'];
		$id = 1;
		while(file_exists("../resources/$id.json/")) {
			$id++;
		}
		$resources = new stdClass();// Don't mind me, wanted to use it !
        $resources->Name = $resourcename;
        $resources->Title = $resourcesdesc;
        $resources->Id = $id;
        $resources->Version = $resourcev;
        $resources->Download = $downloadlink;
        $resources->Text = $resourcedesc;
		file_put_contents("../resources/$id.json/", json_encode($resources));
		echo "<script>alert('Resource ".$resourcename." has been succefully uploaded.');</script>";
	} else {
		$error = "You don't have the permission to upload a resource";
	}
}
?>
<html>
<head>
<title>Upload a resource</title>

<link rel="stylesheet" href="../css/skel.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/style-xlarge.css" />
<link rel="stylesheet" href="../css/forms.css" />
<script src="../js/jquery.min.js"></script>
<script src="../js/skel.min.js"></script>
<script src="../js/skel-layers.min.js"></script>
<script src="../js/init.js"></script>
</head>
<body>
<center>
<h1>Add resource <span id="name">New resource</span></h1>
<h3><?php echo $error ?></h3>
<form enctype="multipart/form-data" action="index.php" method="post">
<input type="text" name="ResourceName" id="ResourceName" class="text-line" onKeyUP="if(this.value != '') {document.getElementById('name').innerHTML = this.value;}else{document.getElementById('name').innerHTML = 'New resource';}" placeholder="Resource name" />
<input type="text" name="ResourceVersion" id="ResourceVersion" placeholder="Resource version" />
<input type="text" name="ResourceSDesc" id="ResourceSDesc" class placeholder="Resource label (small description of the resource which is featured)" />
<input type="text" name="ResourceLink" id="ResourceLink" placeholder="Resource name" />
<input type="text" name="ResourceDesc" id="ResourceDesc" placeholder="Resource descrpition... Feel free to use all the codes supported by the forums" />
<input type="text" name="ResourceName" id="ResourceName" placeholder="Resource name" />

</form>


</body>
