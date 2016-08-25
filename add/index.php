<?php
error_reporting(-1);
function is_valid_file($id) {
	try {
   
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['upfile']['error']) ||
        is_array($_FILES['upfile']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['upfile']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $_FILES['upfile']['tmp_name'],
        sprintf('./uploads/%s.%s',
            sha1_file($_FILES['upfile']['tmp_name']),
            $ext
        )
    )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    echo 'File is uploaded successfully.';

} catch (RuntimeException $e) {

    $error = $e->getMessage();
	return false;

}
return true;
}
require_once("../login/membersite_config.php"); // Check config
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
} elseif(!isset($FILES['ResourceLink']) or !is_valid_file($FILES['ResourceLink'])) {
	$error = "Invalid download link !";
} elseif(!isset($FILES['ResourceImage']) or !is_valid_file($FILES['ResourceImage'])) {
	$error = "Invalid image.";
} else {
	if($fgmembersite->CheckLogin()) {
		$resourcename =$_POST['ResourceName'];
		$resourcesdesc = $_POST['ResourceSDesc'];
		$resourcev = $_POST['ResourceVersion'];
		if(!in_array(explode(".", $_FILES['ResourceLink']['name'])[1], json_decode(file_get_contents("../configs/config.json")["Resources exts"], true))) {
			$error = "Resource File format not acepeted ! Current accepted formats: ". implode(", ", json_decode(file_get_contents("../configs/config.json"))["Resources exts"]);
			exit();
		}
		if(!in_array(explode(".", $_FILES['ResourceImage']['name'])[1], ["jpg", "jpe", "jpeg", "png", "gif", "tiff"])) {
			$error = "Icon File format not acepeted ! Current accepted formats: jpg, jpe, jpeg, png, gif, tiff";
			exit();
		}
		if (!move_uploaded_file($_FILES['ResourceLink']['tmp_name'], __dir__ ."/../downloads/")) {
			$error = "Potential attack of your resource !
          If this is not right, please contact a server administrator";
		  exit();
		}
		if (!move_uploaded_file($_FILES['ResourceImage']['tmp_name'], __dir__ ."/../images/")) {
			$error = "Potential attack of your resource icon !
          If this is not right, please contact a server administrator";
		  exit();
		}
		rename("../downloads/" . $_FILES['ResourceLink']['tmp_name'], "../downloads/" . $_FILES['ResourceLink']['name']);
		$resourcedesc = $_POST['ResourceDesc'];
		$cat = $_POST['Category'];

		$id = 1;
		while(file_exists("../resources/$id.json/")) {
			$id++;
		}
		rename("../images/" . $_FILES['ResourceImage']['tmp_name'], "../downloads/" . $id. explode(".", $_FILES['ResourceImage']['name'])[1]);
		$resources = new stdClass();// Don't mind me, wanted to use it !
		$resources->Author = $fgmembersite->UserFullName;
        $resources->Name = $resourcename;
        $resources->Title = $resourcesdesc;
		$resources->Download = $_FILES['ResourceLink']['name'];
        $resources->Id = $id;
		$resources->Reviews = [];
        $resources->Version = $resourcev;
        $resources->Downloads = 0;
        $resources->Text = $resourcedesc;
		$resource->Category = $cat;
		file_put_contents("../waiting-resources/$id.json/", json_encode($resources));
		echo "<script>alert('Resource ".$resourcename." has been succefully uploaded.');</script>";
	} else {
		$error = "Please login to upload a resource";
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
</head>
<body>
<center>
<h1>Add resource <span id="name">New resource</span></h1>
<h3><?php echo $error ?></h3>
<form enctype="multipart/form-data" action="index.php" method="post" id="addResource">
<select name="Category" form="addResource">
<?php
foreach(json_decode(file_get_contents("../configs/config.json"), true)["Category"] as $c) {
	echo "<option value='$c'>$c</option>";
}
?>
</select>
<input type="text" name="ResourceName" id="ResourceName" required class="text-first" onKeyUP="if(this.value != '') {document.getElementById('name').innerHTML = this.value;}else{document.getElementById('name').innerHTML = 'New resource';}" placeholder="Resource name" />
<input type="text" name="ResourceVersion" id="ResourceVersion" required class="text-finish" placeholder="Resource version" />
<input type="text" name="ResourceSDesc" id="ResourceSDesc" required class="text-line" placeholder="Resource label (small description of the resource which is featured)" />
<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
<input type="file" name="ResourceLink" required id="ResourceLink" />
<input type="text" name="ResourceDesc" required id="ResourceDesc" class="text-description" placeholder="Resource descrpition... Feel free to use all the codes supported by the forums." />
<input type="image" name="ResourceImage" required id="ResourceImage" />
<input type="submit" value="Add resource" />
</form>


</body>
