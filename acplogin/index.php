<html>
<?php
if(isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
}
define(DOC_ROOT,dirname(__FILE__)); // To properly get the config.php file
$username = $_POST['username']; //Set UserName
$password = $_POST['password']; //Set Password
$msg ='';
if(isset($username, $password)) {
    require_once("../config-types/S.php");
    $config = new SConfig("../configs/config");
    if($username === $config->get('Admin username') and $username === $config->get('Admin password')) {
        // Register $myusername, $mypassword and redirect to admin
        session_register("admin");
        session_register("password");
        $_SESSION['name'] = $myusername;
        header("location:admin/index.php");
    } else {
        $msg = "Wrong Username or Password. Please retry";
        header("location:login.php?msg=$msg");
    }
    ob_end_flush();
} else {
    header("location:login.php?msg=Please enter some username and password");
}
?>
<head>
<title>Admin CPanel</title>
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
				<nav id="nav" align="left">
           <ul>
		      <li><img src="images/logo.png" height="43" width="43"></img></li>
				<li><p>Admin CPanel</p></li>
           </ul>
			</nav>
</header>

<section id="one" class="wrapper style1">
<header class="major">
<ul>
<li><a href='index.php?s=users'><p>Manage users<p></a></li>
<li><a href='index.php?s=resources'><p>Manage resources<p></a></li>
<li><a href='index.php?s=mods'><p>Manage moderators<p></a></li>
<li></li>
<li></li>
</ul>
</header>
</section>
</body>
<p><a href="http://boxofdevs.ml">© 2016 BoxManager - BoxOfDevs team.</a></p>
</html>

