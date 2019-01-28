<?php
/**
 * updatechecklistquestion short summary.
 *
 * updatechecklistquestion description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */


if (count($_POST)>0) {
    $clq = ChecklistsquestionData::getById($_POST['id']);
    $clq->question = $_POST["question"];
    $clq->description = $_POST["description"];
    $clq->linkpdf = isset($_POST["linkpdf"])? $_POST["linkpdf" ]: null;
    $clq->checklists_id = $_POST["ddllists"];
    $clq->q_status = $_POST["ddllquestionstatus"];
    $clq->position = $_POST["position"];
    $clq->user_id=Session::getUID();
    $clq->update();
    Session::msg("s", "Actualizado correctamente.");
    Core::redir("./?view=adminquestionlist");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=adminquestionlist");
}
