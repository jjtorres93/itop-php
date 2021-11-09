<?php
// @codingStandardsIgnoreLine
class SignupContr extends Signup {

    private $username;
    private $pwd;
    private $fname;
    private $lname;

    public function __construct($username, $pwd, $fname, $lname)
    {
        $this->username = $username;
        $this->pwd = $pwd;
        $this->fname = $fname;
        $this->lname = $lname;
    }
    
    public function signupUser() {
        if($this->emptyInput() == false) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }
       
        if($this->checkUsername() == false) {
            header("location: ../index.php?error=usernametaken");
            exit();
        }

        $this->setUser($this->username, $this->pwd, $this->fname, $this->lname);
    }

    private function emptyInput()
    {
        $result;
        if (empty($this->username) || empty($this->pwd) || empty($this->fname) || empty($this->lname)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }  

    private function checkUsername() {
        $result;
        if (!$this->checkUser($this->username))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }
}
