<html><head><title>BoxManager - Moderation Page</title>
<link rel="icon" href="../favicon.png" />
<script src="../js/jquery.min.js"></script>
<script src="../js/skel.min.js"></script>
<script src="../js/skel-layers.min.js"></script>
<script src="../js/init.js"></script>
<link rel="stylesheet" href="../css/skel.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/style-xlarge.css" />
</head>
<body>
<header id="header" class="skel-layers-fixed">
				<a href="<?php echo json_decode(file_get_contents("configs/config.json"), true)["Site Main"] ?>"><img src="images/logo.png" height="43" width="43"></img><?php echo json_decode(file_get_contents("configs/config.json"))->{"Site Name"}; ?></a>
				<nav id="nav">
					<ul>
					<?php
					if(!$fgmembersite->CheckLogin()){
						echo "<script>alert(\"You're not logined !\");location.replace('login.php');</script>";
                        if(!$fgmembersite->isMod()){// Will do this later...
                             echo "<script>alert(\"You're not allowed to view this page !\");location.replace('login.php');</script>";
                        }
                        exit();
					} else {
						echo <<<A
<li>Welcome back, {$fgmembersite->UserFullName()}</li>
<li><a href="../add/">Add resource</a></li>
A;
A;
                        if($fgmembersite->isAdmin()) {
                            echo '<li><a href="../admin/index.php">Admin CP</a></li>';
                        }
                        echo '<li><a href="#">Moderation queue</a></li>';
                        echo '<li><a href="../login/logout.php">Logout</a></li>';
					}
					?>
					</ul>
			</nav>
</header>
<section id="one" class="wrapper style1">
        <center><h1>Moderation page</h1></center></hr />
			<header class="major">
				<div class="container">
					<div class="row">
<?php
echo <<<A
<div class='4u'>
<section class='special box'>
<a href='queue'>
<h3>Moderation queue</h3>
<br />
<p>Approuve or deny people's resources.</p>
</a></section></div>"
A;
?>
                    </div>
                </div>
            </header>
</section>
<p><a href="http://boxofdevs.com">Powered by BoxManager - Copyright © BoxOfDevs Team 2016</a></p>
</body>
</html>
