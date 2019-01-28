<?php
/**
 * Addchecklist short summary.
 *
 * Addchecklist description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */

if (count($_POST)>0) {
    $cl = ChecklistsData::getById($_POST['id']);
    $cl->name = $_POST["name"];
    $cl->description = $_POST["description"];
    $cl->checklist_status = $_POST['ddlchecklist_status'];
    $cl->user_id=Session::getUID();
    $cl->update();
    Session::msg("s", "Actualizado correctamente.");
    Core::redir("./?view=adminchecklists");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=adminchecklists");
}
