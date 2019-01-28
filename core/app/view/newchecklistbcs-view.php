<?php
/**
 * newcontrolofprocess short summary.
 *
 * newcontrolofprocess description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */

$numeroescriturapublica = 0;
$checklists_id = 12;//12 productions - 10 Developer

$client_id = 0;
$questions = ChecklistsquestionData::getAllQuestionsOn("open", $checklists_id);
$display_number = 1;
?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Crear lista de chequeo BCS</h4>
        <p class="card-category">Crear lista de chequeo BCS</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
        </div>

        <form class="" method="post" id="addchecklistanswersbcs" action="./?action=addchecklistanswersbcs" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group bmd-form-group has-success">
                        <label for="datedelivery" class="bmd-label-floating">
                            C) Fecha de reparto</label>
                        <input type="text" name="datedelivery" id="datedelivery" class="form-control datepicker-here"
                            data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii" placeholder=""
                            value="<?=Util::getDatetimeNow();?>">
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group has-success">
                        <label for="dateradication" class="bmd-label-floating">
                            C) Fecha de radicaci&oacute;n</label>
                        <input type="text" name="dateradication" id="dateradication" class="form-control datepicker-here"
                            data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii" placeholder=""
                            value="<?=Util::getDatetimeNow();?>">
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group has-success">
                        <label for="datenotaryauthorization" class="bmd-label-floating">
                            Fecha de autorizaci&oacute;n escritura notario</label>
                        <input type="text" name="datenotaryauthorization" id="datenotaryauthorization" class="form-control datepicker-days"
                            data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii" placeholder=""
                            value="">
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Nro. E.P.</label>
                        <input type="number" class="form-control" id="numeroescriturapublica" name="numeroescriturapublica"
                            value="0" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Nro. radicado</label>
                        <input type="number" class="form-control" id="numradicado" name="numradicado" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="numanotacioncoordinador" class="bmd-label-floating">A) Nro. anotaci&oacute;n</label>
                        <input type="text" class="form-control numguiones" id="numanotacioncoordinador" name="numanotacioncoordinador"
                            value="0" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="numanotacionrevisor" class="bmd-label-floating">C) Nro. anotaci&oacute;n</label>
                        <input type="text" class="form-control numguiones" id="numanotacionrevisor" name="numanotacionrevisor"
                            value="0" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="observation" class="bmd-label-floating">Observaciones</label>
                        <textarea class="form-control" id="observation" name="observation" cols="30"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="">C) Total de d&iacute;as</label> : <strong style="font-size:20px;"><span id="numday_span"></span></strong>
                    <input type="hidden" class="form-control" id="numday" name="numday" />
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
                        <?php
                            foreach ($questions as $key => $value) :
                            $q_format= $value->q_format;
                            $question1 = $value->pregunta;
                            $description = $value->description;
                            $checklistsquestions_id = $value->clq_id;
                            $description = $value->description;
                            $linkpdf = $value->linkpdf;
                            $created_at = new DateTime($value->created_at);
                            $today = new DateTime(NumeroALetras::getDatetimeNow());
                            $diff =$created_at->diff($today);
                            $num_input = $value->num_input;
                            ?>
                        <tr data-background-color-approval="<?= ($diff->days <= 30) ? 'approval' : ''; ?>">
                            <td>
                                <?php echo $display_number; ?>.
                                <?php echo $question1; ?>.
                                <?php if (!empty($description) || (!empty($linkpdf))) :  ?>
                                <a href="" data-toggle="modal" data-target="#myModal-<?php echo $checklistsquestions_id; ?>"
                                    title="<?php echo $description; ?>"
                                    class="btn-simple btn btn-danger btn-xs">
                                    Ver m&aacute;s
                                    <i class="material-icons">visibility</i>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal-<?php echo $checklistsquestions_id; ?>"
                                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <input type="hidden" name="qid[]" id="qid[]" value='<?= $checklistsquestions_id; ?>'>
                            </td>
                            <td class="col-md-3">
                                <?php
                            if ($q_format=="radio") :
                               echo Util::generateRadioButtons("question_".$checklistsquestions_id ."_answer", $num_input, true);
                            endif;
                             
                            ?>
                            </td>
                        </tr>
                        <?php $display_number++;
                            endforeach; ?>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden" name="checklists_id" id="checklists_id" value="<?= $checklists_id ?>" />
                        <input type="hidden" name="client_id" id="client_id" value="<?= $client_id ?>" />
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
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
    <!--end div content-->

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