<?php
// $allAcreedores =  VigenciasData::getAllAcreedores();
// $text = "";
// foreach ($allAcreedores as $key => $value) {
//     $text .= "'".$value->destino."',";
// }

/**
 *  short summary.
 *
 *  description.
 *
 * @version 1.0
 * @author sistemas
 */
$last = VigenciasData::getByConsecutivoLast(date("Y"));
if (empty($last)) {
    $cons = date("Y").Util::zero_fill(1, 4);
} else {
    foreach ($last as $value) {
        $cons = $value->consecutivo;
        $cons++;
    }
    //$cons = $cons;
}
?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Creacion de carta de vigencias escritura</h4>
        <p class="card-category">Se crean las cartas para las vigencias de cada escritura</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        </div>

        <form method="post" id="addvigencias" action="./?action=addvigencias" role="form">

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="consecutivo" class="bmd-label-floating">N&uacute;mero de consecutivo</label>
                        <input type="number" class="form-control" id="consecutivo" name="consecutivo" number="true"
                            required="true" value="<?=$cons?>" aria-required="true" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nroescriturapublica" class="bmd-label-floating">N&uacute;mero de
                            escritura</label>
                        <input type="number" class="form-control" id="nroescriturapublica" name="nroescriturapublica"
                            required value="" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group bmd-form-group is-filled has-success">
                        <label for="dateescritura" class="bmd-label-floating">
                            Fecha escritura</label>
                        <input type="text" name="dateescritura" id="dateescritura" class="form-control datepicker-here"
                            data-timepicker="false" data-date-format="yyyy-mm-dd" placeholder="" value="" required>
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="otorgotipo" class="bmd-label-floating">Otorga</label>
                        <select id="otorgotipo" name="otorgotipo" required class="custom-select">
                            <option value="Poder general">Poder general</option>
                            <option value="Poder especial">Poder especial</option>
                            <option value="Salida del pais">Salida del pa&iacute;s</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12" id="otorgoobservation_div">
                    <div class="form-group">
                        <label for="otorgoobservation" class="bmd-label-floating">Descripci&oacute;n otorga
                        </label>
                        <textarea class="form-control" id="otorgoobservation" name="otorgoobservation"
                            cols="30">AUTORIZACION SALIDA DEL PAIS DEL MENOR DE EDAD, XXXX, registrado en XXXX bajo el indicativo serial número XXXX. Autoriza de carácter indefinido o hasta que cumpla la mayoría de edad, o sea hasta los dieciocho (18) años que, en consecuencia, el (la, los) mencionado(s) menor(es) saldrá(n) del país cuantas veces lo requiera, solo(s) y/o en compañía de su señor padre, XXXX</textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div id="poderdante" class="">
                <div class="col-md-12">
                    <a href="#" onclick="addPoderdante();" class="btn btn-success">Agregar poderdante</a>
                </div>
            </div>

            <div id="apoderado" class="">
                <hr />
                <div class="col-md-12">
                    <a href="#" onclick="addApoderado();" class="btn btn-success">Agregar apoderado</a>
                </div>
            </div>
            <hr />

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="solicitante" class="bmd-label-floating">Solicitante</label>
                        <input type="text" class="form-control" id="solicitante" name="solicitante" autocomplete="off"
                            required value="" />
                    </div>
                </div>
                <div class="col-md-2">
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
                <div class="col-md-1" id="resolucionnotario_div">
                    <div class="form-group label-floating">
                        <label for="resolucionnotario" class="bmd-label-floating">Resolución notario</label>
                        <input type="number" class="form-control" id="resolucionnotario" name="resolucionnotario"
                            value="0" />
                    </div>
                </div>
                <div class="col-md-2" id="dateresolucionnotario_div">
                    <div class="form-group bmd-form-group is-filled has-success">
                        <label for="dateresolucionnotario" class="bmd-label-floating">
                            Fecha resolución</label>
                        <input type="text" name="dateresolucionnotario" id="dateresolucionnotario"
                            class="form-control datepicker-here" data-timepicker="false" data-date-format="yyyy-mm-dd"
                            placeholder="" value="<?=(new \DateTime())->format('Y-m-d');?>" required>
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
                            cols="30">DERECHOS NOTARIALES 2.800 + IVA 532 = 3.332 Resolución 0691 del 24 de Enero del 2019 ART. 4 Literal A.</textarea>
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






    // var formulario_poderdante = $("#addpoderdante").html();
    // // El encargado de agregar más formularios
    // $("#btn-poderdante-agregar").click(function() {
    //     // Agregamos el formulario
    //     $("#poderdante").prepend(formulario_poderdante);

    //     // Agregamos un boton para retirar el formulario
    //     $("#poderdante .col-md-3:first .well").append(
    //         '<button class="btn-danger btn btn-block btn-retirar-poderdante" type="button">Retirar</button>'
    //     );

    //     // Hacemos focus en el primer input del formulario
    //     $("#poderdante .col-md-3:first .well input:first").focus();

    //     // Volvemos a cargar todo los plugins que teníamos, dentro de esta función esta el del datepicker assets/js/ini.js
    //     //Plugins();
    // });
    $("#otorgotipo").change(function() {
        var flag = "";
        $("#otorgotipo option:selected").each(function() {
            flag = $(this).val();
        });
        switch (flag) {
            case "Salida del pais":
                $('#otorgoobservation_div').show();
                $('#apoderado').hide();

                break;
            case "Poder general":
                $('#otorgoobservation_div').hide();
                $('#apoderado').show();
                break;
            case "Poder especial":
                $('#otorgoobservation_div').hide();
                $('#apoderado').show();
                break;
        }
    }).trigger("change");

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
    // Cuando hacemos click en el boton de retirar
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
    // var formulario_apoderado = $("#addapoderado").html();
    // // El encargado de agregar más formularios
    // $("#btn-apoderado-agregar").click(function() {
    //     // Agregamos el formulario
    //     $("#apoderado").prepend(formulario_poderdante);

    //     // Agregamos un boton para retirar el formulario
    //     $("#apoderado .col-md-3:first .well").append(
    //         '<button class="btn-danger btn btn-block btn-retirar-apoderado" type="button">Retirar</button>'
    //     );

    //     // Hacemos focus en el primer input del formulario
    //     $("#apoderado .col-md-3:first .well input:first").focus();

    //     // Volvemos a cargar todo los plugins que teníamos, dentro de esta función esta el del datepicker assets/js/ini.js
    //     //Plugins();
    // });
    // Cuando hacemos click en el boton de retirar
    // $("#apoderado").on('click', '.btn-retirar-apoderado', function() {
    //     $(this).closest('#addpoderdante').remove();
    // });


});
var nextinputp = 0;

