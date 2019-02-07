<?php

/**
 * BeneficenciaData short summary.
 *
 * BeneficenciaData description.
 *
 * @version 1.0
 * @author sistemas
 */
class CierresData
{
    public static $tablename = "protocolocierres";
    public function __construct()
    {
        $this->nrocopia = "";
        $this->is_registro = "";
        $this->nroescriturapublica = "";
        $this->dateescritura = "";
        $this->numfolios = "";
        $this->observationcopy1 = "";
        $this->observationcopy2 = "";
        $this->destino = "";
        $this->notario_id = "";
        $this->user_id = "";
        $this->created_at = (new \DateTime())->format('Y-m-d H:i:s');
    }


    public function add()
    {
        $destino = addslashes($this->destino);
        $sql = "INSERT INTO  ".self::$tablename." (nrocopia,is_registro, nroescriturapublica,dateescritura, numfolios, observationcopy1, observationcopy2, destino  , created_at,notario_id, user_id) VALUES ";
        $sql .= "(\"$this->nrocopia\",$this->is_registro,\"$this->nroescriturapublica\",\"$this->dateescritura\",\"$this->numfolios\",\"$this->observationcopy1\",\"$this->observationcopy2\",'$destino',\"$this->created_at\",\"$this->notario_id\",$this->user_id )";
        //echo $sql;
        Executor::doit($sql);
    }

    public function update()
    {
        $destino = addslashes($this->destino);
        $sql= "UPDATE ".self::$tablename." SET nrocopia=\"$this->nrocopia\",is_registro=$this->is_registro,nroescriturapublica=\"$this->nroescriturapublica\", numfolios=$this->numfolios,observationcopy1=\"$this->observationcopy1\",observationcopy2=\"$this->observationcopy2\", destino=\"$destino\", notario_id=\"$this->notario_id\", user_id=\"$this->user_id\"   WHERE id=$this->id ";
        Executor::doit($sql);
    }
    public function upload()
    {
        $sql = "UPDATE ".self::$tablename." SET nroescriturapublica=\"$this->nroescriturapublica\" WHERE id=$this->id  ";
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

    public static function getAll()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new CierresData());
    }
    public static function getByRange($start_at, $finish_at)
    {
        $sql = "select * from ".self::$tablename." where created_at>=\"$start_at\" and created_at<=\"$finish_at\" ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CierresData());
    }
    
    public static function getAllAcreedores()
    {
        $sql = "select DISTINCT destino from ".self::$tablename ;
        $query = Executor::doit($sql);
        return Model::many($query[0], new CierresData());
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new CierresData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new CierresData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " ORDER BY created_at DESC "." LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new CierresData());
    }

    public static function getAllCreated()
    {
        $sql = "select created_at from ".self::$tablename." ORDER BY created_at DESC LIMIT 1";
        //echo $sql;
        $query = Executor::doit($sql);
        return Model::many($query[0], new CierresData());
    }
    public function getDatetimeNow()
    {
        $tz_object = new DateTimeZone('America/Bogota');
        //date_default_timezone_set('Brazil/East');

        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ h:i:s');
    }
}