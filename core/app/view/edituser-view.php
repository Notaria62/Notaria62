<?php $user = UserData::getById($_GET["id"]);
$groups = UserGroupsData::getAll();
?>





<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar usuario administrador del sistema</h4>
        <p class="card-category">Usuario administradores del sistema</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
        </div>
        <form class="form-horizontal" method="post" id="addproduct" action="./?view=updateuser" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Nombres</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?=$user->name;?>"
                            required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname" class="bmd-label-floating">Apellidos</label>
                        <input type="text" name="lastname" required class="form-control" id="lastname" value="<?=$user->lastname;?>"
                            r>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cc" class="bmd-label-floating">C.C.</label>
                        <input type="text" name="cc" required class="form-control" id="cc" value="<?=$user->cc;?>"
                            r>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="gender" class="bmd-label-floating">Genero</label>
                        <select id="gender" name="gender" class="custom-select" required>
                            <option value="0" <?=($user->gender == "0") ? "selected":"";?>>Femenino</option>
                            <option value="1" <?=($user->gender == "1") ? "selected":"";?>>Masculino</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="bmd-label-floating">Nombre de usuario (Email)</label>
                        <input type="email" name="username" class="form-control" value="<?=$user->username;?>"
                            required id="username">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="bmd-label-floating">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?=$user->email;?>"
                            r>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="bmd-label-floating">Contrase&ntilde;a</label>
                        <input type="password" name="password" class="form-control" id="password">
                        <p class="help-block">La contrase&ntilde;a solo se modificara si escribes algo, en caso
                            contrario no se modifica.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="user_level" class="bmd-label-floating">Rol de usuario</label>
                        <select id="user_level" name="user_level" class="custom-select" required>
                            <?php foreach ($groups as $group):?>
                            <option value="<?= $group->group_level;?>"
                                <?=($user->user_level == $group->group_level) ? "selected":"";?>><?=$group->group_name;?>
                            </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="is_active" class="bmd-label-floating">Esta activo</label>
                        <input type="checkbox" name="is_active" id="is_active" <?= ($user->is_active)? "checked":"";?>>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden" name="user_id" value="<?php echo $user->id;?>" />
                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>