function addPoderdante() {
    nextinputp++;
    htmladdpoderdante =
        '<div id="addpoderdante_' + nextinputp +
        '" class="row"><div class="col-md-2"><div class="form-group bmd-form-group is-filled"><label for="poderdantetypeidentification[]" class="bmd-label-floating">Tipo identificacion</label>' +
        '<select id="" name="poderdantetypeidentification[]" class="custom-select" required>' +
        //'<option value="0">-- SELECCIONE --</option>' +
        '<option value="C.C." selected> C.C.</option >' +
        '<option value="NIT."> NIT.</option >' +
        '<option value="C.E."> C.E.</option >' +
        '<option value="P.P."> Pasaporte</option>' +
        '</select></div></div><div class="col-md-2"><div class="form-group"><label for="poderdanteidentification[]" class="bmd-label-floating">Identificacion poderdante</label>' +
        '<input type="text" class="form-control" name="poderdanteidentification[]" value="" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="poderdanteidentificationexpedida[]" class="bmd-label-floating">Expedida ident. poderdante</label>' +
        '<input type="text" class="form-control" id="" name="poderdanteidentificationexpedida[]" value="" autocomplete="off" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="poderdantename[]" class="bmd-label-floating">Nombre poderdante</label>' +
        '<input type="text" class="form-control" id="" name="poderdantename[]" autocomplete="off" value="" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="poderdantelastname[]" class="bmd-label-floating">Apellido poderdante</label>' +
        '<input type="text" class="form-control" id="" name="poderdantelastname[]" value="" autocomplete="off" required />' +
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
        '<select id="" name="apoderadotypeidentification[]" class="custom-select" required>' +
        //'<option value="0">-- SELECCIONE --</option>' +
        '<option value="C.C." selected> C.C.</option >' +
        '<option value="NIT."> NIT.</option >' +
        '<option value="C.E."> C.E.</option >' +
        '<option value="P.P."> Pasaporte</option>' +
        '</select></div></div><div class="col-md-2"><div class="form-group"><label for="apoderadoidentification[]" class="bmd-label-floating">Identificacion apoderado</label>' +
        '<input type="text" class="form-control" name="apoderadoidentification[]" value="" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="apoderadoidentificationexpedida[]" class="bmd-label-floating">Expedida ident. apoderado</label>' +
        '<input type="text" class="form-control" id="" name="apoderadoidentificationexpedida[]" value="" autocomplete="off" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="apoderadoname[]" class="bmd-label-floating">Nombre apoderado</label>' +
        '<input type="text" class="form-control" id="" name="apoderadoname[]" autocomplete="off" value="" required />' +
        '</div></div><div class="col-md-2"><div class="form-group"><label for="apoderadolastname[]" class="bmd-label-floating">Apellido apoderado</label>' +
        '<input type="text" class="form-control" id="" name="apoderadolastname[]" value="" autocomplete="off" required />' +
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