<?php

/**
 * editbeneficencia_view short summary.
 *
 * editbeneficencia_view description.
 *
 * @version 1.0
 * @author sistemas
 */


$id= $_GET['id'];
$benefi = BeneficenciaData::getById($id);
$year = $benefi->anho;
?>


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar solicitud de matrices o beneficencias</h4>
        <p class="card-category">solictud con E.P. <small>
                <?= $benefi->nroescriturapublica?></small></p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
        </div>
        <form class="form-horizontal" method="post" id="updatebeneficencia" action="./?action=updatebeneficencia"
            role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nroescriturapublica" class="bmd-label-floating">N&uacute;mero de
                            escritura</label>
                        <input type="text" class="form-control" id="nroescriturapublica" name="nroescriturapublica"
                            value="<?= $benefi->nroescriturapublica;?>" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="tipo" class="bmd-label-floating">Tipo</label>
                        <select id="tipo" name="tipo" class="custom-select" required>
                            <option <?=($benefi->tipo == "Beneficencia y registro") ? "selected":"";?>
                                value="Beneficencia y registro">Beneficencia y registro</option>
                            <option <?=($benefi->tipo == "Beneficencia") ? "selected": "";?> value="Beneficencia">
                                Beneficencia</option>
                            <option <?=($benefi->tipo == "Matriz") ? "selected":"";?> value="Matriz">Matriz</option>
                            <option <?=($benefi->tipo == "Registro") ? "selected":"";?> value="Registro">Registro
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filled has-success">
                        <label for="anho" class="bmd-label-floating">
                            A&ntilde;o escritura</label>
                        <input type="number" name="anho" id="anho" min="1900" max="2300"
                            class="form-control datepicker-here" data-timepicker="false" data-min-view="years"
                            data-view="years" data-date-format="yyyy" placeholder="" value="<?= $benefi->anho;?>">
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                        <label for="comments" class="bmd-label-floating">Comentario</label>
                        <textarea name="comments" id="comments" class="form-control" rows="3"
                            cols="20"><?= $benefi->comments;?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden" name="id" id="id" value="<?= $_GET['id'];?>" />
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
$(document).ready(function() {});
</script>