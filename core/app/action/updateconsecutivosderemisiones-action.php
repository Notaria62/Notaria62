<?php

if (count($_POST)>0) {
    $cc = ConsecutivosDeRemisionesData::getById($_POST["id"]);
    $cc->nroescriturapublica = $_POST["nroescriturapublica"];
    $cc->radicado = $_POST["radicado"];
    $cc->tipo = $_POST["tipo"];

    $cc->consecutivo = $_POST["consecutivo"];
    $cc->user_id=Session::getUID();
    $cc->update();
    Session::msg("s", "Actualizado correctamente.");
    Core::redir("./?view=consecutivosderemisiones");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=consecutivosderemisiones");
}
