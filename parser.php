<?php
error_reporting(-1);
class Parser {
public function parse($contents) {
	foreach(array_diff(scandir("forums-codes"), array('..', '.')) as $dir) {
	$context = file_get_contents("forums-codes". DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . "main.yml");
	$lines = explode(PHP_EOL, $context);
	$lid = 1;
	foreach($lines as $line) {
			$linediff = explode(": ", $line);
			switch($linediff[0]) {
				case "Name":
				$name = $linediff[1];
				break;
				case "Main": // Getting dir of main file
				$mainfile = $linediff[1];
				break;
			}
	}
	require_once("forums-codes". DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . "Main.php");
	$code = new Main();
	$contents = $code->toHTML($contents);
}
return $contents;
}
}
?>