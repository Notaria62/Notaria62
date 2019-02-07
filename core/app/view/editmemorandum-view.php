<?php
/**
 * editmemorandum_view short summary.
 *
 * editmemorandum_view description.
 *
 * @version 1.0
 * @author sistemas
 */
$b = MemorandumData::getById($_GET["id"]);
$nametemplate= TemplateMemorandumData::getById($b->templatememo_id);
$digitares = DigitadoresData::getAll();
$notarios = NotariosData::getAll();
$mystr = $nametemplate->name;
$findme = "ley";
$flag = 0;
$pos = strpos($mystr, $findme);
if ($pos !== false) {
    $flag = 1;
}
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



<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar minutas</h4>
        <p class="card-category">Se listan las plantillas usadas para la creacion de minutas y/o reportes</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
            <small>
                <?php echo $nametemplate->name?>
            </small>
        </div>
        <form class="" method="post" id="updatememorandum" action="./?action=updatememorandum" role="form">
            <div class="row">
                <div class="col-md-12">
                    <h3>Deudores</h3>
                    <a href="#" onclick="adddebtor();" class="btn btn-success">Agregar deudor</a>
                    <a href="#" onclick="removedebtors();" class="btn btn-danger">Borrar deudor</a>
                </div>
            </div>
            <hr />
            <div id="campos" class="">
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Matricula inmobiliaria</label>
                        <input type="text" class="form-control" id="matriculainmobiliaria" name="matriculainmobiliaria"
                            value="<?php echo $b->matriculainmobiliaria;?>" />
                    </div>
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">N&uacute;mero de escritura
                            publica</label>
                        <input type="number" class="form-control" id="numeroescriturapublica"
                            name="numeroescriturapublica" value="<?php echo $b->numeroescriturapublica;?>" />
                    </div>


                    <div class="form-group">
                        <label for="" class="bmd-label-floating">N&uacute;mero escritura
                            hipoteca</label>
                        <input type="number" class="form-control" id="numeroescriturahipoteca"
                            name="numeroescriturahipoteca" value="<?php echo $b->numeroescriturahipoteca;?>" />
                    </div>
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Notaria escritura hipoteca</label>
                        <input type="text" class="form-control" id="notariaescriturahipoteca"
                            name="notariaescriturahipoteca" value="<?php echo $b->notariaescriturahipoteca;?>" />
                    </div>
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Oficina registro hipoteca</label>
                        <input type="text" class="form-control" id="oficinaregistrohipoteca"
                            name="oficinaregistrohipoteca" value="<?php echo $b->oficinaregistrohipoteca;?>" />
                    </div>

                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Fecha escritura hipoteca de
                            constituci&oacute;n (YYYY-MM-DD)</label>
                        <input type="text" class="form-control" name="dateescriturahipoteca" id="dateescriturahipoteca"
                            value="<?php echo $b->dateescriturahipoteca;?>" placeholder="" required
                            pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                            title="Entre formato YYYY-MM-DD" maxlength="10" />
                    </div>
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Fecha de otorgamiento (YYYY-MM-DD)</label>
                        <input type="text" class="form-control" name="dateotorgamiento" id="dateotorgamiento"
                            value="<?php echo $b->dateotorgamiento;?>" placeholder="" required
                            pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                            title="Entre formato YYYY-MM-DD" maxlength="10" />
                    </div>
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Cuantia hipoteca</label>
                        <input type="text" class="form-control" id="cuantiahipoteca" name="cuantiahipoteca"
                            value="<?php echo $b->cuantiahipoteca;?>" />
                    </div>
                    <div class="form-group bmd-form-group is-filled">
                        <label for="" class="bmd-label-floating">Ubicaci&oacute;n predio</label>
                        <select id="ubicacionpredio" name="ubicacionpredio" class="custom-select" required>
                            <option value="0">-- SELECCIONE --</option>
                            <option
                                <?php if ($b->ubicacionpredio == 'Rural') :
                                        echo"selected"; endif; ?>
                                value="Rural">Rural</option>
                            <option
                                <?php if ($b->ubicacionpredio == 'Urbano') :
                                        echo"selected"; endif; ?>
                                value="Urbano">Urbano</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Direcci&oacute;n inmueble</label>
                        <textarea class="form-control" id="direccioninmueble" name="direccioninmueble" required
                            rows="10"><?php echo $b->direccioninmueble;?></textarea>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Nombre banco</label>
                        <input type="text" class="form-control" id="nombrebanco" name="nombrebanco"
                            value='<?php echo $b->nombrebanco;?>' />
                    </div>
                    <div class="form-group bmd-form-group is-filled">
                        <label for="digitador_id" class="bmd-label-floating">Digitador</label>
                        <select id="digitador_id" name="digitador_id" required class="custom-select">
                            <option value="0">-- SELECCIONE --</option>
                            <?php foreach ($digitares as $d) : ?>
                            <option
                                <?php if ($b->digitador_id == $d->id) :
                                        echo"selected"; endif; echo " value='$d->id'"; ?>>
                                <?php echo $d->name." ".$d->lastname; ?>
                            </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">N&uacute;mero certificado</label>
                        <input type="text" class="form-control" id="numerocertificado" name="numerocertificado"
                            value="<?php echo $b->numerocertificado;?>" />
                    </div>
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">N&uacute;mero hojas papel
                            notarial</label>
                        <input type="text" class="form-control" id="numerohojaspapelnotarial"
                            name="numerohojaspapelnotarial" value="<?php echo $b->numerohojaspapelnotarial;?>" />
                    </div>

                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Derechos notariales</label>
                        <input type="number" class="form-control" id="derechosnotariales" name="derechosnotariales"
                            value="<?php echo $b->derechosnotariales;?>" />
                    </div>
                    <div class="form-group">
                        <label for="superintendencia" class="bmd-label-floating">Superintendencia</label>
                        <input type="text" class="form-control" id="superintendencia" name="superintendencia"
                            value="<?php echo $b->superintendencia;?>" />
                    </div>
                    <div class="form-group">
                        <label for="fondonacionalnotariado" class="bmd-label-floating">Fondo nacional notariado</label>
                        <input type="number" class="form-control" id="fondonacionalnotariado"
                            name="fondonacionalnotariado" value="<?php echo $b->fondonacionalnotariado;?>" />
                    </div>
                    <div class="form-group">
                        <label for="iva" class="bmd-label-floating">iva</label>
                        <input type="number" class="form-control" id="iva" name="iva" value="<?php echo $b->iva;?>" />
                    </div>

                    <div class="form-group bmd-form-group is-filled">
                        <label for="notario_id" class="bmd-label-floating">Notario</label>
                        <select id="notario_id" name="notario_id" required class="custom-select">
                            <?php foreach (NotariosData::getAll() as $d) : ?>
                            <option value="<?php echo $d->id; ?>"
                                <?php if ($b->notario_id == $d->id) : echo"selected";
                                        endif; ?>>
                                <?php echo $d->name." ".$d->lastname; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group label-floating" id="resolucionnotario_div">
                        <label for="resolucionnotario" class="bmd-label-floating">Resolución notario</label>
                        <input type="number" class="form-control" id="resolucionnotario" name="resolucionnotario"
                            value="<?php echo $b->resolucionnotario;?>" />
                    </div>
                    <div class="form-group label-floating" id="dateresolucionnotario_div">
                        <label for="" class="bmd-label-floating">Fecha de resolución (YYYY-MM-DD)</label>
                        <input type="text" class="form-control" name="dateresolucionnotario" id="dateresolucionnotario"
                            value="<?php echo $b->dateresolucionnotario;?>" placeholder="" required
                            pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                            title="Entre formato YYYY-MM-DD" maxlength="10" />
                    </div>
                    <div class="form-group">
                        <label for="radicado" class="bmd-label-floating">N&uacute;mero de radicado</label>
                        <input type="number" class="form-control" id="radicado" name="radicado"
                            value="<?php echo $b->radicado;?>" />
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
                        <input type="text" class="form-control" id="sare" name="sare" required
                            value="<?php echo $b->sare;?>" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="officecode" class="bmd-label-floating">N&uacute;mero de oficina</label>
                        <input type="text" class="form-control" id="officecode" name="officecode" required
                            value="<?php echo $b->officecode;?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-2 col-lg-10">
                    <input type="hidden" name="templatememo_id" id="templatememo_id"
                        value="<?php echo $b->templatememo_id;?>" />
                    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>" />
                    <button type="submit" class="btn btn-success">Guardar minuta</button>
                </div>
            </div>
    </div>
    </form>
