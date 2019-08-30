<?php

if (count($_POST)>0) {
    $cc = new ConsecutivosDeCertificadosData();
    $cc->nroescriturapublica = $_POST["nroescriturapublica"];
    $cc->dateescritura = $_POST["dateescritura"];
    $cc->consecutivo = $_POST["consecutivo"];
    $cc->user_id=Session::getUID();
    $flag = ConsecutivosDeCertificadosData::getByConsecutivo($_POST["dateescritura"], $_POST["consecutivo"]);
    if (empty($flag)) {
        $cc->add();
        Session::msg("s", "Agregado satisfactoriamente.");
        //echo "-------bien-------";
        Core::redir("./?view=consecutivosdecertificados");
    } else {
        Session::msg("d", "No se pudo agregar, porque el consecutivo ya esta asignado.");
        Core::redir("./?view=newconsecutivosdecertificados");
        //  echo "-------Exite-------";
    }
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=consecutivosdecertificados");
}