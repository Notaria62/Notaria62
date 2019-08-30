<?php

/**
 * newconsecutivodecertificado short summary.
 *
 * newconsecutivodecertificado description.
 *
 * @version 1.0
 * @author sistemas
 */
$last = ConsecutivosDeRemisionesData::getByConsecutivoLast(date("Y"));
if (count($last)<=0) {
    $cons = 1;
} else {
    foreach ($last as $value) {
        $cons = $value->consecutivo;
        $cons++;
    }
}?>
<meta http-equiv="refresh" content="60;URL=?view=consecutivosderemisiones">

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Nueva solicitud de consecutivo de remisiones</h4>
        <p class="card-category">Se reservan n&uacute;meros de remisiones</p>
    </div>
    <div class="card-body">
        <div class="card-title">

        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="addcierres" action="./?action=addconsecutivosderemisiones" role="form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="consecutivo" class="bmd-label-floating">N&uacute;mero de consecutivo</label>
                                <input type="number" class="form-control" id="consecutivo" name="consecutivo"
                                    number="true" required="true" value="<?=$cons?>" aria-required="true" readonly />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nroescriturapublica" class="bmd-label-floating">N&uacute;mero de
                                    escritura</label>
                                <input type="number" class="form-control" id="nroescriturapublica"
                                    name="nroescriturapublica" required="true" aria-required="true" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="radicado" class="bmd-label-floating">N&uacute;mero de radicado</label>
                                <input type="number" class="form-control" id="radicado" name="radicado" number="true"
                                    required="true" value="" aria-required="true" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group bmd-form-group is-filled">
                                <label for="tipo" class="bmd-label-floating">Tipo de tramite</label>
                                <select id="tipo" name="tipo" class="custom-select" required>
                                    <option value="Escritura">Escritura</option>
                                    <option value="Oficios">Oficios</option>
                                </select>
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