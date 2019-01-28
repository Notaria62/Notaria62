<?php
class Database {
	public static $db;
	public static $con;
	function __construct(){
		$this->user="root";
                $this->pass="root";
                $this->host="localhost";
                $this->ddbb="not62bog_notaria62web";
               /// echo $_SESSION['user_id'];

	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		return $con;
	}


	public static function getCon(){



		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}

}
?>
