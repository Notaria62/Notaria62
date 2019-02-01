<?php
$templatename = TemplateMemorandumData::getById($_GET['ddlmemorandum']);
 $mystr = $templatename->name;
// $findme = "ley";
// $flag = 0;
// $pos = strpos($mystr, $findme);
// if ($pos !== false) {
//     $flag = 1;
// }
$allBancos =  MemorandumData::getAllBancos();
$text = "";
foreach ($allBancos as $key => $value) {
    $text .= "'".$value->nombrebanco."',";
}
$allNotarias =  MemorandumData::getAllNotarias();
$notarias = "";
foreach ($allNotarias as $key => $value) {
    $notarias .= "'".$value->notariaescriturahipoteca."',";
}
?>
<form class="" method="post" id="addmemorandum" action="./?action=addmemorandum" role="form">
    <div class="row">
        <div class="col-md-12">
            <h2>
                <?php echo $mystr;?>
            </h2>
            <h3>Deudores</h3>
            <a href="#" onclick="adddebtor();" class="btn btn-success">Agregar deudor</a>
        </div>
    </div>
    <hr />
    <div id="campos" class=""></div>

    <hr />
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="matriculainmobiliaria" class="bmd-label-floating">Matricula inmobiliaria</label>
                <input type="text" class="form-control" id="matriculainmobiliaria" name="matriculainmobiliaria"
                    required />
            </div>
            <div class="form-group">
                <label for="numeroescriturapublica" class="bmd-label-floating">N&uacute;mero de escritura
                    publica</label>
                <input type="number" class="form-control" id="numeroescriturapublica" name="numeroescriturapublica"
                    required />
            </div>

            <div class="form-group">
                <label for="numeroescriturahipoteca" class="bmd-label-floating">N&uacute;mero escritura hipoteca</label>
                <input type="number" class="form-control" id="numeroescriturahipoteca" name="numeroescriturahipoteca"
                    required />
            </div>
            <div class="form-group">
                <label for="notariaescriturahipoteca" class="bmd-label-floating">Notaria escritura hipoteca</label>
                <input type="search" class="form-control" id="notariaescriturahipoteca" name="notariaescriturahipoteca"
                    required value='' />
            </div>
            <div class="form-group">
                <label for="oficinaregistrohipoteca" class="bmd-label-floating">Oficina registro hipoteca</label>
                <input type="text" class="form-control" id="oficinaregistrohipoteca" name="oficinaregistrohipoteca"
                    required />
            </div>

            <div class="form-group">
                <label for="dateescriturahipoteca" class="bmd-label-floating">Fecha escritura hipoteca de
                    constituci&oacute;n (YYYY-MM-DD)</label>
                <input type="text" class="form-control" name="dateescriturahipoteca" id="dateescriturahipoteca"
                    placeholder="" required
                    pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                    title="Entre formato YYYY-MM-DD" maxlength="10" />
            </div>
            <div class="form-group">
                <label for="dateotorgamiento" class="bmd-label-floating">Fecha de otorgamiento (YYYY-MM-DD)</label>
                <input type="text" class="form-control" name="dateotorgamiento" id="dateotorgamiento" placeholder=""
                    required
                    pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                    title="Entre formato YYYY-MM-DD" maxlength="10"
                    value="<?php echo (new \DateTime())->format('Y-m-d'); ?>" />
            </div>
            <div class="form-group">
                <label for="cuantiahipoteca" class="bmd-label-floating">Cuantia hipoteca</label>
                <input type="text" class="form-control" id="cuantiahipoteca" name="cuantiahipoteca" required />
            </div>
            <div class="form-group bmd-form-group is-filled">
                <label for="ubicacionpredio" class="bmd-label-floating">Ubicaci&oacute;n predio</label>
                <select id="ubicacionpredio" name="ubicacionpredio" class="custom-select" required>
                    <option value="Rural">Rural</option>
                    <option value="Urbano">Urbano</option>
                </select>
            </div>
            <div class="form-group">
                <label for="direccioninmueble" class="bmd-label-floating">Direcci&oacute;n inmueble</label>
                <textarea class="form-control" id="direccioninmueble" name="direccioninmueble" required
                    rows="10"></textarea>
            </div>
        </div>
        <!-- END DIV 6 -->
        <div class="col-md-6">

            <div class="form-group">
                <label for="nombrebanco" class="bmd-label-floating">Nombre banco</label>
                <input type="text" class="form-control" id="nombrebanco" name="nombrebanco" />
            </div>

            <div class="form-group">
                <label for="numerocertificado" class="bmd-label-floating">N&uacute;mero certificado</label>
                <input type="text" class="form-control" id="numerocertificado" name="numerocertificado" />
            </div>
            <div class="form-group">
                <label for="numerohojaspapelnotarial" class="bmd-label-floating">N&uacute;mero hojas papel
                    notarial</label>
                <input type="text" class="form-control" id="numerohojaspapelnotarial" name="numerohojaspapelnotarial"
                    required />
            </div>
            <div class="form-group">
                <label for="derechosnotariales" class="bmd-label-floating">Derechos notariales</label>
                <input type="number" class="form-control" id="derechosnotariales" name="derechosnotariales" required
                    value="59400" />
            </div>
            <div class="form-group">
                <label for="superintendencia" class="bmd-label-floating">Superintendencia</label>
                <input type="text" class="form-control" id="superintendencia" name="superintendencia" required
                    value="6200" />
            </div>
            <div class="form-group">
                <label for="fondonacionalnotariado" class="bmd-label-floating">Fondo nacional notariado</label>
                <input type="number" class="form-control" id="fondonacionalnotariado" name="fondonacionalnotariado"
                    required value="6200" />
            </div>
            <div class="form-group">
                <label for="iva" class="bmd-label-floating">I.V.A.</label>
                <input type="number" class="form-control" id="iva" name="iva" required value="24149" />
            </div>

            <div class="form-group bmd-form-group is-filled">
                <label for="notario_id" class="bmd-label-floating">Notario</label>
                <select id="notario_id" name="notario_id" required class="custom-select">
                    <?php
                        foreach (NotariosData::getAll() as $d) {
                            ?>
                    <option value="<?php echo $d->id; ?>">
                        <?=$d->name." ".$d->lastname; ?>
                    </option>
                    <?php
                        } ?>
                </select>
            </div>
            <div class="form-group label-floating" id="resolucionnotario_div">
                <label for="resolucionnotario" class="bmd-label-floating">Resolución notario</label>
                <input type="number" class="form-control" id="resolucionnotario" name="resolucionnotario" value="0" />
            </div>
            <div class="form-group label-floating" id="dateresolucionnotario_div">
                <label for="dateresolucionnotario" class="bmd-label-floating">Fecha de resolución (YYYY-MM-DD)</label>
                <input type="text" class="form-control" name="dateresolucionnotario" id="dateresolucionnotario"
                    placeholder="" required
                    pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                    title="Entre formato YYYY-MM-DD" maxlength="10"
                    value="<?php echo (new \DateTime())->format('Y-m-d'); ?>" />
            </div>
            <div class="form-group bmd-form-group is-filled">
                <label for="" class="bmd-label-floating">Digitador</label>
                <select id="digitador_id" name="digitador_id" required class="custom-select">
                    <?php foreach (DigitadoresData::getAll() as $d) {
                            ?>
                    <option value="<?php echo $d->id; ?>">
                        <?= $d->name." ".$d->lastname; ?>
                    </option>
                    <?php
                        }?>
                </select>
            </div>
            <div class="form-group">
                <label for="radicado" class="bmd-label-floating">N&uacute;mero de radicado</label>
                <input type="number" class="form-control" id="radicado" name="radicado" />
            </div>
        </div>
    </div>
    <!-- END DIV row-->
    <hr />
    <h5 class="display-4">Carta</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="sare" class="bmd-label-floating">SARE</label>
                <input type="text" class="form-control" id="sare" name="sare" value="0" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="officecode" class="bmd-label-floating">N&uacute;mero de oficina</label>
                <input type="text" class="form-control" id="officecode" name="officecode" value="0" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-offset-2 col-lg-10">
            <input type="hidden" name="templatememo_id" id="templatememo_id"
                value="<?php echo $_GET['ddlmemorandum'];?>" />
            <button type="submit" class="btn btn-success">Guardar minuta</button>
        </div>
    </div>
    <!-- END DIV-->
