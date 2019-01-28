<?php
/**
* @author DigitalesWeb
* @website http://digitalesweb.com/
**/
$categories = CategoryMenuData::get_base_categories();
$user = Util::current_user();
Session::currentURL();

?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Administrador de categorias menu principal <i class="material-icons">import_contacts</i>
        </h4>
        <p class="card-category">Categorias y permisos a usuarios</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
            <a href="./?view=adminnewcategorymenu" class="btn btn-default">
                <i class="material-icons">add</i> Crear categoria
            </a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (count($categories)>0):?>
                <ul>
                    <?php foreach ($categories as $cat):?>
                    <li class="">
                        <p>
                            <a href="#<?=$cat->id;?>">
                                <i class="material-icons"><?=$cat->icon;?></i>
                                <?=$cat->name;?>
                            </a>
                            <?= CategoryMenuData::addHTMLUserGroupCategoryMenu($cat->id); ?>
                            <?= CategoryMenuData::edit_btn($cat->id)." ".CategoryMenuData::del_btn($cat->id);?>
                        </p>
                        <?php
                    CategoryMenuData::list_tree_cat_id($cat->id); ?>
                        <?php endforeach;?>

                    </li>
                </ul>
                <?php else:?>
                <p class="alert alert-danger">No hay categorias</p>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>