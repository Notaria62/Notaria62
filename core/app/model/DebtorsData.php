<?php

/**
 * DigitadoresData short summary.
 *
 * DigitadoresData description.
 *
 * @version 1.0
 * @author sistemas
 */
class DebtorsData
{
    public static $tablename = "debtors";


    public function __construct()
    {
        $this->fullname = "";
        $this->typeindent = "";
        $this->identificacion = "";
        $this->user_id = "";
        $this->memo_id = "";
        $this->created_at = "NOW()";
    }

    public function add()
    {
        $sql = "insert into ".self::$tablename." (fullname,typeindent, identificacion,user_id,created_at,memo_id) ";
        $sql .= "value (\"$this->fullname\",\"$this->typeindent\",\"$this->identificacion\",\"$this->user_id\",\"$this->created_at\",\"$this->memo_id\",)";
        return Executor::doit($sql);
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

    // partiendo de que ya tenemos creado un objecto EditorialData previamente utilizamos el contexto
    public function update()
    {
        $sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
        Executor::doit($sql);
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new DebtorsData());
    }

    public static function getAll()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new DebtorsData());
    }
}
