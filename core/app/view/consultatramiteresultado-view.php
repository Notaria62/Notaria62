
<style type="text/css">
    div.sidebar, nav.navbar, footer { display: none; }

    div.main-panel { float: none; width: 100%; }

    .general { background-image: url(themes/notaria62web/css/images/background.jpg); background-size: cover; background-position: center; position: absolute; width: 100%; }

    .logo { background-image: url(themes/notaria62web/css/images/logonotaria62azul.png); background-size: cover; width: 77px; height: 80px; margin-top: 15px; margin-bottom: 15px; }

    .transparencia { height: 150px; background-color: rgba(0, 0, 0, 0.30); }

    .main-panel > .content { margin-top: 0px; padding: 0; }
</style>
<div class="row">
    <div class="general">
        <div class="container">
            <div class="logo"></div>
        </div>
        <div class="transparencia"></div>
    </div>
</div>
<div class="row" style="margin-top:100px;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">
                    Estatus de tramite en NOTARIA 62
                </h4>
            </div>
            <div class="card-content table-responsive">

                <form id="formConsulta" role="form">
                    <input type="hidden" name="view" value="consultatramite" />

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12">
                            <?php
                            $procedure = array();
                            if($_GET["nut"]!="" && $_GET["ci"]!=""){
                                //if($_GET["start_at"]<$_GET["finish_at"]){
                                try {
                                    $procedure = ProcedureData::getByEoRyC($_GET["nut"],$_GET["ci"]);
                                }
                                catch (Exception $e) {
                                    //echo "fgdsgsdfg ";
                                }
                            }
                            if(count($procedure)>0){
                            ?>
                            <br />
                            <ul class="list-group">
                                <?php foreach($procedure as $proc):
                                          $status = StatusData::getById($proc->estatus);
                                ?>
                                <li class="list-group-item">
                                    <strong>Núm. Radicado:</strong>
                                    <span class="">
                                        1<?php echo $proc->radicado; ?>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Núm. Escritura:</strong>
                                    <span class="">
                                        <?php echo $proc->escritura;  ?>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>C.I.:</strong>
                                    <span class="">
                                        <?php echo $proc->ci;  ?>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Estatus:</strong>
                                    <span class="">
                                        <?php echo utf8_encode($status->name);  ?>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Descripción:</strong>
                                    <span class="">
                                        <?php echo utf8_encode($status->description);  ?>
                                    </span>
                                </li><?php endforeach; ?>
                            </ul>
                            <div class="clearfix"></div>
                            <?php
                            }else{
                            ?>
                            <p class="alert alert-danger">No hay resultado.</p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>



                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12">

                            <button class="btn btn-primary" id="btnConsultar">Consultar otro tramite</button>
                        </div>
                    </div>
                </form>
                <form id="formEnviar" role="form" method="post" action="./?action=sendemailto">
                    <input type="hidden" name="action" value="sendemailto" />
                    <?php if ($proc->email !=""){ ?>

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12">
                            <p>
                                Si tiene alguna inquietud, presione
                                <a href="#" id="show">
                                    aqu&iacute;
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="#" id="hide" style="display: none;">
                                    cerrar
                                    <i class="fa fa-eye-slash"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12">
                            <p>
                                Si tiene alguna inquietud, por favor contactenos haciendo clic
                                <a href="./?view=emailto" id="emailto">
                                    aqu&iacute;
                                    <i class="fa fa-envelope-square"></i>
                                </a>

                            </p>
                        </div>
                    </div>
                    <?php
                          }
                    ?>

                    <div class="form-group col-xs-12 col-sm-12" id="DIV_message" style="display: none;">

                        <div class="form-group">
                            <label for="" class="bmd-label-floating">Escriba su inquietud y su n&uacute;mero de cont&aacute;cto</label>
                            <textarea class="form-control" id="message" name="message" required cols="2"></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12">
                                <input type="hidden" name="emailFrom" id="emailFrom" value="<?php echo $proc->email;?>" />
                                <button class="btn btn-success" type="submit" id="btnEnviar">Enviar</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#hide").click(function () {
            $("#DIV_message").hide();
            $("#hide").hide();
            $("#show").show();
        });
        $("#show").click(function () {
            $("#DIV_message").show();
            $("#show").hide();
            $("#hide").show();
        });
    });
</script>