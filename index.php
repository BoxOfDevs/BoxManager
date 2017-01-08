<?php
if(file_exists("install/index.php")) {
	echo "<script>location.replace('install');</script>";
	exit();
}
session_start();
require_once("./login/membersite_config.php");
$login = $fgmembersite->CheckLogin();
?><html>
	<head>
		<title>BoxManager</title>
		<link rel="icon" href="favicon.png" />
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-xlarge.css" />
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
				<a href="<?php echo json_decode(file_get_contents("configs/config.json"), true)["Site Main"] ?>"><img src="images/logo.png" height="43" width="43"></img><?php echo json_decode(file_get_contents("configs/config.json"), true)["Site Name"]; ?></a>
				<nav id="nav">
					<ul>
					<?php
					if(!$login){
						echo <<<A
<li><a href="signup/">Sign up</a></li>
<li><a href="login/">Login</a></li>
A;
					} else {
						echo <<<A
<li>Welcome back, {$fgmembersite->UserFullName()}</li>
<li><a href="add/">Add resource</a></li>
A;
                        if($fgmembersite->isAdmin()) {
                            echo '<li><a href="admin/index.php">Admin CP</a></li>';
                        }
                        if($fgmembersite->isMod()) {
                            echo '<li><a href="../moderation-queue.php">Moderation queue</a></li>';
                        }
                        echo '<li><a href="login/logout.php">Logout</a></li>';
					}
					?>
					</ul>
			</nav>
</header>
<section id="one" class="wrapper style1">
				<header class="major">
				<div class="container">
					<div class="row">
<?php
$c = 0;
error_reporting(-1);
foreach(array_diff(scandir("resources/"), array('..', '.')) as $file) {
	if(!isset($_GET["category"])) {
		$contents = file_get_contents("resources". DIRECTORY_SEPARATOR . $file);
		$infos = json_decode($contents);
		$add = 0;
		foreach($infos->Reviews as $p => $rate) {
			$add += $rate[1];
		}
		$r = "☆☆☆☆☆";
		if(count($infos->Reviews) !== 0) {
			$r = "";
			$add /= count($infos->Reviews);
			$r = str_repeat("★", $add) . str_repeat("☆", 5 - $add);
		}
		echo <<<A
<div class='4u'>
<section class='special box'>
<a href='reader.php?thread={$infos->Id}'>
<img src='images/{$infos->Id}.{$infos->Image}' style="width: 50px; height: 50px;"></img>
<h3>{$infos->Name}</h3>
<br />
<p>{$infos->Title}</p>
<h4>{$r}<br>By {$infos->Author}<br>{$infos->Category}</h4>
</a></section></div>"
A;
	} else {
		$contents = file_get_contents("resources". DIRECTORY_SEPARATOR . $file);
		$infos = json_decode($contents);
		if(htmlspecialchars_decode($_GET["category"]) == $infos->Category) {
			$add = 0;
			foreach($infos->Reviews as $p => $rate) {
				$add += $rate[1];
			}
			$add /= count($infos->Reviews);
			$r = str_repeat("★", $add) . str_repeat("☆", 5 - $add);
		echo <<<A
<div class='4u'>
<section class='special box'>
<a href='reader.php?thread={$infos->Id}'>
<img src='images/{$infos->Id}.{$infos->Image}' style="width: 50px; height: 50px;"></img>
<h3>{$infos->Name}</h3>
<br />
<p>{$infos->Title}</p>
<h4>{$r}<br>By {$infos->Author}<br>{$infos->Category}</h4>
</a></section></div>"
A;
		}
		
	}
	$c++;
	if($c == 3) {
		echo '</div><div class="row">';
	}
}
?>
</div>
<div class="row">
<center style="width: 100%;">
<div class='4u'>
<section class='special box'>
<h3>Categories</h3>
<?php
$cs = [];
foreach(json_decode(file_get_contents(__DIR__ . "/configs/config.json"))->Categories as $c) {
	$cs[$c] = 0;
}
foreach(array_diff(scandir(__DIR__ . "/resources"), ["..", "."]) as $i){
	$c = json_decode(file_get_contents(__DIR__ ."/resources/". $i))->Category;
	if(!isset($cs[$c])) {
		$cs[$c] = 0;
	}
	$cs[$c]++;
}
foreach($cs as $c => $pls) {
	echo "<a href='index.php?category=$c' style='text-decoration: none;border-top: solid 1px black;'><span>$c</span> <span style='float: right;'>$pls</span></a>";
}
?>
</section>
</div>
</center><br>
<p><a href="http://boxofdevs.com">Powered by BoxManager - Copyright © BoxOfDevs Team 2016</a></p>
</div>
</div>
</header>
</section>
</body>
</html>
