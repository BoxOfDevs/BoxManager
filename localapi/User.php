<?php

/*
*| __ )  _____  _|  \/  | __ _ _ __   __ _  __ _  ___ _ __ 
*|  _ \ / _ \ \/ / |\/| |/ _` | '_ \ / _` |/ _` |/ _ \ '__|
*| |_) | (_) >  <| |  | | (_| | | | | (_| | (_| |  __/ |   
*|____/ \___/_/\_\_|  |_|\__,_|_| |_|\__,_|\__, |\___|_|   
*                                           |___/     
*/

// User class for Admin CP.


class User {

    /*
    Constructs the class
    @param     $username      string
    */
    public function __construct($username) {
        $this->username = $username; 
        $this->fgmembersite = new FGMembersite(); 
        $this->fgmembersite->SetWebsiteName(json_decode(file_get_contents(__DIR__ . "/../configs/config.json"),true)["Site name"]); 
        $this->fgmembersite->InitDB(/*hostname*/json_decode(file_get_contents(__DIR__ . "/../configs/config.json"),true)["Database address"], 
                       /*username*/json_decode(file_get_contents(__DIR__. "/../configs/config.json"),true)["Database admin username"], 
                       /*password*/json_decode(file_get_contents(__DIR__. "/../configs/config.json"),true)["Database admin password"], 
                       /*database name*/json_decode(file_get_contents(__DIR__ . "/../configs/config.json"),true)["Database name"], 
                       /*table name*/'users'); 
        $this->fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr'); 
        if(!$this->fgmembersite->DBLogin()) echo "Could not login to db!";
        $this->q = $this->fgmembersite->connection->query("SELECT * FROM users WHERE username='$username'");
        if($this->q->num_rows < 1) $this->q = $this->fgmembersite->connection->query("SELECT * FROM users WHERE name='$username'");
        if($this->q->num_rows < 1) $this->q = $this->fgmembersite->connection->query("SELECT * FROM users WHERE email='$username'");
        $this->q = $this->q->fetch_array();
    }

    /*
    Check if player is an admin
    @return bool
    */
    public function isAdmin() {
        return $this->q["is_admin"];
    }

    /*
    Check if player is an mod
    @return bool
    */
    public function isMod() {
        return $this->q["is_mod"];
    }

    /*
    Set admin to true or false.
    @param $to bool
    @return bool
    */
    public function setAdmin(bool $to) {
        $bool = (($to) ? "true" : "false");
        return $this->fgmembersite->connection->query("UPDATE users SET is_admin='$bool' WHERE username='$username'");
    }

    /*
    Set mod to true or false.
    @param $to bool
    @return bool
    */
    public function setMod(bool $to) {
        $bool = (($to) ? "true" : "false");
        return $this->fgmembersite->connection->query("UPDATE users SET is_mod='$bool' WHERE username='$username'");
    }

    /*
    Return user's id.
    @return int
    */
    public function getId() {
        return $this->q["id_user"];
    }

    /*
    Return user's confirmed.
    @return int
    */
    public function isConfirmed() {
        return $this->q["confirmcode"] == "y";
    }

    /*
    Return user's confirm code (if not confirmed).
    @return bool|string
    */
    public function getConfirmCode() {
        return ($this->isConfirmed()) ? true : $this->q["confirmcode"];
    }

    /*
    Return user's name.
    @return string
    */
    public function getName() {
        return $this->q["name"];
    }

    /*
    Return user's email.
    @return string
    */
    public function getEmail() {
        return $this->q["email"];
    }

    /*
    Return user's email.
    @return string
    */
    public function getUsername() {
        return $this->q["username"];
    }
}