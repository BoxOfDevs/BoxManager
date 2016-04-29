<?php
if (isset($_GET["thread"])) {
	$id = $_GET["thread"];
	if($id === null) {
		header("Location: index.php");
	} else {
	$contents = file_get_contents("resources/$id.thread");
	$lines = explode("\n", $contents);
	foreach($lines as $line) {
		if(preg_match("/:/i")) {
			$linediff = explode(": ", $line); // Getting title, version, ect
			switch(strtolower($linediff[0])) {
				case "name": // if this is the title
				unset($linediff[0]);
				$name = implode(": ", $linediff);
				unset($line);
				break;
				case "title": // if this is the title
				unset($linediff[0]);
				$title = implode(": ", $linediff);
				unset($line);
				break;
				case "version": // if this is the version
				unset($linediff[0]);
				$version = implode(": ", $linediff);
				unset($line);
				break;
				case "download": // if this is the download link
				unset($linediff[0]);
				$dllink = implode(": ", $linediff);
				unset($line);
				break;
			}
		}
	}
	$contents = implode("\n", $lines);
	}
}
if(!isset($id)) {
	header("Location: index.php");
}
?>
<html>
<head>
<title><?php echo $name . " version " . $version?></title>
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
				<header class="major">
				 <div class="container">
					<div class="row">
					 <section class="special box">
					 </section>
					</div>
				</div>
			</header>
</section>
</body>
</html>
