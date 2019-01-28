<?php
class SafetyPaperData
{
    public static $tablename = "safetypaper";
    public function __construct()
    {
        $this->codsheet = "";
        $this->ep = "";
        $this->address = "";
        $this->radicadosnr = "";
        $this->reportdate = "";
        $this->user_id = "";
        $this->is_public = "0";
        $this->created_at = "NOW()";
    }

    public function add()
    {
        $sql = "insert into ".self::$tablename." (codsheet,ep,address,radicadosnr,reportdate,user_id,created_at) ";
        $sql .= "value (\"$this->codsheet\",\"$this->ep\",\"$this->address\",\"$this->radicadosnr\",\"$this->reportdate\",\"$this->user_id\",$this->created_at)";
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

    // partiendo de que ya tenemos creado un objecto ClientData previamente utilizamos el contexto
    public function update_active()
    {
        $sql = "update ".self::$tablename." set last_active_at=NOW() where id=$this->id";
        Executor::doit($sql);
    }


    public function update()
    {
        $sql = "update ".self::$tablename." set codsheet=\"$this->codsheet\",ep=\"$this->ep\",address=\"$this->address\",radicadosnr=\"$this->radicadosnr\",radicadosnr=\"$this->radicadosnr\",reportdate=\"$this->reportdate\",created_at=\"$this->created_at\" where id=$this->id";
        Executor::doit($sql);
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new SafetyPaperData());
    }


    public static function getAll()
    {
        $sql = "select *  from ".self::$tablename." order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new SafetyPaperData());
    }

    public static function getAllActive()
    {
        $sql = "select * from client where last_active_at>=date_sub(NOW(),interval 3 second)";
        $query = Executor::doit($sql);
        return Model::many($query[0], new SafetyPaperData());
    }

    public static function getAllUnActive()
    {
        $sql = "select * from client where last_active_at<=date_sub(NOW(),interval 3 second)";
        $query = Executor::doit($sql);
        return Model::many($query[0], new SafetyPaperData());
    }

    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new SafetyPaperData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new SafetyPaperData());
    }
    public function getUnreads()
    {
        return MessageData::getUnreadsByClientId($this->id);
    }


    public static function getLike($q)
    {
        $sql = "select * from ".self::$tablename." where codsheet like '%$q%' or radicadosnr like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new SafetyPaperData());
    }
}
