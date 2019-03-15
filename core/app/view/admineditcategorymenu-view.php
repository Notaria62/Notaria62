<?php

/**
* @author DigitalesWeb
* @website http://digitalesweb.com/
**/


$cat = CategoryMenuData::get_cat_by_id($_GET["id"]);
$ug_catmenu = CategoryMenuData::get_usergroups_categorias($_GET["id"]);
$categories = CategoryMenuData::get_base_categories();
?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar categoria menu principal <i class="material-icons">import_contacts</i>
        </h4>
        <p class="card-category">Categorias y permisos a usuarios</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
            <h2></h2>
        </div>

        <form role="form" method="post" action="./?action=updatecategorymenu">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $cat->name; ?>"
                            required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="icon" class="bmd-label-floating">icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" value="<?= $cat->icon; ?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="url" class="bmd-label-floating">URL</label>
                        <input type="text" class="form-control" id="url" name="url" value="<?= $cat->url; ?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category_id">Categoria Padre</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">-- CATEGORIA SUPERIOR --</option>
                            <?php if (count($categories)>0):?>
                            <?php foreach ($categories as $c):?>
                            <option value="<?=$c->id;?>"
                                <?php if ($cat->category_id==$c->id) : echo "selected"; endif;?>>
                                <?=$c->name;?>
                            </option>
                            <?php CategoryMenuData::selected_tree_cat_id($c->id, 1, $cat->id, $cat->category_id); ?>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                    $ug_catmenu = CategoryMenuData::get_usergroups_categorias($_GET["id"]);
                    $ug = UserGroupsData::getAll();
                    if (count($ug)>0):
                    foreach ($ug as $d):
                        $encontrado = false;
                    foreach ($ug_catmenu as $pc) {
                        if ($pc->user_groups_id==$d->id) {
                            $encontrado = true;
                            break;
                        }
                    }?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="category_<?php echo $d->id; ?>"
                                <?= ($encontrado) ? "checked":"";?>>
                            <?php echo $d->group_name; ?>
                        </label>
                    </div>
                    <?php endforeach;  endif; ?>
                </div>
                <div class="col-lg-offset-2 col-lg-10">
                    <input type="hidden" name="id" value="<?= $cat->id; ?>">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>

            </div>
        </form>


    </div>
</div>