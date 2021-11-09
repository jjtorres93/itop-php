<?php

class Login extends Dbh {

    protected function getUser($username, $pwd) {
        $stmt = $this->connect()->prepare('SELECT user_pass FROM users WHERE user_name = ?');

        if(!$stmt->execute([$username])) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $pwdQuery= $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dbStoredPwd = $pwdQuery[0]["user_pass"];
        $checkPwd = ($pwd == $dbStoredPwd)
        /*$checkPwd=password_verify($pwd, $dbStoredPwd) use this if you're hashing the password on signup*/;

        if($checkPwd == false)
        {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        }
        elseif($checkPwd == true)
        {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE user_name=? AND user_pass = ?');
            if(!$stmt->execute([$username, /*$dbStoredPwd*/$pwd])) { /*For hashing uncomment $dbStoredPwd and comment $pwd*/ 
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["user_id"] = $user[0]["id"];
            $_SESSION["username"] = $user[0]["user_name"];
        }

        $stmt = null;
    }
}