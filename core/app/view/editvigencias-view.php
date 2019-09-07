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
        $poderdante_ids = $vigen->poderdante_ids;
        $p_ids = explode("-", $poderdante_ids);
        $apoderado_ids = $vigen->apoderado_ids;
        $ap_ids = explode("-", $apoderado_ids);
       // $fullnamep="";
        // foreach ($p_ids as $key => $v) {
        //     # code...
        //     $cs = ClientesignoData::getById($v);
        //     $fullnamep .= $cs->name. " ".$cs->lastname."; ";
        // }
        $fullnameap="";
        foreach ($ap_ids as $key => $j) {
            # code...
            $cs = ClientesignoData::getById($j);
            $fullnameap .= $cs->name. " ".$cs->lastname."; ";
        }

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
                    </div>
                    <hr>
                    <div id="poderdante" class="">
                        <div class="col-md-12">
                            <a href="#" onclick="addPoderdante();" class="btn btn-success">Agregar poderdante</a>
                        </div>
                    </div>
                    <hr />
                    <div id="apoderado" class="">
                        <div class="col-md-12">
                            <a href="#" onclick="addApoderado();" class="btn btn-success">Agregar apoderado</a>
                        </div>
                    </div>
                    <hr />

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="solicitante" class="bmd-label-floating">Solicitante</label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante"
                                    value="<?=$vigen->solicitante;?>" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-1" id="resolucionnotario_div">
                            <div class="form-group label-floating">
                                <label for="resolucionnotario" class="bmd-label-floating">Resolución notario</label>
                                <input type="number" class="form-control" id="resolucionnotario"
                                    name="resolucionnotario" value="<?=$vigen->resolucionnotario;?>" />
                            </div>
                        </div>
                        <div class="col-md-2" id="dateresolucionnotario_div">

                            <div class="form-group bmd-form-group is-filled has-success">
                                <label for="dateresolucionnotario" class="bmd-label-floating">
                                    Fecha resolución</label>
                                <input type="text" name="dateresolucionnotario" id="dateresolucionnotario"
                                    class="form-control datepicker-here" data-timepicker="false"
                                    data-date-format="yyyy-mm-dd" placeholder=""
                                    value="<?=$vigen->dateresolucionnotario;?>" required>
                                <span class="form-control-feedback">
                                    <i class="material-icons">calendar_today</i>
                                </span>
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
    $("#notario_id").change(function() {
        var flag = 0;
        $("#notario_id option:selected").each(function() {
            flag = $(this).val();
        });
        switch (flag) {
            case "1":
                $('#resolucionnotario_div').hide();
                $('#dateresolucionnotario_div').hide();
                break;
            case "2":
                $('#resolucionnotario_div').show();
                $('#dateresolucionnotario_div').show();
                break;
            case "3":
                $('#resolucionnotario_div').show();
                $('#dateresolucionnotario_div').show();
                break;
        }
    }).trigger("change");
    $("#poderdante").on('click', '.btn-retirar-poderdante', function() {
        var strbtnpoderdante = $(this).attr("id");
        var res = strbtnpoderdante.substring(strbtnpoderdante.length - 1, strbtnpoderdante.length);
        $(this).closest('#addpoderdante_' + res).remove();
    });

    $("#apoderado").on('click', '.btn-retirar-apoderado', function() {
        var strbtnapoderado = $(this).attr("id");
        var res = strbtnapoderado.substring(strbtnapoderado.length - 1, strbtnapoderado.length);
        $(this).closest('#addapoderado_' + res).remove();
    });
});

function FormSetFieldValue(fieldName, fieldValue) {
    document.getElementById(fieldName).value = fieldValue;
}
var nextinputp = 0;

function addPoderdante() {
    nextinputp++;
    htmladdpoderdante =
        '<div id="addpoderdante_' + nextinputp +
        '" class="row"><div class="col-md-2"><div class="form-group bmd-form-group is-filled"><label for="poderdantetypeidentification[]" class="bmd-label-floating">Tipo identificacion</label>' +
        '<select id="poderdantetypeidentification_' +
        nextinputp + '" name="poderdantetypeidentification[]" class="custom-select" required>' +
        //'<option value="0">-- SELECCIONE --</option>' +
        '<option value="C.C."> C.C.</option >' +
        '<option value="NIT."> NIT.</option >' +
        '<option value="C.E."> C.E.</option >' +
        '<option value="P.P."> Pasaporte</option>' +
        '</select></div></div><div class="col-md-2"><div class="form-group"><label for="poderdanteidentification[]" class="bmd-label-floating">Indentificacion poderdante</label>' +
        '<input type="number" class="form-control" name="poderdanteidentification[]" id="poderdanteidentification_' +
        nextinputp + '" value="" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="poderdanteidentificationexpedida[]" class="bmd-label-floating">Expedida ident. poderdante</label>' +
        '<input type="text" class="form-control" id="poderdanteidentificationexpedida_' +
        nextinputp + '" name="poderdanteidentificationexpedida[]" value="" autocomplete="off" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="poderdantename[]" class="bmd-label-floating">Nombre poderdante</label>' +
        '<input type="text" class="form-control" id="poderdantename_' +
        nextinputp + '" name="poderdantename[]" autocomplete="off" value="" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="poderdantelastname[]" class="bmd-label-floating">Apellido poderdante</label>' +
        '<input type="text" class="form-control" id="poderdantelastname_' +
        nextinputp + '" name="poderdantelastname[]" value="" autocomplete="off" required />' +
        '</div></div><div class="col-md-2"><button class="btn-danger btn btn-block btn-retirar-poderdante" id="btn-retirar-poderdante_' +
        nextinputp +
        '" type="button">Retirar</button></div></div>';
    $("#poderdante").prepend(htmladdpoderdante);
}
var nextinputap = 0;

