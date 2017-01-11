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
        if(!isset($fgmembersite)) require_once("../login/fg_membersite.php");
        $this->q = $fgmembersite->query("SELECT * FROM users WHERE username='$username'")->fetch_array()[0];
    }

    /*
    Check if player is an admin
    @return bool
    */
    public function isAdmin() : bool {
        return $this->q["is_admin"];
    }

    /*
    Check if player is an mod
    @return bool
    */
    public function isMod() : bool {
        return $this->q["is_mod"];
    }

    /*
    Set admin to true or false.
    @param $to bool
    @return bool
    */
    public function setAdmin(bool $to) {
        $bool = (($to) ? "true" : "false");
        return $fgmembersite->query("UPDATE users SET is_admin='$bool' WHERE username='$username'");
    }

    /*
    Set mod to true or false.
    @param $to bool
    @return bool
    */
    public function setMod(bool $to) {
        $bool = (($to) ? "true" : "false");
        return $fgmembersite->query("UPDATE users SET is_mod='$bool' WHERE username='$username'");
    }

    /*
    Return user's id.
    @return int
    */
    public function getId() : int {
        return (int) $this->q["id_user"];
    }

    /*
    Return user's confirmed.
    @return int
    */
    public function isConfirmed() : bool {
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
    public function getName() : string {
        return (string) $this->q["name"];
    }

    /*
    Return user's email.
    @return string
    */
    public function getEmail() : string {
        return (string) $this->q["email"];
    }

    /*
    Return user's email.
    @return string
    */
    public function getUsername() : string {
        return (string) $this->q["username"];
    }
}