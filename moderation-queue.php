<?php
if(isset($_GET["approve"])) {
    if(file_exists("waiting-resources/" . $_GET["approve"])) {
        rename("waiting-resources/" . $_GET["approve"], "resources/" . $_GET["approve"]);
        echo "<script>alert(\"Resource approved !\");location.replace('reader.php?thread={$_GET['approve']}');</script>";
    }
}

?>
<html><head><title>BoxManager</title>
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
				<a href="<?php echo json_decode(file_get_contents("configs/config.json"), true)["Site Main"] ?>"><img src="images/logo.png" height="43" width="43"></img><?php echo json_decode(file_get_contents("configs/config.json"))->{"Site Name"}; ?></a>
				<nav id="nav">
					<ul>
					<?php
					if(!$fgmembersite->CheckLogin()){
						echo "<script>alert(\"You're not logined !\");location.replace('login.php');</script>";
                        if(!$isResourceReviewer){// Will do this later...
                             echo "<script>alert(\"You're not allowed to view this page !\");location.replace('login.php');</script>";
                        }
                        exit();
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
<center><h1>Moderation queue</h1></center></hr />
				<header class="major">
				<div class="container">
					<div class="row">
<?php
$c = 0;
error_reporting(-1);
if(file_exists("install/index.php")) {
	echo "<script>location.replace('install/index.php')</script>";
}
foreach(array_diff(scandir("waiting-resources/"), array('..', '.')) as $file) {
	if(!isset($_GET["category"])) {
		$contents = file_get_contents("resources". DIRECTORY_SEPARATOR . $file);
		$infos = json_decode($contents);
		$add = 0;
		foreach($infos->Ratings as $p => $rate) {
			$add += $rate[1];
		}
		$add /= count($this->Ratings);
		for($i = 1; $i <= $add; $i++) {
			$r .= "★";
		}
		for($i = 5; $i > $add; $i--) {
			$r .= "☆";
		}
		echo <<<A
<div class='4u'>
<section class='special box'>
<a href='reader.php?thread={$infos->Id}&isWaiting=true'>
<img src='images/{$infos->Name}.png'></img>
<h3>{$infos->Name}</h3>
<br />
<p>{$infos->Title}</p>
<h4><span style="float: right;">{$r}</span><span style="float: right;">{$infos->Author}</span><span style="float: left;">{$infos->Category}</span></h4>
</a></section></div>"
A;
	} else {
		$contents = file_get_contents("waiting-resources". DIRECTORY_SEPARATOR . $file);
		$infos = json_decode($contents);
		$cs = [];
		foreach(json_decode(file_get_contents("configs/config.json"))["Categories"] as $c){
			if(!isset($cs[$c])) {
				$cs[$c] = 0;
			}
			$cs[$c]++;
		}
		if($_GET["category"] == $infos->Category) {
			$add = 0;
			foreach($infos->Ratings as $p => $rate) {
				$add += $rate[1];
			}
			$add /= count($this->Ratings);
			for($i = 1; $i <= $add; $i++) {
				$r .= "★";
			}
			for($i = 5; $i > $add; $i--) {
				$r .= "☆";
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
<center>
<div class='4u'>
<section class='special box'>
<h3>Categories</h3>
<table>
<tr>
<?php
foreach($cs as $c => $pls) {
	echo "<a href='index.php?category=$c'><td>$c</td><td>$pls</td>";
}
?>
</tr>
</section>
</div>
</center>
</div>
</div>
</header>
</section>
<p><a href="http://boxofdevs.com">Powered by BoxManager - Copyright © BoxOfDevs Team 2016</a></p>
</body>
</html>
