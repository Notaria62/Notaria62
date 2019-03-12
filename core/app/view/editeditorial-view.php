<?php $user = EditorialData::getById($_GET["id"]); ?>



<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar empresa <i class="material-icons">import_contacts</i></h4>
        <p class="card-category"></p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
        </div>

        <form class="form-horizontal" method="post" id="addproduct" action="./?action=updateeditorial" role="form">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="bmd-label-floating">Nombre *</label>
                            <input type="text" name="name" value="<?php echo $user->name; ?>" class="form-control"
                                id="name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <input type="hidden" name="user_id" value="<?php echo $user->id; ?>" />
                            <button type="submit" class="btn btn-success">Actualizar Editorial</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>