<?php 

$conse = ConsecutivosDeCertificadosData::getById($_GET["id"]);

?>
<meta http-equiv="refresh" content="60;URL=?view=consecutivosdecertificados">

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar solicitud de consecutivo de certificado</h4>
        <p class="card-category">Se edita numeros de cetificados</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="addcierres" action="./?action=updateconsecutivosdecertificados" role="form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="bmd-label-floating">N&uacute;mero de consecutivo</label>
                                <input type="number" class="form-control" id="consecutivo" name="consecutivo" required
                                    value="<?=$conse->consecutivo;?>" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="bmd-label-floating">N&uacute;mero de escritura</label>
                                <input type="number" class="form-control" id="nroescriturapublica"
                                    name="nroescriturapublica" required value="<?=$conse->nroescriturapublica;?>" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group is-filled has-success">
                                <label for="dateescritura" class="bmd-label-floating">
                                    Fecha escritura</label>
                                <input type="text" name="dateescritura" id="dateescritura"
                                    class="form-control datepicker-here" data-timepicker="true"
                                    data-date-format="yyyy-mm-dd" data-time-format="hh:ii" placeholder=""
                                    value="<?=$conse->dateescritura;?>">
                                <span class="form-control-feedback">
                                    <i class="material-icons">calendar_today</i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-offset-2 col-lg-10">
                                <input type="hidden" id="id" name="id" value="<?=$_GET['id'];?>" />
                                <button type="submit" class="btn btn-primary">Actualizar</button>
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