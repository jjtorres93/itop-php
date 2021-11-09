<?php

session_start();
if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
    $username = $_SESSION["username"]; 

    include "../classes/dbh.classes.php";
    include "../classes/user.classes.php";
    include "../classes/user-contr.classes.php";  
    include "../classes/crud-contr.classes.php";  
    $user = new UserContr($user_id, $username);
    $crud = new CrudContr($user_id);
    

    if (isset($_POST["create"])) {
        $table = $_POST["table"]; 
              

        $crud->newRecord($table);
        header("location: ../views/user.view.php?error=none");
    }
    if (isset($_POST["edit"])) {
        $id = $_POST["edit"];
        
        header("location: ../views/user.view.php?error=notimplemented");
    }
    if (isset($_POST["delete"])) {
        $id = $_POST["delete"];
        
        header("location: ../views/user.view.php?error=notimplemented");
    }
}