<?php

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];

    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";    
    $signup = new SignupContr($username, $pwd, $fname, $lname);

    $signup->signupUser();

    header("location: ../index.php?error=none");
}
