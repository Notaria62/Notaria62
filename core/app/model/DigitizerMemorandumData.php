<?php

/**
 * MemorandumData short summary.
 *
 * MemorandumData description.
 *
 * @version 1.0
 * @author sistemas
 */
class MemorandumData
{
    public static $tablename = "digitizermemorandum";
    public function __construct()
    {
        $this->sare = "";
        $this->officecode = "";
        $this->radicado = "";
        $this->debtors_id = "";
        $this->typeident1 = "";
        $this->identificacion1 = "";
        $this->fullname1 = "";
        $this->typeident2 = "";
        $this->identificacion2 = "";
        $this->fullname2 = "";
        $this->typeident3 = "";
        $this->identificacion3 = "";
        $this->fullname3 = "";
        $this->typeident4 = "";
        $this->identificacion4 = "";
        $this->fullname4 = "";
        $this->matriculainmobiliaria = "";
        $this->numeroescriturapublica = "";
        $this->dateotorgamiento = "";
        $this->ubicacionpredio = "";
        $this->direccioninmueble = "";
        $this->numeroescriturahipoteca = "";
        $this->notariaescriturahipoteca = "";
        $this->oficinaregistrohipoteca = "";
        $this->dateescriturahipoteca = "";
        $this->cuantiahipoteca = "";
        $this->nombrebanco = "";
        $this->observation = "";
        $this->digitador_id = "";
        $this->numerocertificado = "";
        $this->numerohojaspapelnotarial = "";
        $this->derechosnotariales = "";
        $this->superintendencia = "";
        $this->fondonacionalnotariado = "";
        $this->iva = "";
        $this->observation = "";
        $this->notario_id = "";
        $this->dateresolucionnotario ="";
        $this->resolucionnotario = "";
        $this->templatememo_id = "";
        $this->user_id = "";
        $this->is_approved = "";
        $this->is_public = "0";
        $this->created_at = Util::getDatetimeNow();
    }


