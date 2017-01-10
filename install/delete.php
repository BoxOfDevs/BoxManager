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
<?php
error_reporting(-1);
require_once("../login/membersite_config.php");
$json = json_decode(file_get_contents("../configs/config.json"), true);
if($fgmembersite->DBLogin() && $fgmembersite->CreateTable()) {
    echo shell_exec(strpos(PHP_OS, "WIN") !== false ? "del /S /Q " . __DIR__ : "rm -rf " . __DIR__); // Deleting the folder
    mysqli_query($fgmembersite->connection, "INSERT INTO $fgmembersite->tablename VALUES
                (
                '" . $fgmembersite->SanitizeForSQL($json[array_keys($json)[6]]) . "',
                '" . $fgmembersite->SanitizeForSQL("webmaster@" . $_SERVER["SERVER_NAME"]) . "',
                '" . $fgmembersite->SanitizeForSQL($json[array_keys($json)[6]]) . "',
                '" . hash("sha512", $json[array_keys($json)[7]]) . "',
                'y',
                true,
                true,
                '1'
                )';
        ");
        echo <<<A
<p>Installation process finished !</p>
<button onClick="location.replace('../index.php');">Go to BoxManager</button>
A;
} else {
    echo "We have some trouble connecting to the database. Please restart the installation process here: <button onClick=\"location.replace('index.php');\">Restart installation process</button>";
}
?>
</body>
</html>
