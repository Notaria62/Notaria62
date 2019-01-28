<?php

$groups = UserGroupsData::getAll();

?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Nuevo usuario administrador del sistema</h4>
        <p class="card-category">Usuario administradores del sistema</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <form class="form-horizontal" method="post" id="addproduct" action="./?view=adduser" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Nombres</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname" class="bmd-label-floating">Apellidos</label>
                        <input type="text" name="lastname" required class="form-control" id="lastname">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cc" class="bmd-label-floating">C.C.</label>
                        <input type="text" name="cc" required class="form-control" id="cc">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="gender" class="bmd-label-floating">Genero</label>
                        <select id="gender" name="gender" class="custom-select" required>
                            <option value="0">Femenino</option>
                            <option value="1">Masculino</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="bmd-label-floating">Nombre de usuario (Email)</label>
                        <input type="email" name="username" class="form-control" required id="username">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="bmd-label-floating">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="bmd-label-floating">Contrase&ntilde;a</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="is_admin" class="bmd-label-floating">Es administrador</label>

                        <input type="checkbox" name="is_admin" id="is_admin">

                    </div>
                </div> -->
                <div class="col-md-6">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="user_level" class="bmd-label-floating">Rol de usuario</label>
                        <select id="user_level" name="user_level" class="custom-select" required>
                            <?php foreach ($groups as $group):?>
                            <option value="<?= $group->group_level;?>"><?=$group->group_name;?>
                            </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>