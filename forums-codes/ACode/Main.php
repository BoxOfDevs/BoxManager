<?php
error_reporting(-1);
class Code {
	public function toHTML($content) {
		$content = str_replace("\n", "<br />", $content);
		$content = str_replace("+eol+", "<br />", $content);
		$content = str_replace("+i+", "<i>", $content);
		$content = str_replace("-i-", "</i>", $content);
		$content = str_replace("+b+", "<b>", $content);
		$content = str_replace("-b-", "</b>", $content);
		$content = str_replace("+u+", "<u>", $content);
		$content = str_replace("-u-", "</u>", $content);
		$content =  str_replace($content, $content . "<script>var Color = document.registerElement('color');document.body.appendChild(new Color());var Font = document.registerElement('a-font');document.body.appendChild(new Font());var Size = document.registerElement('a-size');document.body.appendChild(new Size());</script>", $content);
		$content = str_replace("+c=red+", "<style>a-color{color: red}</style><a-color>", $content);
		$content = str_replace("+c=blue+", "<style>a-color{color: blue}</style><a-color>", $content);
		$content = str_replace("+c=yellow+", "<style>a-color{color: yellow}</style><a-color>", $content);
		$content = str_replace("+c=black+", "<style>a-color{color: black}</style><a-color>", $content);
		$content = str_replace("+c=green+", "<style>a-color{color: green}</style><a-color>", $content);
		$content = str_replace("+c=white+", "<style>a-color{color: white}</style><a-color>", $content);
		$content = str_replace("+c=purple+", "<style>a-color{color: purple}</style><a-color>", $content);
		$content = str_replace("-c-", "</a-color>", $content);
		$i = explode("+img+", $content);
		unset($i[0]); // because the first one is the start of the text so not an image
		foreach($i as $img) {
			$imgs = explode("-img-", $content);
			$img = $imgs[0]; // this is the url
			$content = str_replace("+img+", "<img src='".$img."'>", $content);
			$content = str_replace("-img-", "</img>", $content);
		}
		$content = str_replace("+font=veranda+", "<style>a-font{font-family: Veranda}</style><a-font style='font-family: Veranda;'>", $content);
		$content = str_replace("+font=Comic Sans MS+", "<style>a-font{font-family: Comic Sans MS}</style><a-font style='font-family: Comic Sans MS;'>", $content);
		$content = str_replace("+font=Times New Roman+", "<style>a-font{font-family: Times New Romans}</style><a-font style='font-family: Times New Roman;'>", $content);
		$content = str_replace("+font=Courrier+", "<style>a-font{font-family: Courrier}</style><font style='font-family: Courrier;'>", $content);
		$content = str_replace("+font=Impact+", "<style>a-font{font-family: Impact}</style><a-font style='font-family: Impact;'>", $content);
		$content = str_replace("-font-", "</a-font>", $content);
		$content = str_replace("+size=1+", "<size style='font-size: 10;'>", $content);
		$content = str_replace("+size=2+", "<size style='font-size: 20;'>", $content);
		$content = str_replace("+size=3+", "<size style='font-size: 30;'>", $content);
		$content = str_replace("+size=4+", "<size style='font-size: 40;'>", $content);
		$content = str_replace("+size=5+", "<size style='font-size: 50;'>", $content);
		$content = str_replace("-size-", "</size>", $content);
		$u = explode("+url", $content);
		unset($u[0]); // because the first one is the start of the text so not an url
		foreach($u as $url) {
			$urls = explode("+http", $content);
			$url = $urls[0]; // this is the url
			$content = str_replace("+url+", "<a href='http".$url."'>", $content);
			$content = str_replace("-url-", "</a>", $content);
		}
		return $content;
	}
}
?>