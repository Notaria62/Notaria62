<style type="text/css">
div.sidebar,
nav.navbar,
footer.footer {
    display: none;
}

div.main-panel {
    width: -moz-available;
}

.general {
    background-image: url(themes/notaria62web/css/images/background.jpg);
    background-size: cover;
    background-position: center;
    position: absolute;
    width: 100%;
}

.logo {
    background-image: url(themes/notaria62web/css/images/logonotaria62azul.png);
    background-size: cover;
    width: 77px;
    height: 80px;
    margin-top: 15px;
    margin-bottom: 15px;
}

.transparencia {
    height: 150px;
    background-color: rgba(0, 0, 0, 0.30);
}

.main-panel>.content {
    margin-top: 0px;
    padding: 0;
}
</style>



<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Bienvenidos a consulta de tramite en NOTARIA 62 <i
                class="material-icons">import_contacts</i></h4>
        <p class="card-category"></p>
    </div>
    <div class="card-body">
        <div class="card-title">

            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
        </div>
        <form id="formConsulta" role="form">
            <input type="hidden" name="view" value="consultatramiteresultado" />
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12">
                    <div class="form-group">
                        <label class="bmd-label-floating" for="nut">Número de radicado o Escritura publica</label>
                        <input class="form-control" id="nut" name="nut" required="" maxlength="15" type="text">
                    </div>
                    <div class="form-group">
                        <label class="bmd-label-floating" for="ci">Número de Identificación</label>
                        <div class="bc-wrapper">
                            <input class="form-control" id="ci" name="ci" required="" maxlength="15" autocomplete="off"
                                type="text">
                            <div class="bc-menu list-group"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12">
                    <button class="btn btn-primary" id="btnConsultar">Consultar</button>
                </div>
            </div>

            <div class="nota">
                En esta página podrá consultar los trámites
                realizados a partir del 1 de enero de 2018, los trámites realizados con
                anterioridad a la fecha indicada debera comunicarse con nosotros en horario de oficina.
            </div>
        </form>
    </div>
</div>