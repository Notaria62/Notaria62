<?php

/**
 * newconsecutivodecertificado short summary.
 *
 * newconsecutivodecertificado description.
 *
 * @version 1.0
 * @author sistemas
 */
$last = ConsecutivosDeCertificadosData::getByConsecutivoLast(date("Y"));
if (count($last)<=0) {
    $cons = 1;
} else {
    foreach ($last as $value) {
        $cons = $value->consecutivo;
        $cons++;
    }
}?>
<meta http-equiv="refresh" content="60;URL=?view=consecutivosdecertificados">

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Nueva solicitud de consecutivo de certificado</h4>
        <p class="card-category">Se reservan n&uacute;meros de cetificados</p>
    </div>
    <div class="card-body">
        <div class="card-title">

        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="addcierres" action="./?action=addconsecutivosdecertificados" role="form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="consecutivo" class="bmd-label-floating">N&uacute;mero de consecutivo</label>
                                <input type="number" class="form-control" id="consecutivo" name="consecutivo" number="true"
                                    required="true" value="<?=$cons?>"
                                    aria-required="true" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nroescriturapublica" class="bmd-label-floating">N&uacute;mero de escritura</label>
                                <input type="number" class="form-control" id="nroescriturapublica" name="nroescriturapublica"
                                    number="true" required="true" aria-required="true" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group has-success">
                                <label for="dateescritura" class="bmd-label-floating">
                                    Fecha escritura</label>
                                <input type="text" name="dateescritura" id="dateescritura" class="form-control datepicker-here"
                                    data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii"
                                    placeholder="" value="<?= Util::getDatetimeNow();?>"
                                    required>
                                <span class="form-control-feedback">
                                    <i class="material-icons">calendar_today</i>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {});
</script>