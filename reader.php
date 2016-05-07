<?php
error_reporting(-1);
require_once("parser.php");
if (isset($_GET["thread"])) {
	$id = htmlspecialchars($_GET["thread"]);
	
	if(!file_exists("resources/$id.thread")) {
	echo "<script>location.replace('index.php');</script>";
	} else {
	$contents = file_get_contents("resources/$id.thread");
	$lines = explode("\n", $contents);
	$lid = 1;
	foreach($lines as $line) {
			$linesdiff = explode(": ", $line); // Getting title, version, ect
			switch($linesdiff[0]) {
				case "Name": // if this is the title
				unset($linesdiff[0]);
				$name = implode(": ", $linesdiff);
				unset($lines[$lid]);
				break;
				case "Title": // if this is the title
				unset($linesdiff[0]);
				$title = implode(": ", $linesdiff);
				unset($lines[$lid]);
				break;
				case "Version": // if this is the version
				unset($linesdiff[0]);
				$version = implode(": ", $linesdiff);
				unset($lines[$lid]);
				break;
				case "Download": // if this is the download link
				unset($linesdiff[0]);
				$dllink = implode(": ", $linesdiff);
				unset($lines[$lid]);
				break;
				case "Text": // if this is the download link
				unset($linesdiff[0]);
				$contents = implode(": ", $linesdiff);
				$parse = new Parser();
				$contents = $parse->parse($contents);
				unset($lines[$lid]);
				break;
			}
		$lid++;
		}
	}
}
if(!isset($id)) {
	echo "<script>location.replace('index.php');</script>";
}
?>
<html>
<head>
<title><?php echo $name . " version " . $version ?></title>
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
				<a href="http://boxofdevs.ml"><img src="http://boxofdevs.ml/BODLogo.png" height="43" width="43"></img></a>
				<nav id="nav">
					<ul>
						<li><a href="signup/">Sign up</a></li>
						<li><a href="login/">Login</a></li>
					</ul>
			</nav>
</header>

<section id="one" class="wrapper style1">
<center><img src='images/<? echo $name ?>.png'></img><h3>Resource <?php echo $name . " version " . $version ?></h3></center><center><a class="button big special" href="<? echo $dllink?>">Download plugin</a></center>
				<header class="major">
				 <div class="container">
					 <section class="special box">
					 <?php echo $contents ?>
					 <?php include 'ratings/hrat.php'?>
					 </section>
				</div>
			</header>
</section>
</body>
<p><a href="http://boxofdevs.ml>© 2016 BoxManager - BoxOfDevs team.</a></p>
</html>
