<?php

/**
 * ChecklistsquestionsData short summary.
 *
 * ChecklistsquestionsData description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */

class ChecklistsquestionData
{
    public static $tablename = "checklistsquestions";
    public function __construct()
    {
        $this->id ="";
        $this->question ="";
        $this->description ="";
        $this->linkpdf = "";
        $this->checklists_id ="";
        $this->q_status = "";
        $this->position ="";
        $this->q_format = "radio";
        $this->num_input = "";

        $this->user_id ="";
        $this->created_at = Util::getDatetimeNow();
    }
    public function add()
    {
        $sql= "INSERT INTO ".self::$tablename." (question, description, linkpdf, user_id, created_at, checklists_id, q_status, position, q_format, num_input)";
        $sql .= " VALUES (\"$this->question\",\"$this->description\",\"$this->linkpdf\",\"$this->user_id\",\"$this->created_at\",\"$this->checklists_id\",\"$this->q_status\",\"$this->position\",\"$this->q_format\",\"$this->num_input\" )";
        //  echo $sql;
        Executor::doit($sql);
    }

    public function update()
    {
        $sql= "UPDATE ".self::$tablename." SET question=\"$this->question\", description=\"$this->description\",linkpdf=\"$this->linkpdf\", checklists_id=\"$this->checklists_id\",user_id=\"$this->user_id\", q_status=\"$this->q_status\", position=\"$this->position\", num_input=\"$this->num_input\"  WHERE id=$this->id ";
        Executor::doit($sql);
    }
    public static function updatePositions($position, $id)
    {
        $sql= "UPDATE ".self::$tablename." SET position=\"$position\" WHERE id=$id ";
        echo $sql." - ";
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


    public static function getAllQuestionsOn($mode, $id)
    {
        $sql = "SELECT *, cl.id as cl_id, clq.id as clq_id, clq.question as pregunta  FROM checklists as cl LEFT JOIN ".self::$tablename." as clq ON cl.id = clq.checklists_id WHERE cl.checklist_status = '".$mode."' AND cl.id = '".$id."' AND clq.q_status = 'on' ORDER BY clq.position ASC";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsquestionData());
    }


    public static function getAll()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsquestionData());
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new ChecklistsquestionData());
    }
    public static function getAllByChecklistsId($checklists_id)
    {
        $sql = "select * from ".self::$tablename. " WHERE checklists_id=$checklists_id";
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new ChecklistsquestionData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new ChecklistsquestionData());
    }
    public static function getAllNumRowQuestionToList($checklists_id)
    {
        $sql = "select * from ".self::$tablename. " WHERE checklists_id=$checklists_id ";
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new ChecklistsquestionData());
    }
    public static function getAllLimitRowQuestionToList($checklists_id, $this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " WHERE checklists_id=$checklists_id". " ORDER BY position ASC LIMIT " . $this_page_first_result . "," .  $results_per_page . "";
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new ChecklistsquestionData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new ChecklistsquestionData());
    }
}