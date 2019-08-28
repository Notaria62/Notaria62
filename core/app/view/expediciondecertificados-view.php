<?php



?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Certificado de Estado de Cédula de Ciudadanía <i
                class="material-icons">import_contacts</i></h4>
        <p class="card-category">El certificado de estado es el mecanismo mediante el cual la Registraduría Nacional,
            luego de la verificación en las bases de datos del sistema de Identificación, Informa a los ciudadanos sobre
            el estado de un documento de identidad (cédula) expedido por la Entidad.</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="embed-responsive embed-responsive-16by9 rounded">
                    <iframe class="embed-responsive-item" src="https://wsp.registraduria.gov.co/certificado/Datos.aspx"
                        allowfullscreen></iframe>
                </div>

            </div>
            <div class="col-md-12">
                Si no puede ver esta página, agregue esta extension a su navegador: <a
                    href="https://addons.mozilla.org/en-US/firefox/addon/ignore-x-frame-options-header/"
                    target="_black">
                    Aquí</a>
            </div>
        </div>
    </div>
</div>