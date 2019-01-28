<?php

/**
 * ChecklistsanswerData short summary.
 *
 * ChecklistsanswerData description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */

class ChecklistsanswerBCSData
{
    public static $tablename = "checklistsanswersbcs";
    public function __construct()
    {
        $this->id = "";
        $this->numeroescriturapublica = "";
        $this->numradicado= "";
        $this->datedelivery = "";
        $this->dateradication = "";
        $this->datenotaryauthorization = "";
        $this->numanotacioncoordinador = "";
        $this->numanotacionrevisor = "";
        $this->numday="";
        $this->observation="";
        $this->answer ="";
        $this->checklistsquestions_id = "";
        $this->checklists_id ="";
        $this->ep_anho ="";
        $this->user_id ="";
        $this->client_id ="";
        $this->a_code_approval = "";
        $this->code_approval = "";
        $this->created_at = Util::getDatetimeNow();
    }
    public function add()
    {
        $sql= "INSERT INTO ".self::$tablename." (numeroescriturapublica, numradicado, datedelivery, dateradication, datenotaryauthorization, numanotacioncoordinador, numanotacionrevisor, numday, observation, answer, checklistsquestions_id, user_id, client_id, created_at, checklists_id, a_code_approval, code_approval)";
        $sql .= " VALUES (\"$this->numeroescriturapublica\",\"$this->numradicado\",\"$this->datedelivery\",\"$this->dateradication\",\"$this->datenotaryauthorization\",\"$this->numanotacioncoordinador\",\"$this->numanotacionrevisor\",\"$this->numday\",\"$this->observation\",\"$this->answer\",\"$this->checklistsquestions_id\",\"$this->user_id\",\"$this->client_id\",\"$this->created_at\",\"$this->checklists_id\" ,\"$this->a_code_approval\",\"$this->code_approval\" ) ";
        //echo $sql;
        Executor::doit($sql);
    }
    public function update()
    {
        $sql= "UPDATE ".self::$tablename." SET numeroescriturapublica=\"$this->numeroescriturapublica\", numradicado=\"$this->numradicado\", datedelivery=\"$this->datedelivery\", dateradication=\"$this->dateradication\", datenotaryauthorization=\"$this->datenotaryauthorization\", numanotacioncoordinador=\"$this->numanotacioncoordinador\", numanotacionrevisor=\"$this->numanotacionrevisor\", numday=\"$this->numday\", observation=\"$this->observation\", answer=\"$this->answer\", user_id=\"$this->user_id\", a_code_approval=\"$this->a_code_approval\", code_approval=\"$this->code_approval\"   WHERE id=$this->id ";
        //echo $sql;
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
    public static function delBy($checklists_id, $numeroescriturapublica, $numradicado)
    {
        $sql = "delete from ".self::$tablename." where checklists_id=$checklists_id and numeroescriturapublica=$numeroescriturapublica and numradicado=$numradicado";
        //echo $sql;
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
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }

    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        // echo $sql;
        $query = Executor::doit($sql);
        return Model::one($query[0], new ChecklistsanswerBCSData());
    }
    public static function getByRange($start_at, $finish_at)
    {
        $sql = "select * from ".self::$tablename." where created_at>=\"$start_at\" and created_at<=\"$finish_at\" ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }
    public static function getAllNumRowAnswerToListByRange($start_at, $finish_at)
    {
        $sql = "select t1.* from ".self::$tablename. " t1 join (select numeroescriturapublica, min(id) as min_fila from ".self::$tablename." group by numeroescriturapublica, numradicado) t2 on t2.numeroescriturapublica = t1.numeroescriturapublica and t2.min_fila = t1.id and  t1.created_at>=\"$start_at\" and t1.created_at<=\"$finish_at\" order by t1.id ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }
    public static function getByNroRadicado($numradicado)
    {
        $sql = "select * from ".self::$tablename." where numradicado=$numradicado ";
        $query = Executor::doit($sql);
        return Model::one($query[0], new ChecklistsanswerBCSData());
    }
    public static function getByEP($numeroescriturapublica, $anho)
    {
        $sql = "select * from ".self::$tablename." where numeroescriturapublica=$numeroescriturapublica AND ep_anho=$anho";
        $query = Executor::doit($sql);
        return Model::one($query[0], new ChecklistsanswerBCSData());
    }
    public static function getAllAnswersOn($numeroescriturapublica, $numradicado, $checklists_id)
    {
        $sql = "SELECT cl.id as cl_id, cla.id as cla_id, cla.checklistsquestions_id as clq_id,  cla.answer as respuesta FROM checklists as cl LEFT JOIN ".self::$tablename." as cla ON cl.id = cla.checklists_id WHERE cl.checklist_status = 'open' AND cl.id = '".$checklists_id."' AND cla.numeroescriturapublica ='".$numeroescriturapublica."' AND cla.numradicado='".$numradicado."' ORDER BY cla.id ASC ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }
    public static function getAllAnswers($numeroescriturapublica, $numradicados, $checklists_id)
    {
        $sql = "SELECT cl.id as cl_id, cla.id as cla_id, cla.checklistsquestions_id as clq_id, cla.answer as respuesta FROM checklists as cl LEFT JOIN ".self::$tablename." as cla ON cl.id = cla.checklists_id WHERE cl.id = '".$checklists_id."' AND cla.numeroescriturapublica ='".$numeroescriturapublica."' AND cla.numradicado='".$numradicado."' ORDER BY cla.id ASC ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }
    public static function getAllNumRowAnswerToList()
    {
        $sql = "select t1.* from ".self::$tablename. " t1 join (select numeroescriturapublica, min(id) as min_fila from ".self::$tablename." group by numeroescriturapublica, numradicado) t2 on t2.numeroescriturapublica = t1.numeroescriturapublica and t2.min_fila = t1.id order by t1.id ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }
    public static function getAllLimitRowAnswerToList($this_page_first_result, $results_per_page)
    {
        $sql = "select t1.* from ".self::$tablename. " t1 join (select numeroescriturapublica, min(id) as min_fila from ".self::$tablename." group by numeroescriturapublica, numradicado) t2 on t2.numeroescriturapublica = t1.numeroescriturapublica and t2.min_fila = t1.id order by t1.id LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }
    public static function getByLastApprovalCode($datetoday)
    {
        $sql = "select code_approval from ".self::$tablename." where YEAR(created_at)='$datetoday' ORDER BY code_approval DESC LIMIT 1";
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new ChecklistsanswerBCSData());
    }
}