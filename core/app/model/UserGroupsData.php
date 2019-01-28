<?php
class UserGroupsData
{
    public static $tablename = "user_groups";

    public function __construct()
    {
        $this->group_name = "";
        $this->group_level = "";
        $this->group_status = "";
    }

    public function add()
    {
        $sql = "insert into ".self::$tablename." (group_name,group_level,group_status) ";
        $sql .= "value (\"$this->group_name\",\"$this->group_level\",\"$this->group_status\" ) ";
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
    public function update()
    {
        $sql = "update ".self::$tablename." set group_name=\"$this->group_name\",group_level=\"$this->group_level\",group_status=\"$this->group_status\" where id=$this->id";
        Executor::doit($sql);
    }
    public function update_status()
    {
        $sql = "update ".self::$tablename." set group_status=\"$this->group_status\" where id=$this->id";
        Executor::doit($sql);
    }

    public function update_passwd()
    {
        $sql = "update ".self::$tablename." set password=\"$this->password\" where id=$this->id";
        Executor::doit($sql);
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::one($query[0], new UserGroupsData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new UserGroupsData());
    }

    /*--------------------------------------------------------------*/
    /* Find all Group name
    /*--------------------------------------------------------------*/
    public static function find_by_groupName($val)
    {
        $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$val}' LIMIT 1 ";
        $query = Executor::doit($sql);
        return Model::one($query[0], new UserGroupsData());
    }

    /*--------------------------------------------------------------*/
    /* Find group level
    /*--------------------------------------------------------------*/
    public static function find_by_groupLevel($level)
    {
        $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$level}' LIMIT 1 ";
        $query = Executor::doit($sql);
        return Model::one($query[0], new UserGroupsData());
    }


    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " ORDER BY created_at DESC "." LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new UserGroupsData());
    }

    public static function getAll()
    {
        $sql = "select * from ".self::$tablename." order by id ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new UserGroupsData());
    }


    public static function getLike($q)
    {
        $sql = "select * from ".self::$tablename." where title like '%$q%' or content like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new UserGroupsData());
    }
}