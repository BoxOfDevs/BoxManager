<?php
class SConfig {
	public function __construct($path) {
        if(!file_exists($path)) {
            $create = fopen($path, "w");
            fclose($create);
        }
        $this->path = $path;
        $this->contents = unserialize(file_get_contents($path));
        
    }
    public function get($name) {
        return $this->contents[$name];
    }
    public function set($name, $contents) {
        $this->contents[$name] = $contents;
    }
    public function save() {
        file_put_contents($this->path, serialize($this->contents));
    }
}