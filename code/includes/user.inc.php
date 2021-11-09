<?php

if(isset($_SESSION["user_id"])){
    
    include "../classes/dbh.classes.php";
    include "../classes/user.classes.php";
    include "../classes/user-contr.classes.php";
    $user = new UserContr($_SESSION["user_id"], $_SESSION["username"]);

    $user->showRecords();
}