<?php

/*
Forums codes parsers.
By (c) Ad5001 for BoxManager
*/

class BBCode {

    private $codes = [
            '/\[b\](.+?)\[\/b\]/' => "<b>$1</b>",
            '/\[i\](.+?)\[\/i\]/' => "<i>$1</i>",
            '/\[u\](.+?)\[\/u\]/' => "<u>$1</u>",
            '/\[url\](.+?)\[\/url\]/' => "<a href='$1'>$1</a>",
            '/\[url="(.+?)"\](.+?)\[\/url\]/' => "<a href='$1'>$2</a>",
            '/\[font="(.+?)"\](.+?)\[\/font\]/' => "<x-font style='font-family: $1;'>$2</x-font>",
            '/\[size="(.+?)"\](.+?)\[\/size\]/' => "<x-size style='font-size: $1;'>$2</x-size>",
            '/\[img="(.+?)"\](.+?)\[\/img\]/' => "<img src='$1'>$2</img>",
            '/\[b\](.+?)\[\/b\]/' => "<b>$1</b>"
    ];


    static $customs = [
        "font",
        "size"
    ];



    public function toHTML(string $to) {
        foreach ($this->codes as $key => $code) {
            $to = preg_replace($key, $code, $to);
        }
    }

}


foreach (BBCode::$customs as $key) {
    echo "window.customElements.define('x-$key', class extends HTMLElement {});";
}