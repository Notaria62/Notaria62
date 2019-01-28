<?php

/**
 * printcontrlmaestro short summary.
 *
 * printcontrlmaestro description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */


//$idcp = $_GET['idcp'];
$checklists_id= $_GET['checklist'];
$clq= ChecklistsquestionData::getAllNumRowQuestionToList($checklists_id);
$cl= ChecklistsData::getById($checklists_id);
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
        <td colspan="2">Control maestro: <strong><?php echo $cl->name . ": ".$cl->description; ?></strong>
            Fecha de creaci&oacute;n: <strong><?php echo $cl->created_at; ?></strong></td>
    </tr>
</table>
<table class="material-datatables table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th>Pregunta</th>
            <th>Creada</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <?php foreach ($clq as $key => $value) {
    $id=$value->id;
    $question = $value->question;
    $description = $value->description; ?>
    <tr>
        <td>
            <?= $display_number; ?>. <?= $question; ?>.
            <input type="hidden" name="aid[]" id="aid[]" value='<?= $id; ?>'>
        </td>
        <td>
            <?php echo $value->created_at; ?>
        </td>
        <td>
            <?php echo $value->q_status; ?>
        </td>
    </tr>
    <?php $display_number++;
} ?>
</table>
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