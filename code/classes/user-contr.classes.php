<?php

class UserContr extends User {
    private $user_id;
    private $username;

    public function __construct($user_id, $username){
        $this->user_id = $user_id;
        $this->username = $username;
    }

    public function showRecords(){
        $this-> getAllRecords($this->user_id);
    }
}