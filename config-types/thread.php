<?php
error_reporting(-1);
class ThreadConfig {
	public function __construct($path) {
        $contents = unserialize(file_get_contents($path));
        $this->path = $path;
		$this->name = $contents["Name"];
        $this->title = $contents["Title"];
        $this->downloadlink = $contents["Download"];
        $this->id = $contents["Id"];
        $this->version = $contents["Version"];
        $this->text = $contents["Text"];
    }
    public function get($name) {
        switch(strtolower($name)) {
            case "name":
            return $this->name;
            break;
            case "tag bar":
            case "tagbar":
            case "title":
            return $this->title;
            break;
            case "download":
            case "dllink":
            case "downloadlink":
            return $this->downloadlink;
            break;
            case "id":
            return $this->id;
            break;
            case "version":
            return $this->version;
            break;
            case "contents"
            case "text":
            return $this->text;
            break;
            default:
            return null;
            break;
        }
    }
    public function set($name, $content) {
        switch(strtolower($name)) {
            case "name":
            $this->name = $content;
            break;
            case "tag bar":
            case "tagbar":
            case "title":
            $this->title = $content;
            break;
            case "download":
            case "dllink":
            case "downloadlink":
            $this->downloadlink = $content;
            break;
            case "id":
            $this->id = $content;
            break;
            case "version":
            $this->version = $content;
            break;
            case "contents"
            case "text":
            $this->text = $content;
            break;
            default:
            break;
        }
    }
    public function save() {
        $contents = [$this->name, $this->title, $this->downloadlink, $this->id, $this->version, $this->text];
        file_put_contents(serialize($contents));
    }
}