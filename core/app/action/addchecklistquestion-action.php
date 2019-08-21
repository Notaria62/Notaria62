<?php
/**
 * Addchecklistquestion short summary.
 *
 * Addchecklistquestion description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */

if (count($_POST)>0) {
    $cq = new ChecklistsquestionData();
    $cq->question = $_POST["question"];
    $cq->description = $_POST["description"];
    $cq->linkpdf = isset($_POST["linkpdf"]) ? $_POST["linkpdf"] : null;
    $cq->checklists_id = $_POST["ddllists"];
    $cq->q_status = $_POST["ddllquestionstatus"];
    $cq->position = isset($_POST["position"]) ? $_POST["position"] : 999;
    $cq->num_input = $_POST["num_input"];
    $cq->user_id=Session::getUID();
    $cq->add();
    Session::msg("s", "Agregado satisfactoriamente.");
    Core::redir("./?view=adminquestionlist");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=adminquestionlist");
}