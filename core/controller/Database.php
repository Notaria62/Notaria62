<?php
class Database
{
    public static $db;
    public static $con;
    public function __construct()
    {
        //$this->user = "not62bog_notaria62user";
        //$this->pass = "2fr{N}@~waQ[11";
        $this->user = "phpmyadminuser";
        $this->pass = "root";
        $this->host = "localhost";
        $this->ddbb = "not62bog_notaria62web";
        //echo "....................................----------------____________________________________-----" . $_SESSION['user_id'];
    }
    public function connect()
    {
        try {
            //code...
            $con = new mysqli($this->host, $this->user, $this->pass, $this->ddbb) or die('MySQL connect failed: llamar administrador: ' . mysqli_connect_error());
            return $con;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getCon()
    {
        if (self::$con == null && self::$db == null) {
            self::$db = new Database();
            self::$con = self::$db->connect();
        }
        return self::$con;
    }
}