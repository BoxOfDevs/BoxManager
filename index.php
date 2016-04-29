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
						<li><p>Welcome to the resource manager!</p></li>
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
foreach(scandir("resources/") as $file) {
	$contents = file_get_contents("resources". DIRECTORY_SEPARATOR . $file);
	$lines = explode(PHP_EOL, $contents);
	$lid = 1;
	foreach($lines as $line) {
			$linediff = explode(": ", $line); // Getting title, version, ect
			switch($linediff[0]) {
				case "Name": // if this is the title
				unset($linediff[0]);
				$names = $linediff[1];
				unset($line);
				break;
				case "Title": // if this is the title
				unset($linediff[0]);
				$titles = $linediff[1];
				unset($line);
				break;
				case "Version": // if this is the version
				unset($linediff[0]);
				$versions = $linediff[1];
				unset($line);
				break;
				case "Download": // if this is the download link
				unset($linediff[0]);
				$downloadlinks = $linediff[1];
				unset($line);
				break;
				case "Id": // if this is the id
				unset($linediff[0]);
				$ids = $linediff[1];
				unset($line);
				break;
			}
		$lid++;
		}
		echo "<div class='4u'><section class='special box'><a href='reader.php?thread=$ids'><img src='images/$names.png'><h3>$names</h3><br /><p>$titles</p></a></section></div>";
}
?>
</div>
</div>
</header>
</section>

</body>
</html>
