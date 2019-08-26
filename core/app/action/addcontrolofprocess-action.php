<?php
/**
 * Addchecklistquestion short summary.
 *
 * Addchecklistquestion description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
$counter = 0;
$count = count($_POST['qid']);
$codeAproval = "";
if ($count>0) {
    foreach ($_POST['qid'] as $key => $value) {
        if ($_POST['question'.$value.'_answer'] == 1) {
            # code...
            $counter++;
        }
        if ($counter == $count) {
            # code...
            $codeApproval=NumeroALetras::generarCodigo(10);
        } else {
            $codeApproval = "";
        }
    }
    //echo "El codigo de aprobacion es: ". $codeApproval;
    foreach ($_POST['qid'] as $key => $value) {
        $ca = new ChecklistsanswerData();
        $ca->numeroescriturapublica = $_POST['numeroescriturapublica'];
        $ca->observation =isset($_POST["observation"]) ? $_POST["observation"] : "";
        $ca->answer= $_POST['question'.$value.'_answer'];
        $ca->checklistsquestions_id = $value;
        $ca->user_id= Session::getUID();
        $ca->ep_anho = $_POST['ep_anho'];
        $ca->checklists_id = $_POST['checklists_id'];
        $ca->client_id = $_POST['client_id'];
        $ca->a_code_approval = $codeApproval;
        $ca->add();
    }
    Session::msg("s", "Agregado correctamente.");
    Core::redir("./?view=controlofprocess");
} else {
    Session::msg("s", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=controlofprocess");
}