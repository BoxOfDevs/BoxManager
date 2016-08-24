<?php
error_reporting(-1);
abstract class Codes {
	
	public function addCode($codename, Codes $code) {
		$this->codes[$codename] = $code;
	}


	public function parse(string $str);


	public function toHTML($contents) {
		foreach($this->codes as $code) {
			$contents = $code->toHTML($contents);
		}
		return $contents;
	}
}