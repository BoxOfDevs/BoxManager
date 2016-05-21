<?php
require('Persistence.php'); // Get the updating script

$db = new Persistence();
if( $db->add_comment($_POST) ) {
  header( 'Location: ./index.php?error=Success!' ); // Go back
}
else {
  header( 'Location: ./index.php?error=Your comment was not posted due to errors in your form submission' ); // If failed
}
?>
