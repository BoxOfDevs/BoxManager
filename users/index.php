<?php
if(file_exists("install/index.php")) {
	echo "<script>location.replace('install');</script>";
	exit();
}
session_start();
require_once("../login/membersite_config.php");
$login = $fgmembersite->CheckLogin();
?>
<html>
	<head>
		<title>BoxManager</title>
		<link rel="icon" href="../favicon.png" />
		<script src="../js/jquery.min.js"></script>
		<script src="../js/skel.min.js"></script>
		<script src="../js/skel-layers.min.js"></script>
		<script src="../js/init.js"></script>
		<link rel="stylesheet" href="../css/skel.css" />
		<link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/style-xlarge.css" />
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
				<a href="<?php echo json_decode(file_get_contents("../configs/config.json"), true)["Site Main"]; ?>"><img src="../images/logo.png" height="43" width="43"></img><?php echo json_decode(file_get_contents("configs/config.json"), true)["Site Name"]; ?></a>
				<nav id="nav">
					<ul>
					<?php
					if(!$login){
						echo <<<A
<li><a href="../signup/">Sign up</a></li>
<li><a href="../login/">Login</a></li>
A;
					} else {
						echo <<<A
<li>Welcome back, {$fgmembersite->UserFullName()}</li>
<li><a href="../add/">Add resource</a></li>
A;
                        if($fgmembersite->isAdmin()) {
                            echo '<li><a href="../admin/index.php">Admin CP</a></li>';
                        }
                        if($fgmembersite->isMod()) {
                            echo '<li><a href="../mod/queue.php">Moderation queue</a></li>';
                        }
                        echo '<li><a href="../login/logout.php">Logout</a></li>';
					}
					?>
					</ul>
			</nav>
</header>
<section id="one" class="wrapper style1">
		<header class="major">
				<div class="container" style="border: solid 1px #bbb;border-radius: 7.5px;">
                    
<?php

/*
*| __ )  _____  _|  \/  | __ _ _ __   __ _  __ _  ___ _ __ 
*|  _ \ / _ \ \/ / |\/| |/ _` | '_ \ / _` |/ _` |/ _ \ '__|
*| |_) | (_) >  <| |  | | (_| | | | | (_| | (_| |  __/ |   
*|____/ \___/_/\_\_|  |_|\__,_|_| |_|\__,_|\__, |\___|_|   
*                                           |___/     
*/
if(isset($_GET["n"])) {
    $user = $fgmembersite->getUser($_GET["n"]);
    echo "<h2>" . $user->getUsername() . "<h1 style='display: inline;width: 50%;text-align:center;'>AKA " . $user->getName() . "</h1><a style='display: inline;width: 50%;text-align:center;' href='mailto:" . $user->getEmail() . "'>Email</a></h2>";
} else {
    echo "<h1>Registered users:</h1>
    <table>";
    foreach($fgmembersite->getUsers() as $user) {
        echo "<tr onclick='location.replace(\"?n=" . $user->getUsername() . "\")' style='cursor: pointer;'><td>" . $user->getUsername() . "</td></tr>";
    }
    echo "</table>";
}
?>
                    </div>
            </header>
        </section>
    </body>
</html>