<?php
require_once("../login/membersite_config.php"); // Check config
$login = $fgmembersite->CheckLogin();
error_reporting(-1);
if(count($_POST) > 0) {
function is_valid_file($id) {
	try {
   
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES[$id]['error']) ||
        is_array($_FILES[$id]['error'])
    ) {
        echo 'Invalid parameters.';
    }

    // Check $_FILES[$id]['error'] value.
    switch ($_FILES[$id]['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            echo 'No file sent.';
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            echo 'Exceeded filesize limit (ERROR 1).';
            break;
        default:
            echo 'Unknown errors.';
    }

    // You should also check filesize here.
    if ($_FILES[$id]['size'] > 1000000) {
        echo 'Exceeded filesize limit (ERROR 2).';
    }

    // DO NOT TRUST $_FILES[$id]['mime'] VALUE !!
    // Check MIME Type by yourself.
    // $finfo = new finfo(FILEINFO_MIME_TYPE);
    // if (false === $ext = array_search(
    //     $finfo->file($_FILES[$id]['tmp_name']),
    //     array(
    //         'jpg' => 'image/jpeg',
    //         'png' => 'image/png',
    //         'gif' => 'image/gif',
    //     ),
    //     true
    // )) {
    //     echo 'Invalid file format.';
    // }

} catch (RuntimeException $e) {

    $error = $e->getMessage();
	return false;

}
return true;
}
if(!$fgmembersite->CheckLogin()) // Check login
{
	echo "<script>alert('You're not logged in ! PLease login before adding anything.');location.replace('login.php');</script>";
	exit();
}
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
if(!isset($_POST['ResourceName']) or empty($_POST['ResourceName'])) {
	$error = "Please enter your resource name.";
	exit();
} elseif(!isset($_POST['ResourceSDesc']) or empty($_POST['ResourceSDesc'])) {
	$error = "Please enter your resource small description. It will be show under your resource name on the pages.";
	exit();
} elseif(!isset($_POST['ResourceVersion']) or empty($_POST['ResourceVersion'])) {
	$error = "Please enter your resource version. You can use versions such as 1.0.";
	exit();
} elseif(!isset($_POST['ResourceDesc']) or empty($_POST['ResourceDesc'])) {
	$error = "Please enter your resource description.";
	exit();
} elseif(!isset($_FILES['ResourceLink']) or !is_valid_file("ResourceLink")) {
    $error = "Invalid resource file ! ";
} elseif(!isset($_FILES['ResourceImage']) or !is_valid_file("ResourceImage")) {
	$error = "Invalid image.";
} else {
	if($fgmembersite->CheckLogin()) {
		$resourcename =$_POST['ResourceName'];
		$resourcesdesc = $_POST['ResourceSDesc'];
		$resourcev = $_POST['ResourceVersion'];
		if(!in_array(explode(".", $_FILES['ResourceLink']['name'])[1], json_decode(file_get_contents("../configs/config.json"), true)["Resources exts"])) {
			$error = "Resource File format not acepeted ! Current accepted formats: ". implode(", ", json_decode(file_get_contents("../configs/config.json"), true)["Resources exts"]);
			exit();
		}
		if(!in_array(explode(".", $_FILES['ResourceImage']['name'])[1], ["jpg", "jpe", "jpeg", "png", "gif", "tiff"])) {
			$error = "Icon File format not acepeted ! Current accepted formats: jpg, jpe, jpeg, png, gif, tiff";
			exit();
		}

		$id = 1;
		while(file_exists("../resources/$id.json/")) {
			$id++;
		}
		if (!move_uploaded_file($_FILES['ResourceLink']['tmp_name'], __DIR__ ."/../downloads/$id." . explode(".", $_FILES['ResourceLink']['name'])[1])) {
			$error = "Potential attack of your resource !
          If this is not right, please contact a server administrator";
		  exit();
		}
		if (!move_uploaded_file($_FILES['ResourceImage']['tmp_name'], __DIR__ ."/../images/$id." . explode(".", $_FILES['ResourceImage']['name'])[1])) {
			$error = "Potential attack of your resource icon !
          If this is not right, please contact a server administrator";
		  exit();
		}
		$resourcedesc = $_POST['ResourceDesc'];
		$cat = $_POST['Category'];

		$resources = new stdClass();// Don't mind me, wanted to use it !
        $resources->Author = $fgmembersite->UserFullName();
        $resources->Name = $resourcename;
        $resources->Title = $resourcesdesc;
		$resources->Download = $_FILES['ResourceLink']['name']; // For downloading
		$resources->Image = explode(".", $_FILES['ResourceImage']['name'])[1]; // Just saving the extension for saving (referenced by id).
        $resources->Id = $id;
		$resources->Reviews = [];
        $resources->Version = $resourcev;
        $resources->Downloads = 0;
        $resources->Text = $resourcedesc;
		$resources->Category = $cat;
		file_put_contents("../waiting-resources/$id.json", json_encode($resources));
		echo "<script>alert('Resource ".$resourcename." has been succefully uploaded.');</script>";
	} else {
		$error = "Please login to upload a resource";
	}
}
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
    <meta lang="en">
  	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
</head>
<body>
	<header id="header" class="skel-layers-fixed">
				<a href="<?php echo json_decode(file_get_contents(__DIR__ . "/../configs/config.json"), true)["Site Main"] ?>"><img src="images/logo.png" height="43" width="43"></img><?php echo json_decode(file_get_contents("../configs/config.json"), true)["Site Name"]; ?></a>
				<nav id="nav">
					<ul>
					<?php
					if(!$login){
						echo <<<A
<li><a href="../signup/">Sign up</a></li>
<li><a href="../login/">Login</a></li>
A;
					} else {
						echo <<<A
<li>Welcome back, {$fgmembersite->UserFullName()}</li>
<li><a href="add/">Add resource</a></li>
<li><a href="login/logout.php">Logout</a></li>
A;
					}
					?>
					</ul>
			</nav>
</header>
<center><br>
<h1>Add resource <span id="name">New resource</span></h1><hr>
<h3><?php echo $error ?></h3>
<form enctype="multipart/form-data" action="index.php" method="post" id="addResource">
<select name="Category" form="addResource">
<?php
foreach(json_decode(file_get_contents("../configs/config.json"), true)["Categories"] as $c) {
	echo "<option value='$c'>$c</option>";
}
?>
</select>
<input type="text" name="ResourceName" id="ResourceName" required class="text-first" onKeyUP="if(this.value != '') {document.getElementById('name').innerHTML = this.value;}else{document.getElementById('name').innerHTML = 'New resource';}" placeholder="Name" />
<input type="text" name="ResourceVersion" id="ResourceVersion" required class="text-finish" placeholder="Version" /><br>
<input type="text" name="ResourceSDesc" id="ResourceSDesc" required class="text-line" placeholder="Resource label (small description of the resource which is featured)" /><br>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" /><br>
<label>Upload resource<input type="file" name="ResourceLink" required id="ResourceLink" /></label><br>
<textarea name="ResourceDesc" required id="ResourceDesc" class="text-description" multiline placeholder="Resource descrpition... Feel free to use all the codes supported by the forums."></textarea><br>
<label>Upload resource image<input type="file" name="ResourceImage" required id="ResourceImage" /></label><br>
<input type="submit" value="Add resource" />
</form>


</body>
