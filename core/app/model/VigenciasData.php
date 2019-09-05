<?php

/**
 * BeneficenciaData short summary.
 *
 * BeneficenciaData description.
 *
 * @version 1.0
 * @author sistemas
 */
class VigenciasData
{
    public static $tablename = "protocolovigencias";
    public function __construct()
    {
        $this->consecutivo = "";
        $this->nroescriturapublica = "";
        $this->dateescritura = "";
        $this->poderdante_ids = "";
        $this->apoderados_ids = "";
        $this->otorgotipo = "";
        $this->solicitante = "";
        $this->observation = "";
        $this->notario_id = "";
        $this->user_id = "";
        $this->created_at = Util::getDatetimeNow();
    }


    // public function add()
    // {
    //     $sql = "INSERT INTO  ".self::$tablename. " (consecutivo,nroescriturapublica,dateescritura,poderdantecc,poderdantename,poderdanteccexpedida,  apoderadocc, apoderadoname, apoderadoccexpedida, otorgotipo, solicitante, observation,notario_id, user_id, created_at ) VALUES ";
    //     $sql .= "(\"$this->consecutivo\",\"$this->nroescriturapublica\",\"$this->dateescritura\",\"$this->poderdantecc\",\"$this->poderdantename\",\"$this->poderdanteccexpedida\",\"$this->apoderadocc\",\"$this->apoderadoname\",\"$this->apoderadoccexpedida\",\"$this->otorgotipo\",\"$this->solicitante\",\"$this->observation\",\"$this->notario_id\",$this->user_id,\"$this->created_at\" )";
    //     echo $sql;
    //     Executor::doit($sql);
    // }


    public function add()
    {
        $sql = "INSERT INTO  ".self::$tablename. " (consecutivo,nroescriturapublica,dateescritura,poderdante_ids,apoderado_ids, otorgotipo, solicitante, observation,notario_id, user_id, created_at ) VALUES ";
        $sql .= "(\"$this->consecutivo\",\"$this->nroescriturapublica\",\"$this->dateescritura\",\"$this->poderdante_ids\",\"$this->apoderado_ids\",\"$this->otorgotipo\",\"$this->solicitante\",\"$this->observation\",\"$this->notario_id\",$this->user_id,\"$this->created_at\" )";
        //echo $sql;
        Executor::doit($sql);
    }
    public function update()
    {
        //$destino = addslashes($this->destino);
        $sql= "UPDATE ".self::$tablename." SET consecutivo=\"$this->consecutivo\",poderdantecc=\"$this->poderdantecc\",poderdantename=\"$this->poderdantename\",poderdanteccexpedida=\"$this->poderdanteccexpedida\",nroescriturapublica=\"$this->nroescriturapublica\", apoderadocc=\"$this->apoderadocc\", apoderadoname=\"$this->apoderadoname\", apoderadoccexpedida=\"$this->apoderadoccexpedida\",observation=\"$this->observation\",solicitante=\"$this->solicitante\", otorgotipo=\"$this->otorgotipo\", notario_id=\"$this->notario_id\", user_id=\"$this->user_id\"   WHERE id=$this->id ";
        // echo $sql;
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
        return Model::many($query[0], new VigenciasData());
    }
    public static function getByRange($start_at, $finish_at)
    {
        $sql = "select * from ".self::$tablename." where created_at>=\"$start_at\" and created_at<=\"$finish_at\" ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new VigenciasData());
    }
    
    public static function getAllAcreedores()
    {
        $sql = "select DISTINCT destino from ".self::$tablename ;
        $query = Executor::doit($sql);
        return Model::many($query[0], new VigenciasData());
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new VigenciasData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new VigenciasData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " ORDER BY created_at DESC "." LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new VigenciasData());
    }
    public static function getByConsecutivoLast($datetoday)
    {
        $sql = "select consecutivo from ".self::$tablename." where YEAR(created_at)='$datetoday' ORDER BY consecutivo DESC LIMIT 1";
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new ConsecutivosDeCertificadosData());
    }

    public static function getAllCreated()
    {
        $sql = "select created_at from ".self::$tablename." ORDER BY created_at DESC LIMIT 1";
        //echo $sql;
        $query = Executor::doit($sql);
        return Model::many($query[0], new VigenciasData());
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