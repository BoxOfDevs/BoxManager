<?php
$usernameError = $emailError = $passwordError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["name"])) {
		$usernameError = "Please enter an username";
	} elseif(empty($_POST["email"])) {
		$emailError = "Please enter an email";
	} elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$emailError = "Please enter a valid email";
	} elseif(empty($_POST["password"])) {
		$passwordError = "Please enter a password";
	} elseif($_POST["password"] ===! $_POST["confirmpassword"]) {
		$passwordError = "Passwords not match";
	}
$host = "localhost"; //Those are to complete with MySQL informations
$user = "";
$password = "";
$mysql = connection mysql_connect($host, $user, $password);
$db = mysql_select_db("users", $mysql );
$cmd = "INSERT INTO users (name, password, email) VALUES ($_POST['name'], $_POST['password'], $_POST['email']);"
} else {
	echo "<p> Fill the form to register!</p>";
}
?>
<html><head><title>BoxManager - Sign Up</title>
<link rel="icon" href="favicon.png" />
<link rel="stylesheet" href="/css/skel.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" href="/css/style-xlarge.css" >
</head>
<body>
<style>
.error {color: #FF0000;}
</style>
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
					<center>
					<div class="4u">
							<section class="special box">
							Username: <input type="text" name="name" value="<?php echo $_POST["username"];?>">
							<span class="error">* <?php echo $usernameError;?></span>
							<br><br>
							Email: <input type="text" name="email" value="<?php echo $_POST["email"];?>">
							<span class="error">* <?php echo $emailError;?></span>
							<br><br>
							Password: <input type="password" name="password" value="<?php echo $_POST["password"];?>">
							<span class="error">* <?php echo $passwordError;?></span>
							Confirm password: <input type="password" name="confirmpassword" value="<?php echo $_POST["password"];?>">
							<span class="error">* <?php echo $passwordError;?></span>
							</section>
					</div>
					</center>
					</div>
				</div>
				</header>
</section>
</body>
</html>