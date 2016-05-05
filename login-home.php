<?PHP
require_once("./login/membersite_config.php"); // Check config

if(!$fgmembersite->CheckLogin()) // Check login
{
    $fgmembersite->RedirectToURL("login.php"); // If not logged in, redirect.
    exit;
}
?>
