<?php
class Codes {
	public function createTag($tagname, $codename, $tagnameopen, $tagnameclose, $result, $description) {
		require_once($codename. DIRECTORY_SEPARATOR . "Main.php");
		$opentag = $this->codes[$codename][1];
		$closetag = $this->codes[$codename][2];
		$lines = file("CUSTOM-CODES");
		array_push($lines, $opentag[0] . $tagnameopen . $opentag[1] .  " , " . $closetag[0] . $tagnameclose . $closetag[1] ." = " . $result);
		file_put_contents("CUSTOM-CODES", implode(PHP_EOL, $lines));
		$this->registerTag($tagname, $opentag[0] . $tagnameopen . $opentag[1], $closetag[0] . $tagnameclose . $closetag[1], $result, $description);
	}
	
	public function __construct($codename, array $opentag, array $closetag) {
		$this->codes[$codename] = array($codename, $opentag, $closetag);
	}
	
	public function registerTag($tagname, $open, $close, $result, $description) {
		$lines = file("CODES");
		array_push($lines, $open . " , " . $close . " = " . $result . " &&&" . $description);
		file_put_contents("CODES", implode(PHP_EOL, $lines));
	}
}