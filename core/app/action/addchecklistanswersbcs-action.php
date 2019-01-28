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
$codeApproval = "";
if (count($_POST)>0) {
    $flag =ChecklistsanswerBCSData::getByNroRadicado($_POST["numradicado"]);

    if (count($flag)>0) {
        Session::msg("w", "El número de radico ". $_POST["numradicado"]." ya ha sido creado.");
        Core::redir("./?view=newchecklistbcs");
    } else {
        if ($_POST["numanotacioncoordinador"] == $_POST["numanotacionrevisor"] && $_POST["numanotacioncoordinador"] !="0") {
            $result = ChecklistsanswerBCSData::getByLastApprovalCode(date("Y"));
            if (count($result)<=0) {
                $cons = date("Y").Util::zero_fill(1, 4);
            } else {
                foreach ($result as $value) {
                    if ($value->code_approval == 0) {
                        $cons = date("Y").Util::zero_fill(1, 4);
                    } else {
                        $cons = $value->code_approval;
                        $cons++;
                    }
                }
            }
            $const =$cons;
            $codeApproval=$const;
        } else {
            $codeApproval = 0;
        }
        foreach ($_POST['qid'] as $key => $value) {
            $ca = new ChecklistsanswerBCSData();
            $ca->numeroescriturapublica = $_POST['numeroescriturapublica'];
            $ca->numradicado =isset($_POST["numradicado"]) &&  $_POST["numradicado"] != "" ? $_POST["numradicado"] : 0;
            $ca->datedelivery=isset($_POST["datedelivery"]) ? $_POST["datedelivery"] : "";
            $ca->dateradication=isset($_POST["dateradication"]) ? $_POST["dateradication"] : "";
            $ca->datenotaryauthorization=(isset($_POST["datenotaryauthorization"]) && $_POST["datenotaryauthorization"] !="") ? $_POST["datenotaryauthorization"] : "0000-00-00 00:00:00";
            $ca->numanotacioncoordinador=isset($_POST["numanotacioncoordinador"]) &&  $_POST["numanotacioncoordinador"] != "" ? $_POST["numanotacioncoordinador"] : 1;
            $ca->numanotacionrevisor=isset($_POST["numanotacionrevisor"]) &&  $_POST["numanotacionrevisor"] != ""  ? $_POST["numanotacionrevisor"] : 0;
            $ca->numday=isset($_POST["numday"]) &&  $_POST["numday"] != ""  ? $_POST["numday"] : 0;
            $ca->observation=isset($_POST["observation"]) ? $_POST["observation"] : "";
            $ca->answer= isset($_POST['question_'.$value.'_answer'])? $_POST['question_'.$value.'_answer']: 0;
            $ca->checklistsquestions_id = $value;
            $ca->user_id= Session::getUID();
            $ca->checklists_id = $_POST['checklists_id'];
            $ca->client_id = $_POST['client_id'];
            $ca->a_code_approval = "";
            $ca->code_approval = $codeApproval;

            $ca->add();
        }
        Session::msg("s", "Agregado satisfactoriamente.");
        Core::redir("./?view=checklistbcs");
    }
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=checklistbcs");
}