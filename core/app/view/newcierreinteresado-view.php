<?php
$allAcreedores =  CierresData::getAllAcreedores();
$text = "";
foreach ($allAcreedores as $key => $value) {
    $text .= "'".$value->destino."',";
}
?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Creacion de carta de cierre escritura interesados</h4>
        <p class="card-category">Se crean las cartas para el cierre de cada escritura</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="addcierres" action="./?action=addcierres" role="form">
                    <input type="hidden" id="acctions" name="acctions" value="newcierresinteresados" />
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="is_registro" class="bmd-label-floating">Es registro</label>
                                <input type="checkbox" name="is_registro" id="is_registro" class="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="is_sustituto" class="bmd-label-floating">Es sustitutivo</label>
                                <input type="checkbox" name="is_sustituto" id="is_sustituto" class="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="is_ejemplar" class="bmd-label-floating">Es ejemplar</label>
                                <input type="checkbox" name="is_ejemplar" id="is_ejemplar" class="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group is-filled">
                                <label for="nrocopia" class="bmd-label-floating">Copia de n&uacute;mero</label>
                                <select id="nrocopia" name="nrocopia" required class="custom-select">
                                    <option value="">-- SELECCIONE --</option>
                                    <option value="1">Primera</option>
                                    <option value="2">Segunda</option>
                                    <option value="3">Tercera</option>
                                    <option value="4">Cuarta</option>
                                    <option value="5">Quinta</option>
                                    <option value="6">Sexta</option>
                                    <option value="7">Séptima</option>
                                    <option value="8">Octava</option>
                                    <option value="9">Novena</option>
                                    <option value="10">Décima</option>
                                    <option value="11">Décima primera</option>
                                    <option value="12">Décima segunda</option>
                                    <option value="13">Décima tercera</option>
                                    <option value="14">Décima cuarta</option>
                                    <option value="15">Décima quinta</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nroescriturapublica" class="bmd-label-floating">N&uacute;mero de
                                    escritura</label>
                                <input type="number" class="form-control" id="nroescriturapublica"
                                    name="nroescriturapublica" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group is-filled has-success">
                                <label for="dateescritura" class="bmd-label-floating">
                                    Fecha</label>
                                <input type="text" name="dateescritura" id="dateescritura"
                                    class="form-control datepicker-here" data-timepicker="false"
                                    data-date-format="yyyy-mm-dd" placeholder="" value="">
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
                                <label for="observationcopy1" class="bmd-label-floating">Copia impresa en los
                                    folios</label>
                                <textarea class="form-control" id="observationcopy1" name="observationcopy1"
                                    cols="30"></textarea>
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
    var availableTags = [<?php echo $text;?>];
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