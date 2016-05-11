<?php
error_reporting(-1);
class Codes {
	public function createTag($tagname, $codename, $tagnameopen, $tagnameclose, $result, $description) {
		require_once($codename. DIRECTORY_SEPARATOR . "Main.php");
		$opentag = $this->codes[$codename]->opentag;
		$closetag = $this->codes[$codename]->closetag;
		$lines = file("CUSTOM-CODES");
		array_push($lines, $opentag[0] . $tagnameopen . $opentag[1] .  " , " . $closetag[0] . $tagnameclose . $closetag[1] ." = " . $result);
		file_put_contents("CUSTOM-CODES", implode(PHP_EOL, $lines));
		$this->registerTag($tagname, $opentag[0] . $tagnameopen . $opentag[1], $closetag[0] . $tagnameclose . $closetag[1], $result, $description);
	}
	
	public function __construct($codename, Codes $code) {
		$this->codes[$codename] = $code;
	}
	public function toHTML($contents) {
		foreach($this->codes as $code) {
			$contents = $code->toHTML($contents);
		}
		return $contents;
	}
	public function registerTag($tagname, $open, $close, $result, $description) {
		$lines = file("CODES");
		array_push($lines, $open . " , " . $close . " = " . $result . " &&&" . $description);
		file_put_contents("CODES", implode(PHP_EOL, $lines));
	}
}