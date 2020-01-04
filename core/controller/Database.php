<?php
class Database
{
    public static $db;
    public static $con;
    public function __construct()
    {
        $this->user = "phpmyadmin";
        $this->pass = "Notaria62";

        $this->host = "localhost";
        $this->ddbb = "not62bog_notaria62web";
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