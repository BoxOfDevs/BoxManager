<?php
error_reporting(-1);
class Main {
	public function toHTML($content) {
		$content = str_replace("\n", "<br />", $content);
		$content = str_replace("+eol+", "<br />", $content);
		return $content;
	}
}
?>