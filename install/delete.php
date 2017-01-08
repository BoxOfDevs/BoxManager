<html>
<head>
<title>Installation process finished !</title>
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
<p>Installation process finished !</p> <!-- This will only show after PHP execution !-->
<?php
error_reporting(-1);
unlink("index.php");
unlink("delete.php");
rmdir("../install");
require_once("../login/membersite_config.php");
$json = json_decode(file_get_contents("../configs/config.json", true));
mysqli_query($fgmembersite->connection, "INSERT INTO $fgmembersite->tablename VALUES
                (
                '" . $this->SanitizeForSQL($json['Admin username']) . "',
                '" . $this->SanitizeForSQL("webmaster@" . $_SERVER["SERVER_NAME"]) . "',
                '" . $this->SanitizeForSQL($json['Admin username']) . "',
                '" . hash("sha512", $json['Admin password']) . "',
                'y',
                'true,'
                'true,''
                '1'
                )';     ")
?>
<button onClick="location.replace('../index.php');">Go to BoxManager</button>
</body>
</html>
