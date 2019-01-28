<?php
/**
 * updateccheclistbcs short summary.
 *
 * updateccheclistbcs description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
$counter = 0;
$count = count($_POST['aid']);
//echo $count;
$codeApproval = "";
if ($count>0) {
    if ($_POST["numanotacioncoordinador"] == $_POST["numanotacionrevisor"]) {
        $result = ChecklistsanswerBCSData::getByLastApprovalCode(date("Y"));
        if (count($result)<=0) {
            $cons = date("Y").Util::zero_fill(1, 4);
        } else {
            foreach ($result as $value) {
                if ($value->code_approval == "" || $value->code_approval == 0) {
                    $cons = date("Y").Util::zero_fill(1, 4);
                //echo "es cero ".$cons;
                } else {
                    $cons = $value->code_approval;
                    $cons++;
                }
            }
        }
        $const =$cons;
        $codeApproval=$const;
    } else {
        $codeApproval=0;
    }
    foreach ($_POST['aid'] as $key => $value) {
        $ca = ChecklistsanswerBCSData::getById($value);
        $ca->numeroescriturapublica = $_POST['numeroescriturapublica'];
        $ca->numradicado =isset($_POST["numradicado"]) &&  $_POST["numradicado"] != "" ? $_POST["numradicado"] : 0;
        $ca->datedelivery=isset($_POST["datedelivery"]) ? $_POST["datedelivery"] : "";
        $ca->dateradication=isset($_POST["dateradication"]) ? $_POST["dateradication"] : "";
        $ca->datenotaryauthorization=isset($_POST["datenotaryauthorization"]) ? $_POST["datenotaryauthorization"] : "";
        $ca->numanotacioncoordinador=isset($_POST["numanotacioncoordinador"]) &&  $_POST["numanotacioncoordinador"] != "" ? $_POST["numanotacioncoordinador"] : 1;
        $ca->numanotacionrevisor=isset($_POST["numanotacionrevisor"]) &&  $_POST["numanotacionrevisor"] != ""  ? $_POST["numanotacionrevisor"] : 0;
        $ca->numday=isset($_POST["numday"]) &&  $_POST["numday"] != ""  ? $_POST["numday"] : 0;
        $ca->observation=isset($_POST["observation"]) ? $_POST["observation"] : "";
        $ca->answer= isset($_POST['question_'.$value.'_answer'])? $_POST['question_'.$value.'_answer']: 0;
        $ca->checklistsquestions_id = $value;
        $ca->user_id= Session::getUID();
        $ca->checklists_id = $_POST['checklists_id'];
        $ca->a_code_approval = isset($_POST["a_code_approval"]) &&  $_POST["a_code_approval"] != "" && ($_POST["numanotacioncoordinador"] == $_POST["numanotacionrevisor"]) ? $_POST["a_code_approval"] : "";
        $ca->code_approval = isset($_POST["code_approval"]) &&  $_POST["code_approval"] != 0 && ($_POST["numanotacioncoordinador"] == $_POST["numanotacionrevisor"]) ? $_POST["code_approval"] : $codeApproval;

        $ca->update();
    }
    Session::msg("s", "Actualizado correctamente.");
    Core::redir("./?view=checklistbcs");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=checklistbcs");
}