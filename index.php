<html><head><title>BoxManager</title>
<link rel="icon" href="favicon.png" />
<link rel="stylesheet" href="/css/skel.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" href="/css/style-xlarge.css" />
</head>
<body>
<?php
$resources = [];
$dir = 'resources';
$files = array_diff(scandir($dir), array('..', '.')); // getting all resources
foreach($files as $file) {
	$contents = file_get_contents($file);
	$lines = explode("\n", $contents);
	foreach($lines as $line) {
		if(preg_match("/:/i")) {
			$linediff = explode(":", $line); // Getting title, version, ect
			switch(strtolower($linediff[0])) {
				case "title": // if this is the title
				unset($linediff[0]);
				$title = implode(":", $linediff);
				unset($line);
				break;
				case "version": // if this is the vzrsion
				unset($linediff[0]);
				$version = implode(":", $linediff);
				unset($line);
				break;
				case "download": // if this is the download link
				unset($linediff[0]);
				$dllink = implode(":", $linediff);
				unset($line);
				break;
			}
		}
	}
	$contents = implode("\n", $lines);
	array_push($reources, $contents);
}
?>
</body>
</html>