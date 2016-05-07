<?php
class YamlConfig {
	public function __construct($path) {
		$lines = file($path, FILE_SKIP_EMPTY_LINES);
		$cfg = [];
		foreach($lines as $line) {
			$linesparts = explode(": ", $line);
			array_push($cfg, $lineparts[0] => $lineparts[1]);
		}
	}
	public function __get($name) {
		if(!isset($cfg[$name])) {
			return null;
		} else {
			return $cfg[$name];
		}
	}
	public function __set($name, $content) {
		if(!isset($cfg[$name])) {
			$cfg[$name] = $content;
		} else {
			$cfg[$name] = $content;
		}
	}
	public function __save() {
		file_put_contents($path, implode(PHP_EOL, $cfg));
	}
}