<?php
class Codes {
	public function createTag($codename, $tagnameopen, $tagnameclose, $result) {
		require_once($codename. DIRECTORY_SEPARATOR . "Main.php");
		$opentag = $this->codes[$codename][1];
		$closetag = $this->codes[$codename][2];
		$lines = file("custom-codes");
		array_push($lines, $opentag[0] . $tagnameopen . $opentag[1] .  " , " . $closetag[0] . $tagnameclose . $closetag[1] ." = " . $result);
		file_put_contents($codename. DIRECTORY_SEPARATOR . "Main.php", implode(PHP_EOL, $lines));
		$this->registertag($opentag[0] . $tagnameopen . $opentag[1], $closetag[0] . $tagnameclose . $closetag[1], $result);
	}
	
	public function __construct($codename, array $opentag, array $closetag) {
		$this->codes[$codename] = array($codename, $opentag, $closetag);
	}
	
	public function registertag($open, $close, $result) {
		
	}
}