<style type="text/css">
    div.sidebar, nav.navbar, footer {
        display: none;
    }

    div.main-panel {
        float: none;
        width: 100%;
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

    .main-panel > .content {
        margin-top: 0px;
        padding: 0;
    }
    @media screen and (max-width: 580px) {
        h1.thanks {
        font-size:1.5em;
        }
    }
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
                    Su correo electrónico se ha enviado con exito <i class="fa fa-check-circle"></i>
                </h4> 
            </div>
            <div class="card-content table-responsive">
                <form id="formConsulta" role="form">
                    <input type="hidden" name="view" value="consultatramite" />
                    
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12">
                                    <h1 class="thanks">Gracias por escogernos, atendiendo el principio de rogaci&oacute;n (Art. 4 Dcto. 960/70), le responderemos a la mayor brevedad.</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12">
                                    <button class="btn btn-primary" id="btnConsultar">Consultar un tramite</button>
                                </div>
                            </div>
                      
                    
                    <div class="nota">

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
