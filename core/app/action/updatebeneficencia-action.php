<?php
if (count($_POST)>0) {
    $benef = BeneficenciaData::getById($_POST['id']);
    $benef->nroescriturapublica = $_POST["nroescriturapublica"];
    $benef->tipo = $_POST["tipo"];
    $benef->anho = $_POST['anho'];
    $benef->comments=$_POST['comments'];
    $benef->update();
    Session::msg("s", "Actualizado correctamente.");
    Core::redir("./?view=beneficencia");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=beneficencia");
}