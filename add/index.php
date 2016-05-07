<?php
error_reporting(-1);
require_once("./login/membersite_config.php"); // Check config

if(!$fgmembersite->CheckLogin()) // Check login
{
	echo "<script>location.replace('login.php');</script>";
    $fgmembersite->RedirectToURL("login.php"); // If not logged in, redirect.
}
$error = "";
if(!isset($_POST['AuthorAccName']) or empty($_POST['AuthorAccName'])) {
	$error = "Please enter your username to login to post your resource. If you don't have an account yet, please register using the 'Sign up' button.";
} elseif(!isset($_POST['AuthorAccPass']) or empty($_POST['AuthorAccPass'])) {
	$error = "Please enter your password to login.";
} elseif(!isset($_POST['ResourceName']) or empty($_POST['ResourceName'])) {
	$error = "Please enter your resource name.";
} elseif(!isset($_POST['ResourceSDesc']) or empty($_POST['ResourceSDesc'])) {
	$error = "Please enter your resource small description. It will be show under your resource name on the pages.";
} elseif(!isset($_POST['ResourceVersion']) or empty($_POST['ResourceVersion'])) {
	$error = "Please enter your resource version. You can use versions such as 1.0.";
} elseif(!isset($_POST['ResourceDesc']) or empty($_POST['ResourceDesc'])) {
	$error = "Please enter your resource description.";
} elseif(!isset($_POST['DownloadLink']) or empty($_POST['DownloadLink'])) {
	$error = "Please enter a resource link to download."; // someone knows how to make uploaded files?
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
		while(file_exists("../resources/$id.thread")) {
			$id++;
		}
		file_put_contents("../resources/$id.thread", "Resource $resourcename uploaded by $username". PHP_EOL ."Name: $resourcename". PHP_EOL ."Title: $resourcesdesc". PHP_EOL ."Download: $downloadlink". PHP_EOL ."Id: $id". PHP_EOL ."Text: " . implode("\n", explode(PHP_EOL, $resourcedesc));
	} else {
		$error = "You don't have the permission to upload a resource";
	}
}
?>
<html>
<head>
<title>Upload a resource</title>

<!-- These don't exist! Remove this comment when you do something about it. -->
<link rel="stylesheet" href="/css/skel.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" href="/css/style-xlarge.css" />
<script src="/js/jquery.min.js"></script>
<script src="/js/skel.min.js"></script>
<script src="/js/skel-layers.min.js"></script>
<script src="/js/init.js"></script>
</head>
<body>
<?php echo $error ?>
<!-- 
TODO: Create form
!-->

</body>