    public function add()
    {
        $nombrebanco = addslashes($this->nombrebanco);
        $direccioninmueble = addslashes($this->direccioninmueble);
        $sql= "INSERT INTO memorandum(sare,officecode,radicado, typeident1, identificacion1, fullname1, typeident2, identificacion2, fullname2, typeident3, identificacion3, fullname3, ";
        $sql .= "typeident4, identificacion4, fullname4, matriculainmobiliaria, numeroescriturapublica, dateotorgamiento, ubicacionpredio, direccioninmueble, numeroescriturahipoteca, ";
        $sql .= "notariaescriturahipoteca, oficinaregistrohipoteca, dateescriturahipoteca, cuantiahipoteca, nombrebanco, digitador_id, numerocertificado, numerohojaspapelnotarial, ";
        $sql .= "derechosnotariales, superintendencia, fondonacionalnotariado, iva, observation, notario_id,dateresolucionnotario,resolucionnotario, templatememo_id, user_id, created_at) VALUES ";
        $sql .= "(\"$this->sare\",\"$this->officecode\",\"$this->radicado\",\"$this->typeident1\",\"$this->identificacion1\",\"$this->fullname1\",\"$this->typeident2\",\"$this->identificacion2\",\"$this->fullname2\",";
        $sql .= "\"$this->typeident3\",\"$this->identificacion3\",\"$this->fullname3\",\"$this->typeident4\",\"$this->identificacion4\",\"$this->fullname4\",\"$this->matriculainmobiliaria\",\"$this->numeroescriturapublica\",";
        $sql .= "\"$this->dateotorgamiento\",\"$this->ubicacionpredio\",\"$direccioninmueble\",\"$this->numeroescriturahipoteca\",\"$this->notariaescriturahipoteca\",";
        $sql .= "\"$this->oficinaregistrohipoteca\",\"$this->dateescriturahipoteca\",\"$this->cuantiahipoteca\",\"$nombrebanco\",$this->digitador_id,\"$this->numerocertificado\",";
        $sql .= "\"$this->numerohojaspapelnotarial\",\"$this->derechosnotariales\",\"$this->superintendencia\",\"$this->fondonacionalnotariado\",\"$this->iva\",\"\",\"$this->notario_id\",\"$this->dateresolucionnotario\",\"$this->resolucionnotario\",";
        $sql .= "\"$this->templatememo_id\",\"$this->user_id\",\"$this->created_at\" )";
        //echo $sql;
        Executor::doit($sql);
    }
    // partiendo de que ya tenemos creado un objecto MemorandumData previamente utilizamos el contexto
    public function update()
    {
        $nombrebanco = addslashes($this->nombrebanco);
        $direccioninmueble = addslashes($this->direccioninmueble);
        $sql= "UPDATE ".self::$tablename." SET sare=\"$this->sare\",officecode=\"$this->officecode\", radicado=\"$this->radicado\", typeident1=\"$this->typeident1\", identificacion1=\"$this->identificacion1\", fullname1=\"$this->fullname1\",";
        $sql .= "typeident2=\"$this->typeident2\", identificacion2=\"$this->identificacion2\", fullname2=\"$this->fullname2\", typeident3=\"$this->typeident3\", identificacion3=\"$this->identificacion3\", fullname3=\"$this->fullname3\", ";
        $sql .= "typeident4=\"$this->typeident4\", identificacion4=\"$this->identificacion4\", fullname4=\"$this->fullname4\", matriculainmobiliaria=\"$this->matriculainmobiliaria\", numeroescriturapublica=\"$this->numeroescriturapublica\", ";
        $sql .= "dateotorgamiento=\"$this->dateotorgamiento\", ubicacionpredio=\"$this->ubicacionpredio\", direccioninmueble=\"$direccioninmueble\", numeroescriturahipoteca=\"$this->numeroescriturahipoteca\", ";
        $sql .= "notariaescriturahipoteca=\"$this->notariaescriturahipoteca\", oficinaregistrohipoteca=\"$this->oficinaregistrohipoteca\", dateescriturahipoteca=\"$this->dateescriturahipoteca\",";
        $sql .= "cuantiahipoteca=\"$this->cuantiahipoteca\", nombrebanco=\"$nombrebanco\", digitador_id=$this->digitador_id, numerocertificado=\"$this->numerocertificado\", numerohojaspapelnotarial=\"$this->numerohojaspapelnotarial\", ";
        $sql .= "derechosnotariales=\"$this->derechosnotariales\", superintendencia=\"$this->superintendencia\", fondonacionalnotariado=\"$this->fondonacionalnotariado\", iva=\"$this->iva\", notario_id=\"$this->notario_id\",dateresolucionnotario=\"$this->dateresolucionnotario\",resolucionnotario=\"$this->resolucionnotario\", templatememo_id=\"$this->templatememo_id\", user_id=$this->user_id WHERE id=$this->id ";
        Executor::doit($sql);
    }
    public function updateApproved()
    {
        $sql= "UPDATE ".self::$tablename." SET is_approved=\"$this->is_approved\", user_id=$this->user_id WHERE id=$this->id ";
        Executor::doit($sql);
    }
    public function updateObservation()
    {
        $sql= "UPDATE ".self::$tablename." SET observation=\"$this->observation\" WHERE id=$this->id ";
        Executor::doit($sql);
    }
    public function upload($radicado, $escritura, $CI, $email, $anho, $estatus)
    {
        $sql = "insert into ".self::$tablename." (radicado,escritura,CI,email,anho,estatus,user_id,created_at) ";
        $sql .= "value (\"$radicado\",\"$escritura\",\"$CI\",\"$email\",\"$anho\",\"$estatus\",\"$this->user_id\",$this->created_at)";
        Executor::doit($sql);
    }

    public static function delById($id)
    {
        $sql = "delete from ".self::$tablename." where id=$id";
        Executor::doit($sql);
    }
    public static function getByRange($start_at, $finish_at)
    {
        $sql = "select * from ".self::$tablename." where created_at>=\"$start_at\" and created_at<=\"$finish_at\" ";
        $query = Executor::doit($sql);
        return Model::many($query[0], new MemorandumData());
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
        return Model::many($query[0], new MemorandumData());
    }
    public static function getAllBancos()
    {
        $sql = "select DISTINCT nombrebanco from ".self::$tablename ;
        $query = Executor::doit($sql);
        return Model::many($query[0], new MemorandumData());
    }
    public static function getAllNotarias()
    {
        $sql = "select DISTINCT notariaescriturahipoteca from ".self::$tablename ;
        $query = Executor::doit($sql);
        return Model::many($query[0], new MemorandumData());
    }
    public static function getById($id)
    {
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0], new MemorandumData());
    }
    public static function getAllNumRow()
    {
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        //echo $query;
        return Model::many($query[0], new MemorandumData());
    }

    public static function getAllLimitRow($this_page_first_result, $results_per_page)
    {
        $sql = "select * from ".self::$tablename. " ORDER BY created_at DESC LIMIT " . $this_page_first_result . "," .  $results_per_page;
        $query = Executor::doit($sql);
        //echo $sql;
        return Model::many($query[0], new MemorandumData());
    }
}