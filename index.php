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
					if($fgmembersite->CheckLogin()){
						echo <<<A
<li><a href="signup/">Sign up</a></li>
<li><a href="login/">Login</a></li>
A
					} else {
						echo <<<A
<li>Welcome back, {$fgmembersite->UserFullName()}</li>
<li><a href="add/">Add resource</a></li>
A
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
error_reporting(-1);
if(file_exists("install/index.php")) {
	echo "<script>location.replace('install/index.php')</script>";
}
foreach(array_diff(scandir("resources/"), array('..', '.')) as $file) {
	$contents = file_get_contents("resources". DIRECTORY_SEPARATOR . $file);
	$infos = json_decode($contents);
	echo <<<A
<div class='4u'>
<section class='special box'>
<a href='reader.php?thread={$infos->Id}'>
<img src='images/{$infos->Name}.png'></img>
<h3>{$infos->Name}</h3>
<br />
<p>{$infos->Title}</p>
</a></section></div>";
?>
</div>
</div>
</header>
</section>
<p><a href="http://boxofdevs.com">Powered by BoxManager - Copyright © BoxOfDevs Team 2016</a></p>
</body>
</html>
