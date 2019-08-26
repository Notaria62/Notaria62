<?php

/**
 * ChecklistsanswerData short summary.
 *
 * ChecklistsanswerData description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */

class ChecklistsanswerData
{
    public static $tablename = "checklistsanswers";
    public function __construct()
    {
        $this->id ="";
        $this->numeroescriturapublica ="";
        $this->observation ="";

        $this->answer ="";
        $this->checklistsquestions_id = "";
        $this->checklists_id ="";
        $this->ep_anho ="";
        $this->user_id ="";
        $this->client_id ="";
        $this->a_code_approval = "";
        $this->created_at = Util::getDatetimeNow();
    }
    public function add()
    {
        $sql= "INSERT INTO ".self::$tablename." (numeroescriturapublica,ep_anho,observation, answer,checklistsquestions_id, user_id, client_id, created_at, checklists_id, a_code_approval)";
        $sql .= " VALUES (\"$this->numeroescriturapublica\",\"$this->ep_anho\",\"$this->observation\",\"$this->answer\",\"$this->checklistsquestions_id\",\"$this->user_id\",\"$this->client_id\",\"$this->created_at\",\"$this->checklists_id\" ,\"$this->a_code_approval\" )";
        Executor::doit($sql);
    }
    public function update()
    {
        $sql= "UPDATE ".self::$tablename." SET observation=\"$this->observation\", answer=\"$this->answer\", user_id=\"$this->user_id\", client_id=\"$this->client_id\", a_code_approval=\"$this->a_code_approval\"   WHERE id=$this->id ";
        Executor::doit($sql);
    }
    public function updateObservation()
    {
        $sql= "UPDATE ".self::$tablename." SET observation=\"$this->observation\" WHERE id=$this->id ";
        Executor::doit($sql);
    }

    public function upload($radicado, $escritura, $CI, $email, $anho, $estatus)
    {
        $sql = "insert into ".self::$tablename." (radicado,escritura,CI,email,anho,estatus,user_id,created_at, checklists_id) ";
        $sql .= "value (\"$radicado\",\"$escritura\",\"$CI\",\"$email\",\"$anho\",\"$estatus\",\"$this->user_id\",$this->created_at,\"$this->checklists_id\")";
        Executor::doit($sql);
    }

    public static function delById($id)
    {
        $sql = "delete from ".self::$tablename." where id=$id";
        Executor::doit($sql);
    }
    public static function delBy($nep, $ep_anho, $checklists_id)
    {
        $sql = "delete from ".self::$tablename." where numeroescriturapublica=$nep and ep_anho=$ep_anho and checklists_id=$checklists_id ";
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
        return Model::many($query[0], new ChecklistsanswerData());
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        // echo $sql;
        $query = Executor::doit($sql);
        return Model::one($query[0], new ChecklistsanswerData());
    }
    public static function getByEP($numeroescriturapublica, $anho)
    {
        $sql = "select * from ".self::$tablename." where numeroescriturapublica=$numeroescriturapublica AND ep_anho=$anho";
        $query = Executor::doit($sql);
        return Model::one($query[0], new ChecklistsanswerData());
    }
    public static function getAllAnswersOn($numeroescriturapublica, $anho, $checklists_id)
    {
        $sql = "SELECT cl.id as cl_id, cla.id as cla_id, cla.checklistsquestions_id as clq_id,  cla.answer as respuesta FROM checklists as cl LEFT JOIN checklistsanswers as cla ON cl.id = cla.checklists_id WHERE cl.checklist_status = 'open' AND cl.id = '".$checklists_id."' AND cla.numeroescriturapublica ='".$numeroescriturapublica."' AND cla.ep_anho='".$anho."' ORDER BY cla.id ASC ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerData());
    }
    public static function getAllAnswers($numeroescriturapublica, $anho, $checklists_id)
    {
        $sql = "SELECT cl.id as cl_id, cla.id as cla_id, cla.checklistsquestions_id as clq_id, cla.answer as respuesta FROM checklists as cl LEFT JOIN checklistsanswers as cla ON cl.id = cla.checklists_id WHERE cl.id = '".$checklists_id."' AND cla.numeroescriturapublica ='".$numeroescriturapublica."' AND cla.ep_anho='".$anho."' ORDER BY cla.id ASC ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerData());
    }
    public static function getAllNumRowAnswerToListByRange($start_at, $finish_at)
    {
        $sql = "select t1.* from ".self::$tablename. " t1 join (select numeroescriturapublica, min(id) as min_fila from ".self::$tablename." group by numeroescriturapublica, ep_anho) t2 on t2.numeroescriturapublica = t1.numeroescriturapublica and t2.min_fila = t1.id and  t1.created_at>=\"$start_at\" and t1.created_at<=\"$finish_at\" order by t1.id ";
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }
    public static function getAllNumRowAnswerToList()
    {
        $sql = "select t1.* from ".self::$tablename. " t1 join (select numeroescriturapublica, min(id) as min_fila from ".self::$tablename." group by numeroescriturapublica, ep_anho) t2 on t2.numeroescriturapublica = t1.numeroescriturapublica and t2.min_fila = t1.id order by t1.id ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerData());
    }
    public static function getAllLimitRowAnswerToList($this_page_first_result, $results_per_page)
    {
        $sql = "select t1.* from ".self::$tablename. " t1 join (select numeroescriturapublica, min(id) as min_fila from ".self::$tablename." group by numeroescriturapublica, ep_anho) t2 on t2.numeroescriturapublica = t1.numeroescriturapublica and t2.min_fila = t1.id order by t1.id LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerData());
    }
}