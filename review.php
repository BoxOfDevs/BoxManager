<?php
require("login/fg_membersite")
if(isset($_GET["s"]) and isset($_GET["id"]) and isset($_GET["r"]) and $fgmembersite->CheckLogin()) {
    if(file_exists("resources/" . $_GET["id"] . ".json")){
        $json = json_decode(file_get_contents("resources/" . $_GET["id"] . ".json"));
        $json->Reviews->{$fgmembersite->UserFullName} = [$_GET["s"], $_GET["r"]];
        file_put_contents("resources/" . $_GET["id"] . ".json", json_encode($json));
        echo "<script>location.replace('reader.php?thread={$_GET['id']}');</script>";
    }
}