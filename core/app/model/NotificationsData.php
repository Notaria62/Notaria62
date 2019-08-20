<?php
class NotificationsData
{
    public static $tablename = "notifications";


    public function __construct()
    {
        $this->id = "";
        $this->mensaje = "";
        $this->estado = "";
        $this->autor = "";
        $this->fecha = "";
        $this->type = "";
        $this->status = "";
    }
    public function add()
    {
        $sql = "insert into ".self::$tablename." (mensaje, autor) ";
        $sql .= "value (\"$this->mensaje\",\"$this->autor\")";
        //echo $sql;
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

    // partiendo de que ya tenemos creado un objecto EventosData previamente utilizamos el contexto
    public function update()
    {
        $sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
        Executor::doit($sql);
    }
    public function updateView()
    {
        $sql = "update ".self::$tablename." set estado=1 where estado=0 ";
        Executor::doit($sql);
    }

    public function finalize()
    {
        $sql = "update ".self::$tablename." set returned_at=NOW() where id=$this->id";
        Executor::doit($sql);
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new NotificationsData());
    }

    public static function getAll()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new NotificationsData());
    }



    public static function getAllLimit()
    {
        $sql = "select * from ".self::$tablename." ORDER BY id DESC limit 8 ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new NotificationsData());
    }
    public static function getCountDays()
    {
        $sql = "select TIMESTAMPDIFF(DAY,fecha, curdate()) as dias_transcurridos from " .self::$tablename ." Where TIMESTAMPDIFF(DAY,fecha, curdate()) <=7 " ;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new NotificationsData());
    }
    public static function getCountNotRead()
    {
        $sql = "select estado from ".self::$tablename . " WHERE estado=0 ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new NotificationsData());
    }
    public static function getByRange($start, $finish)
    {
        $sql = "select * from ".self::$tablename." where (  (\"$start\">=fecha and \"$finish\"<=fecha) or (fecha>=\"$start\" and fecha<=\"$finish\") ) ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new NotificationsData());
    }

    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new NotificationsData());
    }


    public static function getRents()
    {
        $sql = "select * from ".self::$tablename." where returned_at is NULL";
        //echo $sql;
        $query = Executor::doit($sql);
        return Model::many($query[0], new NotificationsData());
    }

    public static function getAllByItemId($id)
    {
        $sql = "select * from ".self::$tablename." where item_id=$id";
        $query = Executor::doit($sql);
        return Model::many($query[0], new NotificationsData());
    }

    public static function getAllByItemIdAndRange($id, $start, $finish)
    {
        $sql = "select * from ".self::$tablename." where item_id=$id and ((returned_at>=\"$start\" and returned_at<=\"$finish\") or (start_at>=\"$start\" and start_at<=\"$finish\") or (finish_at>=\"$start\" and finish_at<=\"$finish\")) ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new NotificationsData());
    }
    public static function getAllByClientId($id)
    {
        $sql = "select * from ".self::$tablename." where client_id=$id";
        $query = Executor::doit($sql);
        return Model::many($query[0], new NotificationsData());
    }

    public static function getAllByClientIdAndRange($id, $start, $finish)
    {
        $sql = "select * from ".self::$tablename." where client_id=$id and ((returned_at>=\"$start\" and returned_at<=\"$finish\") or (start_at>=\"$start\" and start_at<=\"$finish\") or (finish_at>=\"$start\" and finish_at<=\"$finish\")) ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new NotificationsData());
    }


    public static function getLike($q)
    {
        $sql = "select * from ".self::$tablename." where name like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new NotificationsData());
    }
}