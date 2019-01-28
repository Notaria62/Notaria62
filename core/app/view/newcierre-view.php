<?php
$allAcreedores =  CierresData::getAllAcreedores();
$text = "";
foreach ($allAcreedores as $key => $value) {
    $text .= "'".$value->destino."',";
}
?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Creacion de carta de cierre escritura</h4>
        <p class="card-category">Se crean las cartas para el cierre de cada escritura</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="addcierres" action="./?action=addcierres" role="form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nroescriturapublica" class="bmd-label-floating">N&uacute;mero de escritura</label>
                                <input type="number" class="form-control" id="nroescriturapublica" name="nroescriturapublica"
                                    required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group is-filled has-success">
                                <label for="dateescritura" class="bmd-label-floating">
                                    Fecha</label>
                                <input type="text" name="dateescritura" id="dateescritura" class="form-control datepicker-here"
                                    data-timepicker="false" data-date-format="yyyy-mm-dd" placeholder="" value="">
                                <span class="form-control-feedback">
                                    <i class="material-icons">calendar_today</i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numfolios" class="bmd-label-floating">N&uacute;mero de folios</label>
                                <input type="number" class="form-control" id="numfolios" name="numfolios" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="destino" class="bmd-label-floating">Destino</label>
                                <input type="text" class="form-control" id="destino" name="destino" autocomplete="off"
                                    required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group is-filled">
                                <label for="notario_id" class="bmd-label-floating">Notario</label>
                                <select id="notario_id" name="notario_id" required class="custom-select">
                                    <?php foreach (NotariosData::getAll() as $d) : ?>
                                    <option value="<?php echo $d->id; ?>">
                                        <?= $d->name." ".$d->lastname; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="observationcopy1" class="bmd-label-floating">Primera copia folios</label>
                                <textarea class="form-control" id="observationcopy1" name="observationcopy1" cols="30"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="observationcopy2" class="bmd-label-floating">Segunda copia folios</label>
                                <textarea class="form-control" id="observationcopy2" name="observationcopy2" cols="30"></textarea>
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
    $(document).ready(function() {
        var availableTags = [ <?php echo $text;?> ];
        autocomplete(document.getElementById("destino"), availableTags);
    });
</script>