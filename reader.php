<?php
if (isset($_GET["thread"])) {
	$id = htmlspecialchars($_GET["thread"]);
	echo $id;
	if(!file_exists("resources/$id.thread")) {
		header("Location: http://boxofdevs.ml/software/index.php");
	} else {
	$contents = file_get_contents("resources/$id.thread");
	$lines = explode("\n", $contents);
	$lid = 1;
	foreach($lines as $line) {
			$linesdiff = explode(": ", $lines[$lid]); // Getting title, version, ect
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
			}
		$lid++;
		}
	$contents = implode("\n", $lines);
	}
}
if(!isset($id)) {
	header("Location: http://boxofdevs.ml/software/index.php");
}
?>
<html>
<head>
<title><?php echo $name . " version " . $version ?></title>
<link rel="stylesheet" href="/css/skel.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" href="/css/style-xlarge.css" />
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
<h3>Plugin <?php echo $title . " version " . $version ?></h3>
				<header class="major">
				 <div class="container">
					<div class="row">
					 <section class="special box">
					 <?php echo $contents ?>
					 </section>
					</div>
				</div>
			</header>
</section>
</body>
</html>
