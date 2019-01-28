<?php
$ug = UserGroupsData::getById($_GET["id"]);
?>






<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar grupo de usuarios</h4>
        <p class="card-category">Editar grupos</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
        </div>
        <form method="post" id="updtegroup" action="./?action=updategroup" role="form">


            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="group_name" class="bmd-label-floating">Nombre del grupo</label>
                        <input type="text" class="form-control" id="group_name" name="group_name" value='<?= $ug->group_name;?>'
                            readonly required />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="group_level" class="bmd-label-floating">Nivel del grupo</label>
                        <input type="number" class="form-control" id="group_level" name="group_level" value='<?= $ug->group_level;?>'
                            readonly required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="group_status" class="bmd-label-floating">Estado</label>
                        <select id="group_status" name="group_status" required class="custom-select">
                            <option value="1" <?= ($ug->group_status == 1)? "selected" : "";?>>Activo</option>
                            <option value="0" <?= ($ug->group_status == 0)? "selected" : "";?>>Inactivo</option>
                        </select>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden" name="id" value="<?php echo $ug->id;?>">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>