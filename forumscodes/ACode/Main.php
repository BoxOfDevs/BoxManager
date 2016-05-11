<?php
error_reporting(-1);
require_once("../Codes.php");
class ACode extends Codes {
	
	public $opentag = ["+", "+"];
	public $closetag = ["-", "-"];
	
	public function __construct() {
		parent::__construct("ACode", $this);
	}
	
	
	public function toHTML($content) {
		$content = str_replace("\n", "<br />", $content);
		$content = str_replace("+eol+", "<br />", $content);
		$content = str_replace("+i+", "<i>", $content);
		$content = str_replace("-i-", "</i>", $content);
		$content = str_replace("+b+", "<b>", $content);
		$content = str_replace("-b-", "</b>", $content);
		$content = str_replace("+u+", "<u>", $content);
		$content = str_replace("-u-", "</u>", $content);
		$content = str_replace("+c=red+", "<bm-color class='red'>", $content);
		$content = str_replace("+c=blue+", "<bm-color class='blue'>", $content);
		$content = str_replace("+c=yellow+", "<bm-color class='yellow'>", $content);
		$content = str_replace("+c=black+", "<bm-color class='black'>", $content);
		$content = str_replace("+c=green+", "<bm-color class='green'>", $content);
		$content = str_replace("+c=white+", "<bm-color class='white'>", $content);
		$content = str_replace("+c=purple+", "<bm-color class='purple'>", $content);
		$content = str_replace("-c-", "</bm-color>", $content);
		$i = explode("+img+", $content);
		unset($i[0]); // because the first one is the start of the text so not an image
		$id = 1;
		foreach($i as $img) {
			$img = $i[$id]; // this is the url
			$content = str_replace("+img+".$img."+img+", "<img src='".$img."'></img>", $content);
			$id++;
		}
		$content = str_replace("+font=veranda+", "<bm-font class='Veranda;'>", $content);
		$content = str_replace("+font=Comic Sans MS+", "<bm-font class='ComicSansMS'>", $content);
		$content = str_replace("+font=Times New Roman+", "<bm-font class='TimesNewRoman;'>", $content);
		$content = str_replace("+font=Courrier+", "<bm-font class='Courrier'>", $content);
		$content = str_replace("+font=Impact+", "<bm-font class='Impact'>", $content);
		$content = str_replace("-font-", "</bm-font>", $content);
		$content = str_replace("+size=1+", "<bm-size class='1'>", $content);
		$content = str_replace("+size=2+", "<bm-size class='2'>", $content);
		$content = str_replace("+size=3+", "<bm-size class='3'>", $content);
		$content = str_replace("+size=4+", "<bm-size class='4'>", $content);
		$content = str_replace("+size=5+", "<bm-size class='5'>", $content);
		$content = str_replace("+size=4+", "<bm-size class='6'>", $content);
		$content = str_replace("+size=5+", "<bm-size class='7'>", $content);
		$content = str_replace("-size-", "</bm-size>", $content);
		return $content;
	}
}
?>