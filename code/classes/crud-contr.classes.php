<?php

class CrudContr extends User {
    private $user_id;    

    public function __construct($user_id){
        $this->user_id = $user_id;    
    }

    public function newRecord($table){
        $this->createRecord($this->user_id, $table);
    }
}