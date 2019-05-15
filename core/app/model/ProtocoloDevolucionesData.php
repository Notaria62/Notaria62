<?php
class ProtocoloDevolucionesData
{
    public static $tablename = "protocolodevoluciones";
    public function __construct()
    {
        $this->is_public = "0";
        $this->created_at = Util::getDatetimeNow();;
    }

    public function add()
    {
        $sql = "insert into " . self::$tablename . " (radicado,escritura,ci,email,anho,estatus,user_id,created_at) ";
        $sql .= "value (\"$this->radicado\",\"$this->escritura\",\"$this->ci\",\"$this->email\",\"$this->anho\",\"$this->estatus\",\"$this->user_id\",$this->created_at)";
        Executor::doit($sql);
    }

    public function upload($escritura_anho, $acta, $tipo_deposito, $depositante, $email, $valor_acta, $saldo, $status)
    {
        $sql = "insert into " . self::$tablename . " (escritura_anho, acta, tipo_deposito, depositante, email, valor_acta,saldo,status,user_id,created_at) ";
        $sql .= "value (\"$escritura_anho\",\"$acta\",\"$tipo_deposito\",\"$depositante\",\"$email\",\"$valor_acta\",\"$saldo\",\"$status\",\"$this->user_id\",\"$this->created_at\") ";
        //echo $sql;
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

    // partiendo de que ya tenemos creado un objecto ClientData previamente utilizamos el contexto
    public function update_active()
    {
        $sql = "update " . self::$tablename . " set last_active_at=NOW() where id=$this->id";
        Executor::doit($sql);
    }

    public function update()
    {
        $sql = "update " . self::$tablename . " set radicado=\"$this->radicado\",escritura=\"$this->escritura\",ci=\"$this->ci\",email=\"$this->email\",anho=\"$this->anho\",estatus=\"$this->estatus\",user_id=\"$this->user_id\" where id=$this->id";
        Executor::doit($sql);
    }

    public static function getLikeBy($q)
    {
        $sql = "select * from " . self::$tablename . " where escritura_anho like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProtocoloDevolucionesData());
    }

    public static function getById($id)
    {
        $sql = "select * from " . self::$tablename . " where id=$id ";
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::one($query[0], new ProtocoloDevolucionesData());
    }
    public static function getByRange($start_at, $finish_at)
    {
        $sql = "select * from " . self::$tablename . " where created_at>=\"$start_at\" and created_at<=\"$finish_at\" GROUP BY escritura_anho ASC ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProtocoloDevolucionesData());
    }


    public static function getAll()
    {
        $sql = "select *  from " . self::$tablename . " order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProtocoloDevolucionesData());
    }

    public static function getAllActive()
    {
        $sql = "select * from client where last_active_at>=date_sub(NOW(),interval 3 second)";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProtocoloDevolucionesData());
    }

    public static function getAllUnActive()
    {
        $sql = "select * from client where last_active_at<=date_sub(NOW(),interval 3 second)";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProtocoloDevolucionesData());
    }

    public static function getAllNumRow()
    {
        $sql = "select * from " . self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new ProtocoloDevolucionesData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from " . self::$tablename . " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new ProtocoloDevolucionesData());
    }

    public function getUnreads()
    {
        return MessageData::getUnreadsByClientId($this->id);
    }


    public static function getLike($q)
    {
        $sql = "select * from " . self::$tablename . " where title like '%$q%' or email like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ProtocoloDevolucionesData());
    }
}