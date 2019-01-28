<?php

/**
 * BeneficenciaData short summary.
 *
 * BeneficenciaData description.
 *
 * @version 1.0
 * @author sistemas
 */
class BeneficenciaData
{
    public static $tablename = "beneficencia";
    public function __construct()
    {
        $this->nroescriturapublica = "";
        $this->tipo = "";
        $this->anho = "";
        $this->finished_at = self::getDatetimeNow();
        $this->user_id = "";
        $this->is_delivered = "";
        $this->user_id_delivered = "";
        $this->status = "";
        $this->comments="";
        $this->created_at = (new \DateTime())->format('Y-m-d H:i:s');
    }
    public function add()
    {
        $sql = "INSERT IGNORE INTO  ".self::$tablename." (nroescriturapublica,tipo, anho, created_at, user_id) VALUES ";
        $sql .= "(\"$this->nroescriturapublica\",\"$this->tipo\",\"$this->anho\",\"$this->created_at\",$this->user_id )";
        Executor::doit($sql);
    }

    public function updateDelivered()
    {
        $this->finished_at= self::getDatetimeNow();
        $sql= "UPDATE ".self::$tablename." SET is_delivered=\"$this->is_delivered\", user_id_delivered=$this->user_id_delivered, finished_at=\"$this->finished_at\", status=1  WHERE id=$this->id ";
        Executor::doit($sql);
    }
    public function updateStatus()
    {
        $sql= "UPDATE ".self::$tablename." SET status=1 WHERE id=$this->id and status=0 ";
        Executor::doit($sql);
    }
    public function update()
    {
        $sql= "UPDATE ".self::$tablename." SET  nroescriturapublica=$this->nroescriturapublica, tipo=\"$this->tipo\",anho=\"$this->anho\",comments=\"$this->comments\"  WHERE id=$this->id ";
        //echo $sql;
        Executor::doit($sql);
    }
    public function updateComments()
    {
        $sql= "UPDATE ".self::$tablename." SET  comments=\"$this->comments\"  WHERE id=$this->id ";
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
        return Model::many($query[0], new BeneficenciaData());
    }
    public static function getAllNotDelivered()
    {
        $sql = "select * from ".self::$tablename. " WHERE is_delivered = 0 ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new BeneficenciaData());
    }
    public static function getAllStatusDelivered()
    {
        $sql = "select * from ".self::$tablename. " WHERE status = 0 and is_delivered=0 ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new BeneficenciaData());
    }

    public static function getByRange($start_at, $finish_at)
    {
        $sql = "select * from ".self::$tablename." where created_at>=\"$start_at\" and created_at<=\"$finish_at\" ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new BeneficenciaData());
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new BeneficenciaData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new BeneficenciaData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " ORDER BY created_at DESC "." LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new BeneficenciaData());
    }

    public static function getAllCreated()
    {
        $sql = "select created_at from ".self::$tablename." ORDER BY created_at DESC LIMIT 1";
        //echo $sql;
        $query = Executor::doit($sql);
        return Model::many($query[0], new BeneficenciaData());
    }
    public function getDatetimeNow()
    {
        $tz_object = new DateTimeZone('America/Bogota');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ h:i:s');
    }
}