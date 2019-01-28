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
$caux= ChecklistsanswerBCSData::getById($idcp);
$numeroescriturapublica = $caux->numeroescriturapublica;
$numradicado = $caux->numradicado;
$numanotacioncoordinador = $caux->numanotacioncoordinador;
$numanotacionrevisor = $caux->numanotacionrevisor;
$datedelivery = $caux->datedelivery;
$dateradication = $caux->dateradication;
$datenotaryauthorization = $caux->datenotaryauthorization;
$observation = $caux->observation;
$numday = $caux->numday;

 $list = ChecklistsData::getById($checklists_id);
 $answers = ChecklistsanswerBCSData::getAllAnswersOn($numeroescriturapublica, $numradicado, $checklists_id);

$display_number = 1;
?>




<table class="material-datatables table-bordered">
    <tr>
        <td><img src="themes/notaria62web/img/logo.png" alt="Notaria 62" style="width: 70px;" /></td>
        <td align="center">
            <h3>NOTARIA SESENTA Y DOS (62) DEL CIRCULO DE BOGOTA CARLOS ARTURO SERRATO GALEANO</h3>
        </td>
    </tr>
    <tr>
        <td colspan="2">Reporte de lista de chequeo de la escritura publica: <strong>
                <?= $caux->numeroescriturapublica;?></strong>
            del radicado: <strong>
                <?= $numradicado;?></strong>
            ,
            con lista de control proceso: <strong>
                <?= $list->name.": ".$list->description;?></strong>,
            numero de aprobaci&oacute;n: <strong>
                <?= $caux->code_approval;?>
            </strong></td>
    </tr>
    <tr>
        <td colspan="2">
            <label for="" class="bmd-label-floating">C) Fecha de reparto: </label> <span>
                <?=$datedelivery?></span>
            <label for="" class="bmd-label-floating">C) Fecha de radicaci&oacute;n: </label> <span>
                <?=$dateradication?></span>
            <label for="" class="bmd-label-floating">Fecha de autorizaci&oacute;n escritura notario: </label> <span>
                <?=$datenotaryauthorization?></span>
            <label for="" class="bmd-label-floating">Nro. E.P.: </label><span>
                <?=$numeroescriturapublica?></span>
            <label for="" class="bmd-label-floating">Nro. radicado: </label> <span>
                <?=$numradicado?></span>
            <label for="" class="bmd-label-floating">C) Nro. anotaci&oacute;n: </label> <span>
                <?=$numanotacioncoordinador?></span>
            <label for="" class="bmd-label-floating">A) Nro. anotaci&oacute;n: </label><span>
                <?=$numanotacionrevisor?></span>
            <label for="" class="bmd-label-floating">Observaciones: </label><span>
                <?=$observation?></span>
            <label class="">C) Total de d&iacute;as</label> : <span id="numday_span">
                <?=$numday?>
            </span>
        </td>
    </tr>
</table>


<table class="material-datatables table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th>Pregunta</th>
            <th class="disabled-sorting text-right">Opciones</th>
        </tr>
    </thead>
    <?php foreach ($answers as $key => $value) {
    $question = ChecklistsquestionData::getById($value->clq_id);
    $cla_id=$value->cla_id;
    $question1 = $question->question;
    $description = $question->description;
    $checklistsquestions_id = $question->id;
    $num_input = $question->num_input;
    $q_format= $question->q_format; ?>
    <tr>
        <td>
            <?= $display_number; ?>.
            <?= $question1; ?>.
            <input type="hidden" name="aid[]" id="aid[]" value='<?= $cla_id; ?>'>
        </td>
        <td>
            <?php
 if ($q_format=="radio") :
 echo Util::generateRadioButtons("question_".$cla_id ."_answer", $num_input, true, $value->respuesta);
    endif; ?>
        </td>
    </tr>
    <?php $display_number++;
} ?>
</table>

<div class="col-md-12">
    <p>
        * A) La coordinadora la toma directamente el SARE - El revisor la toma de SARE Y
        Certificado de
        Tradicion y Libertad y Confronta.</p>
    <p>* B) Siempre debe coincidir, caso contrario avise a la coordinación del proyecto.</p>
    <p>* C) los ITEM de esta lista marcados con la letra C) mayuscula corresponden exclusivamente
        diligenciarlos a la coordinadora.</p>
    <p>* D) RevIsor y coordinadora debe utilizar tinta de diferente color.</p>
</div>

<button onclick="javascript:window.print()" class="btn btn-success"><i class="material-icons">print</i>
    Imprimir</button>
<button onclick="javascript:window.close()" class="btn btn-danger"><i class="material-icons">close</i>
    Cerrar</button>
<style>
.sidebar,
.footer,
nav,
.navbar {
    display: none;
}

.main-panel {
    float: none;
    width: 100%;
    font-size: 12px !important;
}

body,
span,
label {
    background-color: #fff;
    color: #000 !important;
    font-size: 12px !important;
}

.main-panel>.content {
    margin-top: 0px;
    padding: 0px;
    min-height: 100%;
}
</style>