<?php

/**
* @author DigitalesWeb
* @website http://digitalesweb.com/
**/

$categories = CategoryMenuData::get_base_categories();

?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Crear categoria menu principal <i class="material-icons">import_contacts</i>
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


        <form role="form" method="post" action="./?action=addcategorymenu">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="icon" class="bmd-label-floating">icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="url" class="bmd-label-floating">URL</label>
                        <input type="text" class="form-control" id="url" name="url" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category_id">Categoria Padre</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">-- CATEGORIA SUPERIOR --</option>
                            <?php if (count($categories)>0):?>
                            <?php foreach ($categories as $cat):?>
                            <option value="<?=$cat->id;?>"><?=$cat->name;?>
                            </option>
                            <?php CategoryMenuData::select_tree_cat_id($cat->id, 1); ?>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php $ug = UserGroupsData::getAll();?>
                    <?php if (count($ug)>0):
                         foreach ($ug as $d):?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="category_<?php echo $d->id; ?>">
                            <?php echo $d->group_name; ?>
                        </label>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
                <div class="col-lg-offset-2 col-lg-10">

                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>

            </div>
        </form>


    </div>
</div>