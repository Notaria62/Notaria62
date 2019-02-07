<?php

if (count($_POST)>0) {
    $is_registro=0;
    if (isset($_POST["is_registro"])) {
        $is_registro=1;
    }

    $c = CierresData::getById($_POST["id"]);
    $c->is_registro = $is_registro;

    $c->nrocopia = $_POST["nrocopia"]!="" ? $_POST["nrocopia"] : "0";
    $c->nroescriturapublica = $_POST["nroescriturapublica"];
    $c->dateescritura = $_POST["dateescritura"];
    $c->numfolios = $_POST["numfolios"];
    $c->observationcopy1 = $_POST["observationcopy1"];
    $c->observationcopy2 = $_POST["observationcopy2"];
    $c->destino= $_POST["destino"];
    $c->notario_id = trim($_POST["notario_id"]);
    $c->user_id= Session::getUID();
    $c->update();
    Session::msg("s", "Actualizado correctamente. El cierre de la E.P.: ".$_POST["nroescriturapublica"]);
    Core::redir("./?view=protocolocierres");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=protocolocierres");
}