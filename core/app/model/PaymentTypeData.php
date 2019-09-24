<?php

/**
 * PaymentTypeData short summary.
 *
 * PaymentTypeData description.
 *
 * @version 1.0
 * @author sistemas
 */
class PaymentTypeData
{
    public static $tablename = "paymenttype";
    public function __construct()
    {
        $this->tipo = "";
        $this->id_tipo = "";
        $this->mount = "";
        $this->id_bankaccounts = "";
        $this->id_cashregister = "";
        $this->status = "";
        $this->created_at = Util::getDatetimeNow();
        $this->user_id = "";
    }
    public function add()
    {
        $sql = "INSERT IGNORE INTO  " . self::$tablename . " (tipo,id_tipo, mount, id_bankaccounts, id_cashregister, created_at, user_id) VALUES ";
        $sql .= "(\"$this->tipo\",\"$this->id_tipo\",\"$this->mount\",\"$this->id_bankaccounts\",\"$this->id_cashregister\",\"$this->created_at\",$this->user_id )";
        Executor::doit($sql);
    }

    
    public function updateDelivered()
    {
        $this->finished_at = self::getDatetimeNow();
        $sql = "UPDATE " . self::$tablename . " SET is_delivered=\"$this->is_delivered\", user_id_delivered=$this->user_id_delivered, finished_at=\"$this->finished_at\", status=1  WHERE id=$this->id ";
        Executor::doit($sql);
    }
    public function updateStatus()
    {
        $sql = "UPDATE " . self::$tablename . " SET status=1 WHERE id=$this->id and status=0 ";
        Executor::doit($sql);
    }
    public function update()
    {
        $sql = "UPDATE " . self::$tablename . " SET  tipo=$this->tipo, id_tipo=\"$this->id_tipo\",mount=\"$this->mount\",comments=\"$this->comments\"  WHERE id=$this->id ";
        //echo $sql;
        Executor::doit($sql);
    }
    public function updatePaymentType($id, $column_name, $value)
    {
        //$sql= "UPDATE ".self::$tablename." SET  tipo=$this->tipo, id_tipo=\"$this->id_tipo\",mount=\"$this->mount\",comments=\"$this->comments\"  WHERE id=$this->id ";
        $sql = "UPDATE " . self::$tablename . " SET " . $column_name . "='" . $value . "' WHERE id=$id";
        //echo $sql;
        echo "Actualizado correctamente...";
        Executor::doit($sql);
    }
    public function updateComments()
    {
        $sql = "UPDATE " . self::$tablename . " SET  comments=\"$this->comments\"  WHERE id=$this->id ";
        Executor::doit($sql);
    }
    public function upload()
    {
        $sql = "UPDATE " . self::$tablename . " SET nroescriturapublica=\"$this->nroescriturapublica\" WHERE id=$this->id  ";
        Executor::doit($sql);
    }

    public static function delById($id)
    {
        $sql = "delete from " . self::$tablename . " where id=$id";
        echo "Eliminado...";
        Executor::doit($sql);
    }
    public function del()
    {
        $sql = "delete from " . self::$tablename . " where id=$this->id";
        Executor::doit($sql);
    }

    public static function getAll()
    {
        $sql = "select * from " . self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new PaymentTypeData());
    }
    public static function getAllNotDelivered()
    {
        $sql = "select * from " . self::$tablename . " WHERE is_delivered = 0 ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new PaymentTypeData());
    }
    public static function getAllCashRegister($id)
    {
        $sql = "select * from " . self::$tablename . " WHERE id_cashregister = $id ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new PaymentTypeData());
    }
    public static function getAllStatusDelivered()
    {
        $sql = "select * from " . self::$tablename . " WHERE status = 0 and is_delivered=0 ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new PaymentTypeData());
    }

    public static function getByRange($start_at, $finish_at)
    {
        $sql = "select * from " . self::$tablename . " where created_at>=\"$start_at\" and created_at<=\"$finish_at\" ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new PaymentTypeData());
    }

    public static function getById($id)
    {
        $sql = "select * from " . self::$tablename . " where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new PaymentTypeData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from " . self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new PaymentTypeData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from " . self::$tablename . " ORDER BY created_at DESC " . " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new PaymentTypeData());
    }

    public static function getAllCreated()
    {
        $sql = "select created_at from " . self::$tablename . " ORDER BY created_at DESC LIMIT 1";
        //echo $sql;
        $query = Executor::doit($sql);
        return Model::many($query[0], new PaymentTypeData());
    }
}