<?php

/**
 * newcontrolofprocess short summary.
 *
 * newcontrolofprocess description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */


$user = Util::current_user();
$idcl = $_GET['idcl'];
$checklists_id= $_GET['checklists_id'];
$caux= ChecklistsanswerBCSData::getById($idcl);
$numeroescriturapublica = $caux->numeroescriturapublica;
$numradicado = $caux->numradicado;
$numanotacioncoordinador = $caux->numanotacioncoordinador;
$numanotacionrevisor = $caux->numanotacionrevisor;
$datedelivery = $caux->datedelivery;
$dateradication = $caux->dateradication;
$datenotaryauthorization = $caux->datenotaryauthorization;
$observation = $caux->observation;
$numday = $caux->numday;
$codeApproval = $caux->code_approval;
$list = ChecklistsData::getById($checklists_id);
$answers = ChecklistsanswerBCSData::getAllAnswersOn($numeroescriturapublica, $numradicado, $checklists_id);
$display_number = 1;
?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar lista de chequeo BCS</h4>
        <p class="card-category">Editar lista de chequeo BCS</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                Editando lista de chequeo de la la escritura publica:
                <strong>
                    <?= $numeroescriturapublica;?>
                </strong> del radicado:
                <strong>
                    <?=$numradicado;?>
                </strong> , Nombre de lista de chequeo:
                <strong>
                    <?php echo $list->name.": ".$list->description;?>
                </strong>, aprobada con el n&uacute;mero: <strong>
                    <?= $codeApproval;?>
                </strong>
            </div>
        </div>
        <hr />
        <form class="" method="post" id="updatechecklistbcs" action="./?action=updatechecklistbcs" role="form">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group bmd-form-group has-success">
                        <label for="datedelivery" class="bmd-label-floating">
                            C) Fecha de reparto</label>
                        <input type="text" name="datedelivery" id="datedelivery" class="form-control datepicker-here"
                            data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii" placeholder=""
                            value="<?=$dateradication?>">
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group has-success">
                        <label for="dateradication" class="bmd-label-floating">
                            C) Fecha de radicaci&oacute;n</label>
                        <input type="text" name="dateradication" id="dateradication"
                            class="form-control datepicker-here" data-timepicker="true" data-date-format="yyyy-mm-dd"
                            data-time-format="hh:ii" placeholder="" value="<?=$dateradication?>">
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group has-success">
                        <label for="datenotaryauthorization" class="bmd-label-floating">
                            Fecha de autorizaci&oacute;n escritura notario</label>
                        <input type="text" name="datenotaryauthorization" id="datenotaryauthorization"
                            class="form-control datepicker-days" data-timepicker="true" data-date-format="yyyy-mm-dd"
                            data-time-format="hh:ii" placeholder="" value="<?=$datenotaryauthorization?>">
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="numeroescriturapublica" class="bmd-label-floating">Nro. E.P.</label>
                        <input type="text" class="form-control" id="numeroescriturapublica"
                            name="numeroescriturapublica" value="<?=$numeroescriturapublica?>" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="numradicado" class="bmd-label-floating">Nro. radicado</label>
                        <input type="number" class="form-control" id="numradicado" name="numradicado"
                            value="<?=$numradicado?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="numanotacioncoordinador" class="bmd-label-floating">A) Nro. anotaci&oacute;n</label>
                        <input type="text" class="form-control numguiones" id="numanotacioncoordinador"
                            name="numanotacioncoordinador" value="<?=$numanotacioncoordinador?>"
                            <?=($user->user_level== 1 || $user->user_level==4 ||
                        $user->user_level==7)?"":"readonly"; ?> />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="numanotacionrevisor" class="bmd-label-floating">C) Nro. anotaci&oacute;n</label>
                        <input type="text" class="form-control numguiones" id="numanotacionrevisor"
                            name="numanotacionrevisor" value="<?=$numanotacionrevisor?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="observation" class="bmd-label-floating">Observaciones</label>
                        <textarea class="form-control" id="observation" name="observation"
                            cols="30"><?=$observation?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="">C) Total de d&iacute;as</label> : <strong style="font-size:20px;"><span
                            id="numday_span">
                            <?=$numday?>
                        </span></strong> <input type="hidden" class="form-control" id="numday" name="numday"
                        value="<?=$numday?>" />
                </div>
                <hr />
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Pregunta</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <?php foreach ($answers as $key => $value) :
                            $question = ChecklistsquestionData::getById($value->clq_id);
                            $q_format= $question->q_format;
                            $cla_id=$value->cla_id;
                            $question1 = $question->question;
                            $description = $question->description;
                            $description = $question->description;
                            $description = $question->description;
                            $linkpdf = $question->linkpdf;
                            $created_at = new DateTime($value->created_at);
                            $today = new DateTime(NumeroALetras::getDatetimeNow());
                            $diff =$created_at->diff($today);
                            $num_input = $question->num_input;?>
                        <tr data-background-color-approval="<?= ($diff->days <= 30) ? 'approval' : ''; ?>">
                            <td>
                                <?= $display_number; ?>.
                                <?= $question1; ?>.
                                <?php if (!empty($description) || (!empty($linkpdf))) :  ?>
                                <a href="" data-toggle="modal" data-target="#myModal-<?= $cla_id; ?>"
                                    title="<?php echo $description; ?>" class="btn-simple btn btn-danger btn-xs">
                                    Ver m&aacute;s
                                    <i class="material-icons">visibility</i>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal-<?= $cla_id; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Acotaci&oacute;n</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo $description; ?>
                                                <?php if (!empty($linkpdf)): ?>
                                                <object width="100%" height="350px" data="<?= $linkpdf; ?>#zoom=85"
                                                    type="application/pdf" trusted="yes" application="yes"></object>
                                                <?php endif?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <input type="hidden" name="aid[]" id="aid[]" value='<?= $cla_id; ?>'>
                            </td>
                            <td class="col-md-3">
                                <?php
                            if ($q_format=="radio") :
                               echo Util::generateRadioButtons("question_".$cla_id ."_answer", $num_input, true, $value->respuesta);
                            endif;
                            ?>
                            </td>
                        </tr>
                        <?php $display_number++; endforeach; ?>
                    </table>
                </div>

                <div class="col-lg-offset-2 col-lg-10">
                    <input type="hidden" name="checklists_id" id="checklists_id" value="<?= $checklists_id ?>" />
                    <input type="hidden" name="code_approval" id="code_approval" value="<?= $codeApproval ?>" />
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>

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
            </div>
        </form>

    </div>
</div>




<script type="text/javascript">
$(document).ready(function() {
    $('.datepicker-days').datepicker({
        onSelect: function(formattedDate, date, inst) {
            var firstDate = $("#datedelivery").val();
            var secondDate = $(inst.el).val();
            var numDay = showDays(firstDate, secondDate);
            $("#numday").val(numDay);
            $("#numday_span").html(numDay);
            $(inst.el).trigger('change');
        }
    });
    md.initNumGuiones();

});
</script>