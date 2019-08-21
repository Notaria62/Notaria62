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
    $position = $_POST['position'];
    $pos=1;
    foreach ($position as $k=>$v) {
        ChecklistsquestionData::updatePositions($pos, $v);
        $pos++;
    }
    Session::msg("s", "Actualizado correctamente.");
//Core::redir("./?view=adminquestionlist");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    //Core::redir("./?view=adminquestionlist");
}