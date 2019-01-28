<?php

/**
 * addmemorandum_action short summary.
 *
 * addmemorandum_action description.
 *
 * @version 1.0
 * @author sistemas
 */
//echo "paso ". count($_POST);
//echo isset($_POST["identificacion3"]);
//echo isset($_POST["identificacion4"]);
if (count($_POST)>0) {
    $memo = MemorandumData::getById($_POST["id"]);
    $memo->sare = $_POST["sare"];
    $memo->officecode = $_POST["officecode"];
    $memo->radicado = $_POST["radicado"];
    $memo->typeident1  = isset($_POST["typeident1"]) ? $_POST["typeident1"] : "0";
    $memo->identificacion1  = isset($_POST["identificacion1"]) ? $_POST["identificacion1"] : "0";
    $memo->fullname1 = isset($_POST["fullname1"]) ? $_POST["fullname1"] : "0";

    $memo->typeident2  = isset($_POST["typeident2"]) ? $_POST["typeident2"] : "0";
    $memo->identificacion2  = isset($_POST["identificacion2"]) ? $_POST["identificacion2"] : "0";
    $memo->fullname2 = isset($_POST["fullname2"]) ? $_POST["fullname2"] : "0";

    $memo->typeident3  = isset($_POST["typeident3"]) ? $_POST["typeident3"] : "0";
    $memo->identificacion3  = isset($_POST["identificacion3"]) ? $_POST["identificacion3"] : "0";
    $memo->fullname3 = isset($_POST["fullname3"]) ? $_POST["fullname3"] : "0";

    $memo->typeident4  = isset($_POST["typeident4"]) ? $_POST["typeident4"] : "0";
    $memo->identificacion4  = isset($_POST["identificacion4"]) ? $_POST["identificacion4"] : "0";
    $memo->fullname4 = isset($_POST["fullname4"]) ? $_POST["fullname4"] : "0";

    $memo->matriculainmobiliaria = $_POST["matriculainmobiliaria"];
    $memo->numeroescriturapublica = $_POST["numeroescriturapublica"];
    $memo->dateotorgamiento = $_POST["dateotorgamiento"];
    $memo->ubicacionpredio = $_POST["ubicacionpredio"];
    $memo->direccioninmueble = $_POST["direccioninmueble"];
    $memo->numeroescriturahipoteca = $_POST["numeroescriturahipoteca"];
    $memo->notariaescriturahipoteca = $_POST["notariaescriturahipoteca"];
    $memo->oficinaregistrohipoteca = $_POST["oficinaregistrohipoteca"];
    $memo->dateescriturahipoteca = $_POST["dateescriturahipoteca"];
    $memo->cuantiahipoteca = $_POST["cuantiahipoteca"];
    $memo->nombrebanco = $_POST["nombrebanco"];
    $memo->digitador_id = $_POST["digitador_id"];
    $memo->numerocertificado = $_POST["numerocertificado"];
    $memo->numerohojaspapelnotarial = $_POST["numerohojaspapelnotarial"];
    $memo->derechosnotariales = isset($_POST["derechosnotariales"])? $_POST["derechosnotariales"]:"57600";
    $memo->superintendencia = isset($_POST["superintendencia"])? $_POST["superintendencia"]:"6200";
    $memo->fondonacionalnotariado = isset($_POST["fondonacionalnotariado"])? $_POST["fondonacionalnotariado"]:"6200";
    $memo->iva = isset($_POST["iva"])? $_POST["iva"]:"23351";
    $memo->notario_id = $_POST["notario_id"];
    $memo->dateresolucionnotario = isset($_POST["dateresolucionnotario"])? $_POST["dateresolucionnotario"]:"0";
    $memo->resolucionnotario = isset($_POST["resolucionnotario"])? $_POST["resolucionnotario"]: "0";
    $memo->templatememo_id = $_POST["templatememo_id"];
    $memo->user_id=Session::getUID();
    $memo->update();
    Session::msg("s", "Actualizado correctamente.");
    Core::redir("./?view=memorandumcreated");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=memorandumcreated");
}
