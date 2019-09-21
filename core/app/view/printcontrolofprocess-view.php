<?php

/**
 * newcontrolofprocess short summary.
 *
 * newcontrolofprocess description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */


$idcp = $_GET['idcp'];
$checklists_id= $_GET['checklists_id'];
$caux= ChecklistsanswerData::getById($idcp);
 $numeroescriturapublica = $caux->numeroescriturapublica;
 $anho = $caux->ep_anho;
 $list = ChecklistsData::getById($checklists_id);
 $answers = ChecklistsanswerData::getAllAnswers($numeroescriturapublica, $anho, $checklists_id);
$display_number = 1;
?>

<table class="table">
    <tr>
        <td><img src="themes/notaria62web/img/logo.png" alt="Notaria 62" style="width: 70px;" /></td>
        <td align="center">NOTARIA SESENTA Y DOS (62) DEL CIRCULO DE BOGOTA CARLOS ARTURO SERRATO GALEANO</td>
    </tr>
    <tr>
        <td colspan="2">Reporte de control porceso de la la escritura publica: <strong>
                <?php echo $caux->numeroescriturapublica;?></strong>
            del a&ntilde;o: <strong><?php echo $anho;?></strong> ,
            con lista de control proceso: <strong><?php echo $list->name.": ".$list->description;?></strong>,
            numero de aprobaci&oacute;n: <strong><?php echo $caux->a_code_approval;?>
            </strong></td>
    </tr>
</table>


<table class="table">
    <thead class="report-header">
        <tr>
            <th>Pregunta</th>
            <th>Opciones</th>
            <!-- <th>No</th> -->
        </tr>
    </thead>
    <?php foreach ($answers as $key => $value) {
    $question = ChecklistsquestionData::getById($value->clq_id);
    $cla_id=$value->cla_id;
    $question1 = $question->question;
    $description = $question->description;
    $q_format= $question->q_format;
    $num_input = $question->num_input;
    $checklistsquestions_id = $question->id; ?>
    <tr>
        <td>
            <?php echo $display_number; ?>. <?php echo $question1; ?>.
            <input type="hidden" name="aid[]" id="aid[]" value='<?php echo $cla_id; ?>'>
        </td>

        <td class="col-md-3">
            <?php
                            if ($q_format=="radio") :
                               echo Util::generateRadioButtons("question".$cla_id ."_answer", $num_input, true, $value->respuesta, "disabled");
    endif; ?>
            <!-- <td class="col-md-1">
            <label><input readonly type="radio" name="question< echo $cla_id; ?>_answer" value="1" <if ($value->respuesta== "1") {
        echo "checked";
    } ?> required></label>
        </td>
        <td class="col-md-1">
            <label><input readonly type="radio" name="question< echo $cla_id; ?>_answer" value="0" < if ($value->respuesta== "0") {
        echo "checked";
    } ?>></label> -->
        </td>
    </tr>
    <?php $display_number++;
} ?>
</table>

<script type="text/javascript">
var document_focus = false; // var we use to monitor document focused status.
// Now our event handlers.
$(document).focus(function() {
    document_focus = true;
});
$(document).ready(function() {
    window.print();
});
setInterval(function() {
    if (document_focus === true) {
        window.close();
    }
}, 500);
</script>
<style>
.table>thead>tr>th,
.table>tbody>tr>th,
.table>tfoot>tr>th,
.table>thead>tr>td,
.table>tbody>tr>td,
.table>tfoot>tr>td {
    border: 1px solid #ccc;
}

.sidebar,
.footer,
nav,
.navbar {
    display: none !important;
}

.main-panel {
    float: none;
    width: 100%;
}

body {
    background-color: #fff;
}

.main-panel>.content {
    margin-top: 0px;
    padding: 0px;
    min-height: 100%;
}
</style>