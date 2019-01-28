<?php

/**
 * ChecklistsData short summary.
 *
 * ChecklistsData description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */

class ChecklistsData
{
    public static $tablename = "checklists";
    public function __construct()
    {
        $this->id = "";
        $this->name = "";
        $this->description = "";
        $this->user_id = "";
        $this->checklist_status = "";
        $this->created_at = (new \DateTime())->format('Y-m-d H:i:s');
    }
    public function add()
    {
        $sql= "INSERT INTO ".self::$tablename." (name, description, user_id, created_at, checklist_status)";
        $sql .= " VALUES (\"$this->name\",\"$this->description\",\"$this->user_id\",\"$this->created_at\",\"$this->checklist_status\" )";
        //echo $sql;
        Executor::doit($sql);
    }

    public function update()
    {
        $sql= "UPDATE ".self::$tablename." SET name=\"$this->name\", description=\"$this->description\", user_id=\"$this->user_id\", checklist_status=\"$this->checklist_status\"   WHERE id=$this->id ";
        //echo $sql;
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
        return Model::many($query[0], new ChecklistsData());
    }
    public static function getAllOpen()
    {
        $sql = "select * from ".self::$tablename. " WHERE checklist_status ='open'";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsData());
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new ChecklistsData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new ChecklistsData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new ChecklistsData());
    }
}
