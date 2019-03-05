<?php


$cierr = CierresData::getById($_GET["id"]);
$notarios = NotariosData::getAll();

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

        <form method="post" id="addcierres" action="./?action=updatecierres" role="form">
            <div class="row">
                <?php if ($cierr->nrocopia != 0) : ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="is_registro" class="bmd-label-floating">Es registro</label>
                        <input type="checkbox" name="is_registro" id="is_registro"
                            <?= ($cierr->is_registro)? "checked":"";?> class="">

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="is_sustituto" class="bmd-label-floating">Es sustitutiva</label>
                        <input type="checkbox" name="is_" id="is_sustituto"
                            <?= ($cierr->is_sustituto) ? "checked" : ""; ?> class="">

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="is_ejemplar" class="bmd-label-floating">Es ejemplar</label>
                        <input type="checkbox" name="is_ejemplar" id="is_ejemplar"
                            <?= ($cierr->is_ejemplar) ? "checked" : ""; ?> class="">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="nrocopia" class="bmd-label-floating">Copia de n&uacute;mero</label>
                        <select id="nrocopia" name="nrocopia" required class="custom-select">
                            <option <?= ($cierr->nrocopia == 0) ? "selected":"";?> value="">-- SELECCIONE --</option>
                            <option <?= ($cierr->nrocopia == 1) ? "selected":"";?> value="1">Primera</option>
                            <option <?= ($cierr->nrocopia == 2) ? "selected":"";?> value="2">Segunda</option>
                            <option <?= ($cierr->nrocopia == 3) ? "selected":"";?> value="3">Tercera</option>
                            <option <?= ($cierr->nrocopia == 4) ? "selected":"";?> value="4">Cuarta</option>
                            <option <?= ($cierr->nrocopia == 5) ? "selected":"";?> value="5">Quinta</option>
                            <option <?= ($cierr->nrocopia == 6) ? "selected":"";?> value="6">Sexta</option>
                            <option <?= ($cierr->nrocopia == 7) ? "selected":"";?> value="7">Séptima</option>
                            <option <?= ($cierr->nrocopia == 8) ? "selected":"";?> value="8">Octava</option>
                            <option <?= ($cierr->nrocopia == 9) ? "selected":"";?> value="9">Novena</option>
                            <option <?= ($cierr->nrocopia == 10) ? "selected":"";?> value="10">Décima</option>
                            <option <?= ($cierr->nrocopia == 11) ? "selected":"";?> value="11">Décima primera</option>
                            <option <?= ($cierr->nrocopia == 12) ? "selected":"";?> value="12">Décima segunda</option>
                            <option <?= ($cierr->nrocopia == 13) ? "selected":"";?> value="13">Décima tercera</option>
                            <option <?= ($cierr->nrocopia == 14) ? "selected":"";?> value="14">Décima cuarta</option>
                            <option <?= ($cierr->nrocopia == 15) ? "selected":"";?> value="15">Décima quinta</option>
                        </select>
                    </div>
                </div>
                <?php endif;?>



                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">N&uacute;mero de escritura</label>
                        <input type="text" class="form-control" id="nroescriturapublica" name="nroescriturapublica"
                            required value="<?=$cierr->nroescriturapublica;?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filled has-success">
                        <label for="dateescritura" class="bmd-label-floating">
                            Fecha</label>
                        <input type="text" name="dateescritura" id="dateescritura" class="form-control datepicker-here"
                            data-timepicker="false" data-date-format="yyyy-mm-dd" placeholder=""
                            value="<?=$cierr->dateescritura;?>" required>
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">N&uacute;mero de folios</label>
                        <input type="text" class="form-control" id="numfolios" name="numfolios" required
                            value="<?php echo $cierr->numfolios;?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Destino</label>
                        <input type="text" class="form-control" id="destino" name="destino" required
                            value='<?=$cierr->destino;?>' />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="notario_id" class="bmd-label-floating">Notario</label>
                        <select id="notario_id" name="notario_id" required class="custom-select">
                            <?php foreach ($notarios as $d):?>
                            <option value="<?=$d->id;?>" <?=($cierr->notario_id == $d->id)? "selected" : ""; ?>>
                                <?=$d->name." ".$d->lastname; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="observationcopy1"
                            class="bmd-label-floating"><?= CifrasEnLetras::$listaUnidadesOrdinalesFemenino[$cierr->nrocopia];  ?></label>
                        <textarea class="form-control" id="observationcopy1" name="observationcopy1"
                            cols="30"><?=$cierr->observationcopy1;?></textarea>
                    </div>
                </div>
                <?php if ($cierr->nrocopia == 0) : ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="observationcopy2" class="bmd-label-floating">Segunda copia folios</label>
                        <textarea class="form-control" id="observationcopy2" name="observationcopy2"
                            cols="30"><?=$cierr->observationcopy2;?></textarea>
                    </div>
                </div>
                <?php endif;?>
                <div class="col-md-12">
                    <input type="hidden" name="id" value="<?= $cierr->id;?>">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    var availableTags = [<?php echo $text; ?>];
    autocomplete(document.getElementById("destino"), availableTags);

    $('#is_registro').on('click', function() {
        if ($(this).is(':checked')) {
            $('#destino').val('Registrador de instrumentos publicos correspondiente');
        } else {
            $('#destino').val('');

        }
    });

    $(':checkbox').on('click', function() {
        updateButton();
    });
    updateButton();
});

function updateButton() {
    if ($('#is_registro:checked').length != 0) {
        $('#is_sustituto').prop('disabled', true).prop("checked", false);
        $('#is_ejemplar').prop('disabled', true).prop("checked", false);
    } else {
        if ($('#is_sustituto:checked').length != 0) {
            $('#is_registro').prop('disabled', true).prop("checked", false);
            $('#is_ejemplar').prop('disabled', true).prop("checked", false);
        } else {
            if ($('#is_ejemplar:checked').length != 0) {
                $('#is_registro').prop('disabled', true).prop("checked", false);
                $('#is_sustituto').prop('disabled', true).prop("checked", false);
            } else {
                $('#is_sustituto').prop('disabled', false);
                $('#is_ejemplar').prop('disabled', false);
                $('#is_registro').prop('disabled', false);

            }
        }
    }
}
</script>