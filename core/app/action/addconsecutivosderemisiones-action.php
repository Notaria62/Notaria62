<?php

if (count($_POST)>0) {
    $cc = new ConsecutivosDeRemisionesData();
    $cc->nroescriturapublica = $_POST["nroescriturapublica"];
    $cc->radicado = $_POST["radicado"];
    $cc->tipo = $_POST["tipo"];
    $cc->consecutivo = $_POST["consecutivo"];
    $cc->user_id=Session::getUID();
    $flag = ConsecutivosDeRemisionesData::getByConsecutivo($_POST["nroescriturapublica"], date("Y"), $_POST["consecutivo"]);
    if (empty($flag)) {
        $cc->add();
        Session::msg("s", "Agregado satisfactoriamente.");

        Core::redir("./?view=consecutivosderemisiones");
    } else {
        Session::msg("d", "No se pudo agregar, porque el consecutivo ya esta asignado.");
        Core::redir("./?view=consecutivosderemisiones");
    }
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=consecutivosderemisiones");
}
