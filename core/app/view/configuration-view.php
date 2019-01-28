
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Cambiar contraseña</h4>
        <p class="card-category">Cambiar contraseña</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
        </div>


        <form class="form-horizontal" id="changepasswd" method="post" action="./?view=changepasswd" role="form">
            <div class="row">
                <div class="col-lg-9">
                    <div class="form-group">

                        <label for="password" class="bmd-label-floating">Contraseña actual</label>

                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="form-group">
                        <label for="newpassword" class="bmd-label-floating">Nueva contraseña</label>
                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="confirmnewpassword" class="bmd-label-floating">Confirmar nueva contraseña</label>
                        <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword"
                            placeholder="">
                    </div>
                </div>


                <div class="col-lg-offset-2 col-lg-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success ">Cambiar contraseña</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    <script>
        $("#changepasswd").submit(function(e) {
            if ($("#password").val() == "" || $("#newpassword").val() == "" || $("#confirmnewpassword").val() ==
                "") {
                e.preventDefault();
                alert("No debes dejar espacios vacios.");

            } else {
                if ($("#newpassword").val() == $("#confirmnewpassword").val()) {
                    //			alert("Correcto");
                } else {
                    e.preventDefault();
                    alert("Las nueva contraseña no coincide con la confirmacion.");
                }
            }
        });
    </script>

</div>
</div>