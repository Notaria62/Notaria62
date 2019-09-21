<?php

class Executor
{
    //private string $con;
    public static function doit($sql)
    {
        $con = Database::getCon();
        if (Core::$debug_sql) {
            print "<pre>".$sql."</pre>";
        }
        $array = array($con->query($sql),$con->insert_id);
        return $array;
    }
}