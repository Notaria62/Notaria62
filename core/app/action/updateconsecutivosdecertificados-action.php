<?php

if (count($_POST)>0) {
    $cc = ConsecutivosDeCertificadosData::getById($_POST["id"]);
    $cc->nroescriturapublica = $_POST["nroescriturapublica"];
    $cc->dateescritura = $_POST["dateescritura"];
    $cc->consecutivo = $_POST["consecutivo"];
    $cc->user_id=Session::getUID();
    //$flag = ConsecutivosDeCertificadosData::getByConsecutivo($_POST["nroescriturapublica"],$_POST["dateescritura"],$_POST["consecutivo"]);
    $cc->update();
    Session::msg("s", "Actualizado correctamente.");
    Core::redir("./?view=consecutivosdecertificados");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=consecutivosdecertificados");
}