</div>
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
    htmldebtors = '<div class="row" id="DIV_' + nextinput +
        '"><div class="col-md-4"><div class="form-group bmd-form-group is-filled"><label for="typeident' +
        nextinput +
        '" class="bmd-label-floating">Tipo documento</label>' +
        '<select id="typeident' + nextinput + '" name="typeident' + nextinput +
        '" class="custom-select" required>' +
        '<option value="0" selected>-- SELECCIONE --</option>' +
        '<option value="C.C."> C.C.</option >' +
        '<option value="NIT."> NIT.</option >' +
        '<option value="C.E."> C.E.</option >' +
        '<option value="P.P."> Pasaporte</option>' +
        '</select></div></div><div class="col-md-4"><div class="form-group"><label for="identificacion' + nextinput +
        '" class="bmd-label-floating"> Identificaci&oacute;n</label> ' +
        '<input type= "text" class="form-control" id="identificacion' + nextinput +
        '" name= "identificacion' + nextinput + '" required />' +
        '</div></div><div class="col-md-4"><div class="form-group"><label for="" class="bmd-label-floating"> Nombre completo</label > ' +
        '<input type= "text" class="form-control" id= "fullname' + nextinput +
        '" name= "fullname' +
        nextinput + '" required /></div></div></div>';
    $("#campos").append(htmldebtors);
}

