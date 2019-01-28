<?php

if (Session::getUID()!="") {
    Core::redir("./?view=home", false);
}?>

<div class="off-canvas-sidebar login-page">
    <div class="wrapper wrapper-full-page">
        <div class="page-header login-page" filter-color="white">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="container">
                <div class="col-md-5 ml-auto mr-auto">
                    <form accept-charset="UTF-8" role="form" method="post" action="./?view=processlogin">
                        <div class="card card-login card-hidden">
                            <div class="card-header card-header-rose text-center">
                                <h4 class="card-title">Iniciar session</h4>
                            </div>
                            <div class="card-body ">
                                <span class="bmd-form-group">
                                    <div class="input-group justify-content-center">
                                        <img src="themes/notaria62web/img/logo.png" alt="Notaria 62" height="40" width="40" />
                                    </div>
                                </span>
                                <span class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">email</i>
                                            </span>
                                        </div>
                                        <input type="email" name="mail" id="mail" class="form-control" placeholder="Correo electr&oacute;nico...">
                                    </div>
                                </span>
                                <span class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Contraseña...">
                                    </div>
                                </span>
                            </div>
                            <div class="card-footer justify-content-center">
                                <input class="btn btn-primary btn-round" type="submit" value="Iniciar Sesion" />
                            </div>
                        </div>
                    </form>
                    <?php if (isset($_COOKIE['password_updated'])):?>
                    <div class="alert alert-success alert-with-icon" data-notify="container">
                        <i class="material-icons" data-notify="icon">notifications</i>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="material-icons">close</i></button>
                        <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                        <span data-notify="message">
                            ¡Se ha cambiado la contraseña exitosamente!
                        </span>
                    </div>
                    <?php setcookie("password_updated", "", time()-18600); endif; ?>
                    <?php if (isset($_COOKIE['loginInvalid'])):?>
                    <div class="alert alert-danger alert-with-icon" data-notify="container">
                        <i class="material-icons" data-notify="icon">notifications</i>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="material-icons">close</i></button>
                        <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                        <span data-notify="message">
                            Usuario y/o contraseña incorrecta.
                        </span>
                    </div>
                    <?php setcookie("loginInvalid", "", time()-18600); endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $().ready(function() {
        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 500)
    });
</script>