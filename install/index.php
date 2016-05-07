<html><head><title>Installation of BoxManager</title>
<link rel="icon" href="favicon.png" />
<script src="/js/jquery.min.js"></script>
<script src="/js/skel.min.js"></script>
<script src="/js/skel-layers.min.js"></script>
<script src="/js/init.js"></script>
<link rel="stylesheet" href="/css/skel.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" href="/css/style-xlarge.css" />
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
					switch($_GET["step"]) {
						case "2":
						if(!isset($_POST['sitename'])) {
							echo "<script>alert('Error, please enter a website name'); location.replace('index.php');</script>";
						} elseif(!isset($_POST['adminname'])) {
							echo "<script>alert('Error, please enter an admin username'); location.replace('index.php');</script>";
						} elseif(!isset($_POST['adminpass'])) {
							echo "<script>alert('Error, please enter an admin password'); location.replace('index.php');</script>";
						} else {
							$config = explode(PHP_EOL, file_get_contents("../config/config.yml"));
							$id = 0;
							foreach($config as $line) {
								$part = explode(": ", $line);
								switch($part[0]) {
									case "Site name":
									$config[$id] = "Site name: $_POST['sitename']";
									break;
									case "Admin username":
									$config[$id] = "Admin username: $_POST['adminname']";
									break;
									case "Admin password":
									$config[$id] = "Site name: $_POST['adminpass']";
									break;
								}
							    $id++;
							}
						echo "<div class='row'>
					<section class='special box'>
					<center><p>MySQL Database</p><center>
					<form action='index.php?step=4' method='post' id='install2'>
					<label for='dataadress'>Where is your database located? *</label>
					<input type='text' id='dataadress' name='dataadress' value='<? echo $databaseadress?>'/>
					<label for='dataname'>What's your database name ? *</label>
					<input type='text' id='dataname' name='dataname'  value='<? echo $databasename ?>'/>
					<label for='dataname'>What's your database admin username ? *</label>
					<input type='text' id='dataadminname' name='dataadminname'  value='<? echo $databaseadminname ?>'/>
					<label for='dataadminpass'>What's your database user password? *</label>
					<input type='password' id='dataadminpass' name='dataadminpass'  value='<? echo $dataadminpass ?>'/>
					</form>
					</section>
					</div>
					</div>";
						}
						case "3":
						if(!isset($_POST['dataadress'])) {
							echo "<script>alert('Error, please enter your database adress'); location.replace('index.php?step=2');</script>";
						} elseif(!isset($_POST['dataname'])) {
							echo "<script>alert('Error, please enter your database name'); location.replace('index.php?step=2');</script>";
						} elseif(!isset($_POST['dataadminname'])) {
							echo "<script>alert('Error, please enter your database admin username'); location.replace('index.php?step=2');</script>";
						} elseif(!isset($_POST['dataadminpass'])) {
							echo "<script>alert('Error, please enter your database admin password'); location.replace('index.php?step=2');</script>";
						} else {
							$config = explode(PHP_EOL, file_get_contents("../configs/config.yml"));
							$id = 0;
							foreach($config as $line) {
								$part = explode(": ", $line);
								switch($part[0]) {
									case "Database address":
									$config[$id] = "Database name: $_POST['dataname']";
									break;
									case "Database name":
									$config[$id] = "Database name: $_POST['dataname']";
									break;
									case "Database admin username":
									$config[$id] = "Admin username: $_POST['adminname']";
									break;
									case "Database admin password":
									$config[$id] = "Site name: $_POST['adminpass']";
									break;
								}
							    $id++;
							}
						echo "You have succefully setup BoxManager! <a href='delete.php'>Click here</a> to delete the installation files!";
						}
					}
				} else {
					$sitename = $adminname = $adminpass = "";
					echo "<div class='container'>
					<div class='row'>
					<section class='special box'>
					<center><p>You will need to complete all the forms that will shown 1 by 1 about your website.</p></center>
					<form action='index.php?step=2' method='post' id='install1'>
					<label for='sitename'>What's your website name? *</label>
					<input type='text' id='sitename' name='sitename' value='<? echo $sitename?>'/>
					<label for='adminname'>What's your username (will be used for administrator account)? *</label>
					<input type='text' id='adminname' name='adminname'  value='<? echo $adminname ?>'/>
					<label for='adminpass'>What's your database admin password?* (will be used for administrator account) *</label>
					<input type='password' id='adminpass' name='adminpass'  value='<? echo $adminpass ?>'/>
					</form>
					</section>
					</div>
					</div>";
				}
				?>
				</header>
</section>
</body>
</html>