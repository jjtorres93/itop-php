<?php
// @codingStandardsIgnoreLine
class Dbh {
    protected function connect()
    {
        try {
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=db_drusa', $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: ". $e->getMessage(). "<br/>";
        }
    }
}
