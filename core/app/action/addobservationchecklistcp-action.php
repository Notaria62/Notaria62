<?php

/**
 * addmemorandum_action short summary.
 *
 * addmemorandum_action description.
 *
 * @version 1.0
 * @author sistemas
 */

if (count($_POST)>0) {
    $memo = ChecklistsanswerData::getById($_POST["id"]);
    $memo->observation = $_POST["observation"];
    $memo->user_id=Session::getUID();
    $memo->updateObservation();
    Session::msg("s", "Observación agregada correctamente.");
    Core::redir("./?view=controlofprocess");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=controlofprocess");
}
