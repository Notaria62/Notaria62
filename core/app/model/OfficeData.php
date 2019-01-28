<?php
class OfficeData
{
    public static $tablename = "officeaddress";
    public function __construct()
    {
        $this->is_public = "0";
        $this->created_at = "NOW()";
    }

    public function add()
    {
        $sql = "insert into ".self::$tablename." (radicado,escritura,ci,email,anho,estatus,user_id,created_at) ";
        $sql .= "value (\"$this->radicado\",\"$this->escritura\",\"$this->ci\",\"$this->email\",\"$this->anho\",\"$this->estatus\",\"$this->user_id\",$this->created_at)";
        Executor::doit($sql);
    }

    public function upload($officecode, $oficename, $officeaddress, $officecity)
    {
        $sql = "insert into ".self::$tablename." (officecode,officename,officeaddress,officecity) ";
        $sql .= "value (\"$officecode\",\"$oficename\",\"$officeaddress\",\"$officecity\")";
        Executor::doit($sql);
    }
    public function upload1($code, $name, $is_active)
    {
        $sql = "insert into notarias (code,name,is_active) ";
        $sql .= "value (\"$code\",\"$name\",\"$is_active\")";
        Executor::doit($sql);
    }

    public static function delById($id)
    {
        $sql = "delete from ".self::$tablename." where id=$id";
        Executor::doit($sql);
    }
    public function del()
    {
        $sql = "delete from ".self::$tablename." where id=$this->id";
        Executor::doit($sql);
    }

    // partiendo de que ya tenemos creado un objecto ClientData previamente utilizamos el contexto
    public function update_active()
    {
        $sql = "update ".self::$tablename." set last_active_at=NOW() where id=$this->id";
        Executor::doit($sql);
    }

    public function update()
    {
        $sql = "update ".self::$tablename." set radicado=\"$this->radicado\",escritura=\"$this->escritura\",ci=\"$this->ci\",email=\"$this->email\",anho=\"$this->anho\",estatus=\"$this->estatus\",user_id=\"$this->user_id\" where id=$this->id";
        Executor::doit($sql);
    }

    public static function getLikeBy($q)
    {
        $sql = "select * from ".self::$tablename." where radicado like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProcedureData());
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new ProcedureData());
    }

    public static function getByEoRyC($nut, $CI)
    {
        $sql = "select * from ".self::$tablename." where radicado='$nut' OR escritura='$nut' AND ci='$ci' ORDER BY radicado DESC LIMIT 1";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProcedureData());
    }
    public static function getAll()
    {
        $sql = "select *  from ".self::$tablename." order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProcedureData());
    }

    public static function getAllActive()
    {
        $sql = "select * from client where last_active_at>=date_sub(NOW(),interval 3 second)";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProcedureData());
    }

    public static function getAllUnActive()
    {
        $sql = "select * from client where last_active_at<=date_sub(NOW(),interval 3 second)";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProcedureData());
    }

    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new ProcedureData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new ProcedureData());
    }

    public function getUnreads()
    {
        return MessageData::getUnreadsByClientId($this->id);
    }


    public static function getLike($q)
    {
        $sql = "select * from ".self::$tablename." where title like '%$q%' or email like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProcedureData());
    }
}
