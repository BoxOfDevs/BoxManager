<?php
require_once("./membersite_config.php");
$login = $fgmembersite->CheckLogin();
if($login) {
    $fgmembersite->Logout();
    $fgmembersite->RedirectToURL("../");
}