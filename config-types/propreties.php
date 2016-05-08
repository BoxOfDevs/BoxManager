<?php
error_reporting(-1);
class PropretiesConfig {
	public function __construct($path) {
		$lines = file($path, FILE_SKIP_EMPTY_LINES);
		$this->cfg = [];
		foreach($lines as $line) {
			$lineparts = explode("=", $line);
			if(isset($lineparts[1])) {
				$this->cfg[$lineparts[0]] = $lineparts[1];
			}
		}
	}
	public function get($name) {
			return $this->cfg[$name];
	}
	public function set($name, $content) {
			$this->cfg[$name] = $content;
	}
	public function save() {
		file_put_contents($path, implode(PHP_EOL, $this->cfg));
	}
}