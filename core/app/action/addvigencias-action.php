<?php
if (count($_POST)>0) {
    $c = new VigenciasData();
    $c->consecutivo = $_POST["consecutivo"]!="" ? $_POST["consecutivo"] : "0";
    $c->nroescriturapublica = $_POST["nroescriturapublica"];
    $c->dateescritura = $_POST["dateescritura"];
    $c->otorgotipo = $_POST["otorgotipo"];
    $c->poderdantecc = $_POST["poderdantecc"];
    $c->poderdantename = $_POST["poderdantename"];
    $c->poderdanteccexpedida = $_POST["poderdanteccexpedida"];
    $c->apoderadocc = $_POST["apoderadocc"];
    $c->apoderadoname = $_POST["apoderadoname"];
    $c->apoderadoccexpedida = $_POST["apoderadoccexpedida"];
    $c->solicitante = $_POST["solicitante"];
    $c->observation=$_POST["observation"];
    $c->notario_id =  $_POST["notario_id"];
    $c->user_id=Session::getUID();
    $c->add();
    Session::msg("s", "Agregado correctamente. La vigencia de la E.P.: ".$_POST["nroescriturapublica"]);
    Core::redir("./?view=protocolovigencias");
} else {
    pCore::redir("./?view=protocolovigencias");
}