<?php
/**
 * updatecontrolofprocess short summary.
 *
 * updatecontrolofprocess description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
$counter = 0;
$count = count($_POST['aid']);
//echo $count;
$codeApproval = "";
if ($count>0) {
    foreach ($_POST['aid'] as $key => $value) {
        if ($_POST['question'.$value.'_answer'] == 1) {
            $counter++;
        }
        if ($counter == $count) {
            $codeApproval=NumeroALetras::generarCodigo(10);
        } else {
            $codeApproval="";
        }
    }
    //echo "El codigo de aprobacion es: ". $codeApproval;
    foreach ($_POST['aid'] as $key => $value) {
        $ca = ChecklistsanswerData::getById($value);
        //print_r($ca);
        $ca->answer= $_POST['question'.$value.'_answer'];
        $ca->user_id= Session::getUID();
        $ca->a_code_approval = $codeApproval;
        $ca->update();
    }
    Seesion::msg("s", "Actualizado correctamente.");
    Core::redir("./?view=controlofprocess");
} else {
    Seesion::msg("d", "Error al actualizar, por favor llame al administrador del sistema.");
    Core::redir("./?view=controlofprocess");
}
