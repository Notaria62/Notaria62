<?php 

$conse = ConsecutivosDeRemisionesData::getById($_GET["id"]);

?>
<meta http-equiv="refresh" content="60;URL=?view=consecutivosderemisiones">

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar solicitud de consecutivo de remisiones</h4>
        <p class="card-category">Se edita numeros de consecutivos de remisiones</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="addcierres" action="./?action=updateconsecutivosderemisiones" role="form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="bmd-label-floating">N&uacute;mero de consecutivo</label>
                                <input type="number" class="form-control" id="consecutivo" name="consecutivo" required
                                    value="<?= $conse->consecutivo;?>" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nroescriturapublica" class="bmd-label-floating">N&uacute;mero de
                                    escritura</label>
                                <input type="number" class="form-control" id="nroescriturapublica"
                                    name="nroescriturapublica" required value="<?=$conse->nroescriturapublica;?>" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="radicado" class="bmd-label-floating">N&uacute;mero de escritura</label>
                                <input type="number" class="form-control" id="radicado" name="radicado" required
                                    value="<?=$conse->radicado;?>" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group bmd-form-group is-filled">
                                <label for="tipo" class="bmd-label-floating">Tipo de tramite</label>
                                <select id="tipo" name="tipo" class="custom-select" required>
                                    <option value="Escritura" <?= ($conse->tipo == "Escritura") ? "selected":"";?>>
                                        Escritura</option>
                                    <option value="Oficios" <?= ($conse->tipo == "Oficios") ? "selected":"";?>>Oficios
                                    </option>
                                </select>
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