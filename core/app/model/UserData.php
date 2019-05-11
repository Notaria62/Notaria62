<?php
class UserData
{
    public static $tablename = "users";

    public function __construct()
    {
        $this->name = "";
        $this->lastname = "";
        $this->cc = "";
        $this->gender = "";

        $this->username = "";
        $this->email = "";
        $this->password = "";
        $this->is_active = "0";
        $this->usersprivileges_id = "";
        $this->user_level = "";
        $this->created_at = Util::getDatetimeNow();
    }

    public function add()
    {
        $sql = "insert into " . self::$tablename . " (name,lastname,cc,gender,username,email,password,is_active ,user_level,created_at) ";
        $sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->cc\",$this->gender,\"$this->username\",\"$this->email\",\"$this->password\",$this->is_active ,$this->user_level,\"$this->created_at\")";
        //echo $sql;
        Executor::doit($sql);
    }

    public static function delById($id)
    {
        $sql = "delete from " . self::$tablename . " where id=$id LIMIT 1";
        Executor::doit($sql);
    }
    public function del()
    {
        $sql = "delete from " . self::$tablename . " where id=$this->id";
        Executor::doit($sql);
    }

    // partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto
    public function update()
    {
        $sql = "update " . self::$tablename . " set name=\"$this->name\",lastname=\"$this->lastname\",cc=\"$this->cc\",gender=$this->gender,username=\"$this->username\",password=\"$this->password\",is_active=$this->is_active,user_level=$this->user_level where id=$this->id";
        Executor::doit($sql);
    }

    public function update_passwd()
    {
        $sql = "update " . self::$tablename . " set password=\"$this->password\" where id=$this->id";
        Executor::doit($sql);
    }
    /*--------------------------------------------------------------*/
    /* Function to update the last log in of a user
    /*--------------------------------------------------------------*/

    public static function updateLastLogIn($user_id)
    {
        $date = Util::getDatetimeNow();
        $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
        Executor::doit($sql);
    }


    public static function getById($id)
    {
        $sql = "select * from " . self::$tablename . " where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new UserData());
    }
    public static function getByccAndEmail($cc, $email)
    {
        $sql = "select * from " . self::$tablename . " where cc=$cc and email='$email' ";
        //echo $sql;
        $query = Executor::doit($sql);
        return Model::one($query[0], new UserData());
    }
    public static function getBycc($cc)
    {
        $sql = "select * from " . self::$tablename . " where cc=$cc ";
        //echo $sql;
        $query = Executor::doit($sql);
        return Model::one($query[0], new UserData());
    }
    /*--------------------------------------------------------------*/
    /* Find all user by
    /* Joining users table and user gropus table
    /*--------------------------------------------------------------*/
    public static function find_all_user()
    {
        $sql = "SELECT u.id,u.name,u.username,u.email,u.user_level,u.is_active,u.last_login,";
        $sql .= "g.group_name ";
        $sql .= "FROM users u ";
        $sql .= "LEFT JOIN user_groups g ";
        $sql .= "ON g.group_level=u.user_level ORDER BY u.name ASC";
        $query = Executor::doit($sql);
        return Model::many($query[0], new UserData());
    }

    public static function getAllNumRow()
    {
        $sql = "select * from " . self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new UserData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from " . self::$tablename . " ORDER BY created_at DESC " . " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new UserData());
    }

    public static function getAll()
    {
        $sql = "select * from " . self::$tablename . " order by created_at desc";
        $query = Executor::doit($sql);
        return Model::many($query[0], new UserData());
    }


    public static function getLike($q)
    {
        $sql = "select * from " . self::$tablename . " where title like '%$q%' or content like '%$q%'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new UserData());
    }
}