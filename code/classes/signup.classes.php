<?php

class Signup extends Dbh {
    
    protected function setUser($username, $pwd, $fname, $lname) {
        $stmt = $this->connect()->prepare('INSERT INTO users (user_name, user_pass, status, name, last_name) VALUES (?,?,?,?,?)');

        /*$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); Uncomment to hash password before storing on DB*/

        if(!$stmt->execute([$username, /*$hashedPwd*/ $pwd, 1, $fname, $lname])) { /*Uncomment $hashedPwd and comment $pwd to hash the password */
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkUser($username) {
        $stmt = $this->connect()->prepare('SELECT user_name FROM users WHERE user_name=?;');

        if(!$stmt->execute([$username])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck;
        if($stmt->rowCount() > 0) {
            $resultCheck = false;
        }
        else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

}