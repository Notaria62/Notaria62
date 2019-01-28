<?php

/**
 * ConsecutivosDeRemisionesData short summary.
 *
 * ConsecutivosDeRemisionesData description.
 *
 * @version 1.0
 * @author sistemas
 */
class ConsecutivosDeRemisionesData
{
    public static $tablename = "consecutivosderemisiones";
    public function __construct()
    {
        $this->consecutivo = "";
        $this->nroescriturapublica = "";
        $this->radicado = "";
        $this->tipo = "";
        $this->user_id = "";
        $this->created_at = Util::getDatetimeNow();
    }
    public function add()
    {
        $sql = "INSERT INTO  ".self::$tablename." (consecutivo, nroescriturapublica,radicado,tipo,user_id, created_at) VALUES ";
        $sql .= "(\"$this->consecutivo\",\"$this->nroescriturapublica\",\"$this->radicado\",\"$this->tipo\",$this->user_id ,\"$this->created_at\")";
        Executor::doit($sql);
    }

    public function update()
    {
        $sql= "UPDATE ".self::$tablename." SET consecutivo=\"$this->consecutivo\", nroescriturapublica=$this->nroescriturapublica, radicado=\"$this->radicado\",tipo=\"$this->tipo\", user_id=\"$this->user_id\", created_at=\"$this->created_at\"   WHERE id=$this->id ";
        //echo $sql;
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
        return Model::many($query[0], new ConsecutivosDeRemisionesData());
    }
    public static function getByRange($start_at, $finish_at)
    {
        $sql = "select * from ".self::$tablename." where created_at>=\"$start_at\" and created_at<=\"$finish_at\" ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ConsecutivosDeRemisionesData());
    }
    public static function getByConsecutivoLast($datetoday)
    {
        $sql = "select consecutivo from ".self::$tablename." where YEAR(created_at)='$datetoday' ORDER BY consecutivo DESC LIMIT 1";

        $query = Executor::doit($sql);
        return Model::many($query[0], new ConsecutivosDeRemisionesData());
    }
    public static function getByConsecutivo($numeroescriturapublica, $created_at, $consecutivo)
    {
        $sql = "select * from ".self::$tablename." where YEAR(created_at)='$created_at' AND consecutivo=$consecutivo";
        $query = Executor::doit($sql);
        return Model::one($query[0], new ConsecutivosDeRemisionesData());
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new ConsecutivosDeRemisionesData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new ConsecutivosDeRemisionesData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " ORDER BY created_at DESC "." LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new ConsecutivosDeRemisionesData());
    }

    public static function getAllCreated()
    {
        $sql = "select created_at from ".self::$tablename." ORDER BY created_at DESC LIMIT 1";
        //echo $sql;
        $query = Executor::doit($sql);
        return Model::many($query[0], new ConsecutivosDeRemisionesData());
    }
    public function getDatetimeNow()
    {
        $tz_object = new DateTimeZone('America/Bogota');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ h:i:s');
    }
}
