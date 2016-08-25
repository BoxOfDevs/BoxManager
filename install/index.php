<?php
error_reporting(-1);
?>
<html>
<head>
<title>Installation of BoxManager</title>
<link rel="icon" href="../favicon.png" />
<script src="../js/jquery.min.js"></script>
<script src="../js/skel.min.js"></script>
<script src="../js/skel-layers.min.js"></script>
<script src="../js/init.js"></script>
<link rel="stylesheet" href="../css/skel.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/style-xlarge.css" />
</head>
<body>
<header id="header" class="skel-layers-fixed">
<center><p>Installation</p></center>
</header>
<section id="one" class="wrapper style1">
				<header class="major">
				<h3>Welcome to BoxManager Installer !</h3><br />
				<p>We will guide you thougth the steps to setup BoxManager</p>
				<?php
				if (isset($_GET["step"])) {
					$config = json_decode(file_get_contents("../configs/config.json"));
					switch($_GET["step"]) {
						case "2":
						if(!isset($_POST['sitename'])) {
							echo "<script>alert('Error, please enter a website name'); location.replace('index.php');</script>";
						} elseif(!isset($_POST['adminname'])) {
							echo "<script>alert('Error, please enter an admin username'); location.replace('index.php');</script>";
						} elseif(!isset($_POST['adminpass'])) {
							echo "<script>alert('Error, please enter an admin password'); location.replace('index.php');</script>";
						} else {
							$config->{"Site name"} = $_POST['sitename'];
							$config->{"Admin username"} = $_POST['adminname'];
							$config->{"Admin password"} = $_POST['adminpass'];							
							file_put_contents("../configs/config.json", json_encode($config));
							$databaseaddress = $databasename = $databaseadminname = $databaseadminpass = "";
					echo "<div class='container'>
					<div class='row'>
					<div class='4u'>
					<p> </p>
					</div>
					<div class='4u'>
					<section class='special box'>
					<center><p>MySQL Database</p><center>
					<form action='index.php?step=3' method='post' id='install2'>
					<label for='dataadress'>Where is your database located? *</label>
					<input type='text' id='dataadress' name='dataaddress' value='".$databaseaddress."'/>
					<label for='dataname'>What's your database name ? *</label>
					<input type='text' id='dataname' name='dataname'  value='".$databasename."'/>
					<label for='dataname'>What's your database admin username ? *</label>
					<input type='text' id='dataadminname' name='dataadminname'  value='".$databaseadminname."'/>
					<label for='dataadminpass'>What's your database user password? *</label>
					<input type='password' id='dataadminpass' name='dataadminpass'  value='".$databaseadminpass."'/>
					<input type='submit' id='submit' value='Submit' name='submit' />
					</form>
					</section>
					</div>
					</div>
					</div>";
						}
						break;
						case "3":
						if(!isset($_POST['dataaddress'])) {
							echo "<script>alert('Error, please enter your database address'); location.replace('index.php?step=2');</script>";
						} elseif(!isset($_POST['dataname'])) {
							echo "<script>alert('Error, please enter your database name'); location.replace('index.php?step=2');</script>";
						} elseif(!isset($_POST['dataadminname'])) {
							echo "<script>alert('Error, please enter your database admin username'); location.replace('index.php?step=2');</script>";
						} elseif(!isset($_POST['dataadminpass'])) {
							echo "<script>alert('Error, please enter your database admin password'); location.replace('index.php?step=2');</script>";
						} else {
							$config->{"Database address"} = $_POST['dataaddress'];
							$config->{"Database name"} = $_POST['dataname'];
							$config->{"Database admin username"} = $_POST['dataadminname'];
							$config->{"Database admin password"} = $_POST['dataadminpass'];
							file_put_contents("../configs/config.json", json_encode($config));
						echo "You have succefully setup BoxManager! <a href='delete.php'>Click here</a> to delete the installation files!";
						}
					}
				} else {
					$sitename = $adminname = $adminpass = "";
					echo "<div class='container'  style='display: false'>
					</div>
					<div class='container'>
					<div class='row'>
					<div class='4u'>
					<p> </p>
					</div>
					<div class='4u'>
					<section class='special box'>
					<center><p>You will need to complete all the forms that will shown 1 by 1 about your website.</p></center>
					<form action='index.php?step=2' method='post' id='install1'>
					<label for='sitename'>What's your website name? *</label>
					<input type='text' id='sitename' name='sitename' value='".$sitename."'/>
					<label for='adminname'>What's your username (will be used for administrator account)? *</label>
					<input type='text' id='adminname' name='adminname'  value='".$adminname ."'/>
					<label for='adminpass'>What's your admin password?* (will be used for administrator account) *</label>
					<input type='password' id='adminpass' name='adminpass'  value='".$adminpass."'/>
					<input type='submit' id='submit' value='Submit' name='submit' />
					</form>
					</section>
					</div>
					</div>
					</div>";
				}
				?>
				</header>
</section>
</body>
</html>
