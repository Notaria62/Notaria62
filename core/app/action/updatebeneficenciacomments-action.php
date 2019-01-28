<?php
if (count($_POST)>0) {
    $benef = BeneficenciaData::getById($_POST['id']);
    $benef->comments=$_POST['comments'];
    $benef->update();
    Session::msg("s", "La observación del nro. escritura publica: $benef->nroescriturapublica fue agregada correctamente.");
    Core::redir("./?view=beneficencia");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=beneficencia");
}
