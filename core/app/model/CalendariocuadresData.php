<?php
class CalendariocuadresData
{
    public static $tablename = "calendariocuadres";


    public function __construct()
    {
        $this->title = "";
        $this->body = "";
        $this->allday = "";
        $this->classname = "";
        $this->start_at = "";
        $this->end_at = "";
        $this->user_id = "";
        $this->created_at = Util::getDatetimeNow();
    }



    public function add()
    {
        $sql = "insert into " . self::$tablename . " (user_id, title,body,classname,start_at,end_at, allday, created_at) ";
        $sql .= "value (\"$this->user_id\",\"$this->title\",\"$this->body\",\"$this->classname\",\"$this->start_at\",\"$this->end_at\",\"$this->allday\",\"$this->created_at\")";
       // echo $sql;
        return Executor::doit($sql);
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

    // partiendo de que ya tenemos creado un objecto EventosData previamente utilizamos el contexto
    public function update()
    {
        $sql = "update " . self::$tablename . " set title=\"$this->title\", body=\"$this->body\", classname=\"$this->classname\", created_at=\"$this->created_at\"  where id=$this->id";
        echo $sql;
        Executor::doit($sql);
    }

    public function finalize()
    {
        $sql = "update " . self::$tablename . " set returned_at=NOW() where id=$this->id";
        Executor::doit($sql);
    }

    public static function getById($id)
    {
        $sql = "select * from " . self::$tablename . " where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new CalendariocuadresData());
    }

    public static function getAll()
    {
        $sql = "select * from " . self::$tablename;
        $query = Executor::doit($sql);
        //return $sql;
        return Model::many($query[0], new CalendariocuadresData());
    }
    public static function getRentsByRange($start, $finish)
    {
        $sql = "select * from " . self::$tablename . " where (  (\"$start\">=start_at and \"$finish\"<=finish_at) or (start_at>=\"$start\" and finish_at<=\"$finish\") )  and returned_at is NULL ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CalendariocuadresData());
    }


    public static function getByRange($start, $finish)
    {
        $sql = "select * from " . self::$tablename . " where returned_at>=\"$start\" and returned_at<=\"$finish\" and returned_at is not NULL ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CalendariocuadresData());
    }

    public static function getRents()
    {
        $sql = "select * from " . self::$tablename . " where returned_at is NULL";
        //echo $sql;
        $query = Executor::doit($sql);
        return Model::many($query[0], new CalendariocuadresData());
    }

    public static function getAllByItemId($id)
    {
        $sql = "select * from " . self::$tablename . " where item_id=$id";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CalendariocuadresData());
    }

    public static function getAllByItemIdAndRange($id, $start, $finish)
    {
        $sql = "select * from " . self::$tablename . " where item_id=$id and ((returned_at>=\"$start\" and returned_at<=\"$finish\") or (start_at>=\"$start\" and start_at<=\"$finish\") or (finish_at>=\"$start\" and finish_at<=\"$finish\")) ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CalendariocuadresData());
    }
    public static function getAllByClientId($id)
    {
        $sql = "select * from " . self::$tablename . " where client_id=$id";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CalendariocuadresData());
    }

    public static function getAllByClientIdAndRange($id, $start, $finish)
    {
        $sql = "select * from " . self::$tablename . " where client_id=$id and ((returned_at>=\"$start\" and returned_at<=\"$finish\") or (start_at>=\"$start\" and start_at<=\"$finish\") or (finish_at>=\"$start\" and finish_at<=\"$finish\")) ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CalendariocuadresData());
    }


    public static function getLike($q)
    {
        $sql = "select * from " . self::$tablename . " where name like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CalendariocuadresData());
    }
}