function adddebtoredit($value1, $value2, $value3) {
    nextinput++;
    htmldebtors = '<div class="row" id="DIV_' + nextinput +
        '"><div class="col-md-4"><div class="form-group bmd-form-group is-filled"><label for="typeident' +
        nextinput +
        '" class="bmd-label-floating">Tipo documento</label>' +
        '<select id="typeident' + nextinput + '" name="typeident' + nextinput +
        '" class="custom-select" required>' +
        '<option value="0" selected>-- SELECCIONE --</option>' +
        '<option value="C.C."> C.C.</option >' +
        '<option value="NIT."> NIT.</option >' +
        '<option value="C.E."> C.E.</option >' +
        '<option value="P.P."> Pasaporte</option>' +
        '</select></div></div><div class="col-md-4"><div class="form-group"><label for="" class="bmd-label-floating"> Identificaci&oacute;n</label> ' +
        '<input type= "text" class="form-control" id= "identificacion' + nextinput +
        '" name= "identificacion' + nextinput + '" required />' +
        '</div></div><div class="col-md-4"><div class="form-group"><label for="" class="bmd-label-floating"> Nombre completo</label > ' +
        '<input type= "text" class="form-control" id= "fullname' + nextinput +
        '" name= "fullname' +
        nextinput + '" required /></div></div></div>';
    $("#campos").append(htmldebtors);
}


function adddebtoredit($value1, $value2, $value3) {
    nextinput++;
    campo = '<li id="rut' + nextinput + '">Campo:<input type="text" size="20" id="campo' +
        nextinput +
        '"&nbsp; name="campo' + nextinput + '"&nbsp; /></li>';
    $("#campos").append(campo);
}

function removedebtors() {
    if (nextinput == 1) {
        alert("Debe haber minimo un deudor");
        return false;
    }
    $("#DIV_" + nextinput).remove();
    nextinput--;
}

function FormSetFieldValue(fieldName, fieldValue) {
    document.getElementById(fieldName).value = fieldValue;
}
</script>

<?php
if ($b->typeident1 != "0") {
                                            echo "<script>";
                                            echo "adddebtor();";
                                            echo "FormSetFieldValue('typeident1','".$b->typeident1."');";
                                            echo "FormSetFieldValue('identificacion1','".$b->identificacion1."');";
                                            echo "FormSetFieldValue('fullname1','".$b->fullname1."');";
                                            echo "</script>";
                                        }
if ($b->typeident2 != "0") {
    echo "<script>";
    echo "adddebtor();";
    echo "FormSetFieldValue('typeident2','".$b->typeident2."');";
    echo "FormSetFieldValue('identificacion2','".$b->identificacion2."');";
    echo "FormSetFieldValue('fullname2','".$b->fullname2."');";
    echo "</script>";
}
if ($b->typeident3 != "0") {
    echo "<script>";
    echo "adddebtor();";
    echo "FormSetFieldValue('typeident3','".$b->typeident3."');";
    echo "FormSetFieldValue('identificacion3','".$b->identificacion3."');";
    echo "FormSetFieldValue('fullname3','".$b->fullname3."');";
    echo "</script>";
}
if ($b->typeident4 != "0") {
    echo "<script>";
    echo "adddebtor();";
    echo "FormSetFieldValue('typeident4','".$b->typeident4."');";
    echo "FormSetFieldValue('identificacion4','".$b->identificacion4."');";
    echo "FormSetFieldValue('fullname4','".$b->fullname4."');";
    echo "</script>";
}
?>
</div>