function addApoderado() {
    nextinputap++;
    htmladdapoderado =
        '<div id="addapoderado_' + nextinputap +
        '" class="row"><div class="col-md-2"><div class="form-group bmd-form-group is-filled"><label for="apoderadotypeidentification[]" class="bmd-label-floating">Tipo identificacion</label>' +
        '<select id="apoderadotypeidentification_' + nextinputap +
        '" name="apoderadotypeidentification[]" class="custom-select" required>' +
        //'<option value="0">-- SELECCIONE --</option>' +
        '<option value="C.C."> C.C.</option >' +
        '<option value="NIT."> NIT.</option >' +
        '<option value="C.E."> C.E.</option >' +
        '<option value="P.P."> Pasaporte</option>' +
        '</select></div></div><div class="col-md-2"><div class="form-group"><label for="apoderadoidentification[]" class="bmd-label-floating">Indentificacion apoderado</label>' +
        '<input type="number" class="form-control" name="apoderadoidentification[]" id="apoderadoidentification_' +
        nextinputap +
        '" value="" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="apoderadoidentificationexpedida[]" class="bmd-label-floating">Expedida ident. apoderado</label>' +
        '<input type="text" class="form-control" id="apoderadoidentificationexpedida_' + nextinputap +
        '" name="apoderadoidentificationexpedida[]" value="" autocomplete="off" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="apoderadoname[]" class="bmd-label-floating">Nombre apoderado</label>' +
        '<input type="text" class="form-control" id="apoderadoname_' + nextinputap +
        '" name="apoderadoname[]" autocomplete="off" value="" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="apoderadolastname[]" class="bmd-label-floating">Apellido apoderado</label>' +
        '<input type="text" class="form-control" id="apoderadolastname_' + nextinputap +
        '" name="apoderadolastname[]" value="" autocomplete="off" required />' +
        '</div></div><div class="col-md-2"><button class="btn-danger btn btn-block btn-retirar-apoderado" id="btn-retirar-apoderado_' +
        nextinputap +
        '" type="button">Retirar</button></div></div>';
    $("#apoderado").prepend(htmladdapoderado);
}
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
<?php

 foreach ($p_ids as $key => $v) {
     # code...
     $key++;
     $cs = ClientesignoData::getById($v);
     // $fullnamep .= $cs->name. " ".$cs->lastname."; ";
     
     echo "<script>";
     // echo "alert($key);";
     echo "addPoderdante();";
     //echo "alert('$cs->typeidentification');";
     echo "$('#poderdantetypeidentification_$key').val('$cs->typeidentification');";

     echo "FormSetFieldValue('poderdanteidentification_$key','".$cs->identification."');";
     echo "FormSetFieldValue('poderdanteidentificationexpedida_$key','".$cs->identificationexpedida."');";
     echo "FormSetFieldValue('poderdantename_$key','".$cs->name."');";
     echo "FormSetFieldValue('poderdantelastname_$key','".$cs->lastname."');";
     echo "</script>";
 }

  foreach ($ap_ids as $key => $v) {
      # code...
      $key++;
      $cs = ClientesignoData::getById($v);
      // $fullnamep .= $cs->name. " ".$cs->lastname."; ";
     
      echo "<script>";
      echo "addApoderado();";
      echo "FormSetFieldValue('apoderadoidentification_$key','".$cs->identification."');";
      echo "FormSetFieldValue('apoderadoidentificationexpedida_$key','".$cs->identificationexpedida."');";
      echo "FormSetFieldValue('apoderadoname_$key','".$cs->name."');";
      echo "FormSetFieldValue('apoderadolastname_$key','".$cs->lastname."');";
      echo "</script>";
  }

// if ($b->typeident1 != "0") {
//     echo "<script>";
//     echo "adddebtor();";
//     echo "FormSetFieldValue('typeident1','".$b->typeident1."');";
//     echo "FormSetFieldValue('identificacion1','".$b->identificacion1."');";
//     echo "FormSetFieldValue('fullname1','".$b->fullname1."');";
//     echo "</script>";
// }