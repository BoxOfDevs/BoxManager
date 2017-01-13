<?php
require_once("login/fg_membersite.php");
error_reporting(-1);
if(!$isResourcesApprover and isset($_GET["isWaiting"])) {
    header("Location: httpindex.php");
} else {
$infos = json_decode(file_get_contents((isset($_GET["isWaiting"]) ? "waiting-resources/" : "resources/") . $_GET["res"] . ".json"));

header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"{$infos->Download}\"");
echo file_get_contents("downloads/" . $_GET["res"] . "." . explode(".", $infos->Download)[1]);
$infos->Downloads++;
file_put_contents((isset($_GET["isWaiting"]) ? "waiting-resources/" : "resources/") . $_GET["res"] . ".json", json_encode($infos));
}