<?php
// The latest version
define('REMOTE_VERSION', 'http://mc-pe.ga/bm/version.txt');

// this is the version of the this script
// REMEMBER TO CHANGE THIS
define('VERSION', '1.0.0');
function isLatest()
{
    $remoteVersion=trim(file_get_contents(REMOTE_VERSION));
    return version_compare(VERSION, $remoteVersion, 'ge');
}
if ($version < $remoteVersion) {
   echo "A new version of the script is available"
} else {
   echo "Your version (" . $version . ") is up to date."
}

 
?>
