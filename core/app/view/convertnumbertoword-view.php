<?php
Session::currentURL();

$numtoword = "";
$peso= isset($_POST["numtoword"])?$_POST["numtoword"]:"";
if (isset($_POST["numtoword"]) && $_POST["numtoword"]!="") {
    $numtoword = mb_strtoupper(CifrasEnLetras::convertirPesosEnLetras($_POST["numtoword"], 0));
}
?>


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Convertir n&uacute;meros a letras</h4>
        <p class="card-category"></p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
        </div>
        <form class="form-horizontal" method="post" id="formnumtoword" role="form">
            <input type="hidden" name="view" value="convertnumbertoword" />
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numtoword" class="bmd-label-floating">N&uacute;mero a convertir</label>
                        <input type="text" class="form-control" id="numtoword" name="numtoword"
                            onkeypress="return justNumbers(event);" required />
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons">check</i> Convertir</button>
                </div>
            </div>

        </form>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <h2><?= $numtoword;?>
                </h2>
                <h5><?="Pesos a convertir: ".$peso?>
                </h5>
            </div>
        </div>
    </div>
</div>
<script>
function justNumbers(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}
</script>