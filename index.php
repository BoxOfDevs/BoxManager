<?php
if(file_exists("install/index.php")) {
	echo "<script>location.replace('install');</script>";
	exit();
}
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
				<a href="<?php var_dump(json_decode(file_get_contents("configs/config.json"), true));echo json_decode(file_get_contents("configs/config.json"), true)["Site Main"] ?>"><img src="images/logo.png" height="43" width="43"></img><?php echo json_decode(file_get_contents("configs/config.json"), true)["Site Name"]; ?></a>
				<nav id="nav">
					<ul>
					<?php
					if($login){
						echo <<<A
<li><a href="signup/">Sign up</a></li>
<li><a href="login/">Login</a></li>
A;
					} else {
						echo <<<A
<li>Welcome back, {$fgmembersite->UserFullName()}</li>
<li><a href="add/">Add resource</a></li>
A;
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
		foreach($infos->Ratings as $p => $rate) {
			$add += $rate[1];
		}
		$r = "☆☆☆☆☆";
		if(count($infos->Ratings) !== 0) {
			$r = "";
			$add /= count($infos->Ratings);
			$r = str_repeat("★", $add) . str_repeat("☆", 5 - $add);
		}
		echo <<<A
<div class='4u'>
<section class='special box'>
<a href='reader.php?thread={$infos->Id}'>
<img src='images/{$infos->Name}.png'></img>
<h3>{$infos->Name}</h3>
<br />
<p>{$infos->Title}</p>
<h4><span style="float: right;">{$r}</span><span style="float: right;">{$infos->Author}</span><span style="float: left;">{$infos->Category}</span></h4>
</a></section></div>"
A;
	} else {
		$contents = file_get_contents("resources". DIRECTORY_SEPARATOR . $file);
		$infos = json_decode($contents);
		if($_GET["category"] == $infos->Category) {
			$add = 0;
			foreach($infos->Ratings as $p => $rate) {
				$add += $rate[1];
			}
			$add /= count($this->Ratings);
			$r = str_repeat("★", $add) . str_repeat("☆", 5 - $add);
		echo <<<A
<div class='4u'>
<section class='special box'>
<a href='reader.php?thread={$infos->Id}'>
<img src='images/{$infos->Name}.png'></img>
<h3>{$infos->Name}</h3>
<br />
<p>{$infos->Title}</p>
<h4><span style="float: right;">{$r}</span><span style="float: right;">{$infos->Author}</span><span style="float: left;">{$infos->Category}</span></h4>
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
<table>
<tr>
<?php
$cs = [];
foreach(json_decode(file_get_contents(__DIR__ . "/configs/config.json"))->Categories as $c) {
	$cs[$c] = 0;
}
foreach(array_diff(scandir(__DIR__ . "/resources"), ["..", "."]) as $i){
	$c = json_decode(file_get_contents(__DIR__ ."/resources". $i))->Category;
	if(!isset($cs[$c])) {
		$cs[$c] = 0;
	}
	$cs[$c]++;
}
foreach($cs as $c => $pls) {
	echo "<a href='index.php?category=$c'><td>$c</td><td>$pls</td>";
}
?>
</tr>
</table>
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