</form>

<script>
$(function() {
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
    var availableTags = [<?php echo $text;?>];
    var availableTagsNotarias = [<?php echo $notarias;?>];
    autocomplete(document.getElementById("nombrebanco"), availableTags);
    autocomplete(document.getElementById("notariaescriturahipoteca"), availableTagsNotarias);


});
var nextinput = 0;

function adddebtor() {
    nextinput++;
    //campo = '<input type="text" size="20" id="campo' + nextinput + '"&nbsp; name="campo' + nextinput + '"&nbsp; />';

    htmldebtors =
        '<div class="row"><div class="col-md-4"><div class="form-group bmd-form-group is-filled"><label for="" class="bmd-label-floating">Tipo documento</label>' +
        '<select id="typeident' + nextinput + '" name="typeident' + nextinput + '" class="custom-select" required>' +
        '<option value="0" selected>-- SELECCIONE --</option>' +
        '<option value="C.C."> C.C.</option >' +
        '<option value="NIT."> NIT.</option >' +
        '<option value="C.E."> C.E.</option >' +
        '<option value="P.P."> Pasaporte</option>' +
        '</select></div></div><div class="col-md-4"><div class="form-group"><label for="identificacion' + nextinput +
        '" class="bmd-label-floating"> Identificaci&oacute;n</label> ' +
        '<input type= "text" class="form-control" id= "identificacion' + nextinput + '" name= "identificacion' +
        nextinput + '" required />' +
        '</div></div><div class="col-md-4"><div class="form-group"><label for="fullname' + nextinput +
        '" class="bmd-label-floating"> Nombre completo</label > ' +
        '<input type= "text" class="form-control" id= "fullname' + nextinput + '" name= "fullname' + nextinput +
        '" required /></div></div></div>';
    $("#campos").append(htmldebtors);
}

function AgregarCampos() {
    nextinput++;
    campo = '<li id="rut' + nextinput + '">Campo:<input type="text" size="20" id="campo' + nextinput +
        '"&nbsp; name="campo' + nextinput + '"&nbsp; /></li>';
    $("#campos").append(campo);
}
</script>