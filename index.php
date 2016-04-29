<html><head><title>BoxManager</title>
<link rel="icon" href="favicon.png" />
<link rel="stylesheet" href="/css/skel.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" href="/css/style-xlarge.css" />
</head>
<body>
<header id="header" class="skel-layers-fixed">
				<a href="http://boxofdevs.x10host.com"><img src="http://boxofdevs.x10host.com/BODLogo.png" height="43" width="43"></img></a>
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
<?php
$resources = [];
$dir = 'resources';
$files = array_diff(scandir($dir), array('..', '.')); // getting all resources
foreach($files as $file) {
	$contents = file_get_contents($file);
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
				case "Id": // if this is the title
				unset($linediff[0]);
				$id = $linediff[1];
				unset($line);
				break;
			}
		}
	}
	$contents = implode("\n", $lines);
	array_push($resources, $contents);
}
foreach($resources as $resource) {
	echo '<div class="4u">
							<section class="special box">
							<a href="resources/reader.php?thread="'. $id .'">
							<img src="images/' . $name . '.png"><h3> '.$name.'</h3><br />
							<p>  '. $title .'</p>
							</a>
							</section>
					</div>';
}
?></div></div></header></section>

</body>
</html>