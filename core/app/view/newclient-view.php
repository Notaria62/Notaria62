<?php



?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Nuevo empleado <i class="material-icons">import_contacts</i></h4>
        <p class="card-category"></p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
        </div>

        <form class="form-horizontal" method="post" id="addproduct" action=".\?view=addclient" role="form">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="bmd-label-floating">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="lastname" class="bmd-label-floating">Apellidos</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cc" class="bmd-label-floating">C.C.</label>
                    <input type="text" class="form-control" id="cc" name="cc" required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="address" class="bmd-label-floating">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="address" class="bmd-label-floating">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone" class="bmd-label-floating">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="is_dr" class="bmd-label-floating">Es Abogado</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_dr">
                        </label>
                    </div>
                </div>
            </div>
            <p class="alert alert-info">* Campos obligatorios</p>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </form>
    </div>
</div>