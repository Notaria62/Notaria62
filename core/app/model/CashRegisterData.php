<?php

/**
 * CashRegisterData short summary.
 *
 * CashRegisterData description.
 *
 * @version 1.0
 * @author sistemas
 */
class CashRegisterData
{
    public static $tablename = "cashregister";
    public function __construct()
    {
        $this->radicado = "";
        $this->cuentaanticipos = "";
        $this->cuentanotaria = "";
        $this->cuentaunicanotarial = "";
        $this->cuentaapropiacion = "";
        $this->totalpagos = "";
        $this->diferencias = "";
        $this->cajaauxuliar = "";
        $this->cajaprincipal = "";
        $this->caja1erpiso = "";

        $this->status = "";
        $this->user_id = "";
        $this->created_at = Util::getDatetimeNow();
    }
    public function add()
    {
        $sql = "INSERT IGNORE INTO  " . self::$tablename . " (radicado,cuentaanticipos, cuentanotaria,totalpagos,diferencias, user_id, created_at) VALUES ";
        $sql .= "(\"$this->radicado\",\"$this->cuentaanticipos\",\"$this->cuentanotaria\",\"$this->totalpagos\",\"$this->diferencias\",$this->user_id,\"$this->created_at\" )";
        Executor::doit($sql);
    }
    public function addRadicado()
    {
        $sql = "INSERT IGNORE INTO  " . self::$tablename . " (radicado, user_id, created_at) VALUES ";
        $sql .= "(\"$this->radicado\",$this->user_id,\"$this->created_at\" )";
        //echo $sql;
        Executor::doit($sql);
    }

    public function updateDelivered()
    {
        $this->finished_at = Util::getDatetimeNow();
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
        $sql = "UPDATE " . self::$tablename . " SET cuentaanticipos=\"$this->cuentaanticipos\",cuentanotaria=\"$this->cuentanotaria\",cuentaunicanotarial=\"$this->cuentaunicanotarial\",cuentaapropiacion=\"$this->cuentaapropiacion\",totalpagos=\"$this->totalpagos\",diferencias=\"$this->diferencias\",cajaauxuliar=\"$this->cajaauxuliar\" ,cajaprincipal=\"$this->cajaprincipal\" ,caja1erpiso=\"$this->caja1erpiso\",created_at=\"$this->created_at\" WHERE id=$this->id ";
        echo $sql;
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
        return Model::many($query[0], new CashRegisterData());
    }
    public static function getByLastRadicado($datetoday)
    {
        $sql = "select id, radicado from " . self::$tablename . " where YEAR(created_at)='$datetoday' ORDER BY radicado DESC LIMIT 1";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CashRegisterData());
    }
    public static function getAllNotDelivered()
    {
        $sql = "select * from " . self::$tablename . " WHERE is_delivered = 0 ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CashRegisterData());
    }
    public static function getAllStatusDelivered()
    {
        $sql = "select * from " . self::$tablename . " WHERE status = 0 and is_delivered=0 ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CashRegisterData());
    }

    public static function getByRange($start_at, $finish_at)
    {
        $sql = "select * from " . self::$tablename . " where created_at>=\"$start_at\" and created_at<=\"$finish_at\" ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CashRegisterData());
    }

    public static function getById($id)
    {
        $sql = "select * from " . self::$tablename . " where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new CashRegisterData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from " . self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new CashRegisterData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from " . self::$tablename . " ORDER BY created_at DESC " . " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new CashRegisterData());
    }

    public static function getAllCreated()
    {
        $sql = "select created_at from " . self::$tablename . " ORDER BY created_at DESC LIMIT 1";
        //echo $sql;
        $query = Executor::doit($sql);
        return Model::many($query[0], new CashRegisterData());
    }
}