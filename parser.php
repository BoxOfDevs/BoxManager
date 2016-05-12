<?php
error_reporting(-1);
require_once("forumscodes/Codes.php");
include("forumscodes/Codes.php");
class Parser {
public function parse($contents) {
$contents = Codes::toHTML($contents);
$ctags = explode(PHP_EOL, file_get_contents("forumscodes" . DIRECTORY_SEPARATOR . "CUSTOM-CODES"));
foreach($ctags as $ctag) {
	$ctagparts = explode(" = ", $ctag);
	list($ctagopen, $ctagclose) = explode(" , ", $ctagparts[0]);
	if (preg_match("/{url}/i", $ctagopen)) {
	$parts = explode("{url}", $ctagopen);
		$i = explode($parts[0], $contents);
		unset($i[0]); // because the first one is the start of the text so not an image
		foreach($i as $text) {
			$urls = explode($parts[1], $content);
			$url = $urls[0]; // this is the url
			$result = str_replace("{url}", $ctagparts[1]);
			$contents = str_replace($parts[0] . $url . $parts[1] . $ctagclose, $result, $contents);
		}
	} else {
		$content = str_replace($ctagopen . $ctagclose, $ctagparts[1], $contents);
	}
}
return $contents;
}
}
?>