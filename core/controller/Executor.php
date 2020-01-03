<?php

class Executor {

	public static function doit($sql){
		$con = Database::getCon();
        //print Core::$debug_sql;
		if(Core::$debug_sql){
			print "<pre>".$sql."</pre>";
		}
		return array($con->query($sql),$con->insert_id);
	}
}
?>