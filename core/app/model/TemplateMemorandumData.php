<?php

/**
 * MemorandumData short summary.
 *
 * MemorandumData description.
 *
 * @version 1.0
 * @author sistemas
 */
class TemplateMemorandumData
{
    public static $tablename = "templatememorandum";
    public function __construct()
    {
        $this->templatememo_id = "";
        $this->name = "";
        $this->description = "";
        $this->container = "";
        $this->type = "";
        $this->user_id = "";
        $this->is_public = "0";
        $this->created_at = (new \DateTime())->format('Y-m-d H:i:s');
    }
    public function add()
    {
        $sql= "INSERT INTO ".self::$tablename." (name, description, container, type)";
        $sql .= " VALUES (\"$this->name\",\"$this->description\",\"$this->container\",\"$this->type\" )";
     return Executor::doit($sql);
    }

    public function upload($radicado, $escritura, $CI, $email, $anho, $estatus)
    {
        $sql = "insert into ".self::$tablename." (radicado,escritura,CI,email,anho,estatus,user_id,created_at) ";
        $sql .= "value (\"$radicado\",\"$escritura\",\"$CI\",\"$email\",\"$anho\",\"$estatus\",\"$this->user_id\",$this->created_at)";
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
        return Model::many($query[0], new TemplateMemorandumData());
    }
    public static function getDigitizerAll()
    {
        $sql = "select * from ".self::$tablename . " where type =1";
        $query = Executor::doit($sql);
        return Model::many($query[0], new TemplateMemorandumData());
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new TemplateMemorandumData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new TemplateMemorandumData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new TemplateMemorandumData());
    }
}