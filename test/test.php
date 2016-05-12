<?php
error_reporting(-1);
$contents = ["Site Name" => "", "Site main" => "/", "Admin username" => "", "Admin password" => ""];
file_put_contents("../configs/config", serialize($contents));