<?php
/**
 *  short summary.
 *
 *  description.
 *
 * @version 1.0
 * @author sistemas
 */
$vigen = VigenciasData::getById($_GET["id"]);
$notarios = NotariosData::getAll();

?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Creacion de carta de vigencias escritura</h4>
        <p class="card-category">Se crean las cartas para las vigencias de cada escritura</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="updatevigencias" action="./?action=updatevigencias" role="form">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="consecutivo" class="bmd-label-floating">N&uacute;mero de consecutivo</label>
                                <input type="number" class="form-control" id="consecutivo" name="consecutivo"
                                    number="true" required="true" value="<?=$vigen->consecutivo;?>"
                                    aria-required="true" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nroescriturapublica" class="bmd-label-floating">N&uacute;mero de
                                    escritura</label>
                                <input type="number" class="form-control" id="nroescriturapublica"
                                    name="nroescriturapublica" value="<?=$vigen->nroescriturapublica;?>" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group bmd-form-group is-filled has-success">
                                <label for="dateescritura" class="bmd-label-floating">
                                    Fecha escritura</label>
                                <input type="text" name="dateescritura" id="dateescritura"
                                    class="form-control datepicker-here" data-timepicker="false"
                                    data-date-format="yyyy-mm-dd" placeholder="" value="<?=$vigen->dateescritura;?>"
                                    required>
                                <span class="form-control-feedback">
                                    <i class="material-icons">calendar_today</i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group bmd-form-group is-filled">
                                <label for="otorgotipo" class="bmd-label-floating">Otorga</label>
                                <select id="otorgotipo" name="otorgotipo" required class="custom-select">
                                    <option <?=($vigen->otorgotipo == "Poder general") ? "selected":"";?>
                                        value="Poder general">Poder general</option>
                                    <option <?=($vigen->otorgotipo == "Poder especial") ? "selected":"";?>
                                        value="Poder especial">Poder especial</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="poderdantecc" class="bmd-label-floating">C.C. poderdante</label>
                                <input type="number" class="form-control" id="poderdantecc" name="poderdantecc"
                                    value="<?=$vigen->poderdantecc;?>" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="poderdantename" class="bmd-label-floating">Nombre poderdante</label>
                                <input type="text" class="form-control" id="poderdantename" name="poderdantename"
                                    value="<?=$vigen->poderdantename;?>" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="poderdanteccexpedida" class="bmd-label-floating">Expedida cc
                                    poderdante</label>
                                <input type="text" class="form-control" id="poderdanteccexpedida"
                                    name="poderdanteccexpedida" value="<?=$vigen->poderdanteccexpedida;?>"
                                    autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apoderadocc" class="bmd-label-floating">C.C. apoderado</label>
                                <input type="number" class="form-control" id="apoderadocc" name="apoderadocc"
                                    value="<?=$vigen->apoderadocc;?>" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apoderadoname" class="bmd-label-floating">Nombre apoderado</label>
                                <input type="text" class="form-control" id="apoderadoname" name="apoderadoname"
                                    value="<?=$vigen->apoderadoname;?>" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apoderadoccexpedida" class="bmd-label-floating">Expedida cc
                                    apoderado</label>
                                <input type="text" class="form-control" id="apoderadoccexpedida"
                                    name="apoderadoccexpedida" value="<?=$vigen->apoderadoccexpedida;?>"
                                    autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="solicitante" class="bmd-label-floating">Solicitante</label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante"
                                    value="<?=$vigen->solicitante;?>" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group is-filled">
                                <label for="notario_id" class="bmd-label-floating">Notario</label>
                                <select id="notario_id" name="notario_id" required class="custom-select">
                                    <?php foreach ($notarios as $d):?>
                                    <option value=<?=$d->id;?> <?=($vigen->notario_id == $d->id)? "selected" : ""; ?>>
                                        <?=$d->name." ".$d->lastname; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="observation" class="bmd-label-floating">Derechos notariales
                                </label>
                                <textarea class="form-control" id="observation" name="observation"
                                    cols="30"><?=$vigen->observation;?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?= $vigen->id;?>">
                            <div class="col-lg-offset-2 col-lg-10">
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
$(document).ready(function() {
    //var availableTags = [ < ? php echo $text; ? > ];
    //autocomplete(document.getElementById("destino"), availableTags);

    // $('#is_registro').on('click', function() {
    //     if ($(this).is(':checked')) {
    //         $('#destino').val('Registrador de instrumentos publicos correspondiente');
    //     } else {
    //         $('#destino').val('');

    //     }
    // });

    // $(':checkbox').on('click', function() {
    //     updateButton();
    // });
    // updateButton();
});

// function updateButton() {
//     if ($('#is_registro:checked').length != 0) {
//         $('#is_sustituto').prop('disabled', true).prop("checked", false);
//         $('#is_ejemplar').prop('disabled', true).prop("checked", false);
//     } else {
//         if ($('#is_sustituto:checked').length != 0) {
//             $('#is_registro').prop('disabled', true).prop("checked", false);
//             $('#is_ejemplar').prop('disabled', true).prop("checked", false);
//         } else {
//             if ($('#is_ejemplar:checked').length != 0) {
//                 $('#is_registro').prop('disabled', true).prop("checked", false);
//                 $('#is_sustituto').prop('disabled', true).prop("checked", false);
//             } else {
//                 $('#is_sustituto').prop('disabled', false);
//                 $('#is_ejemplar').prop('disabled', false);
//                 $('#is_registro').prop('disabled', false);

//             }
//         }
//     }
// }
</script>