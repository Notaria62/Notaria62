<?php
/**
* BookMedik
* @author digitalesweb
* @url http://digitalesweb.com/about/
**/
if (isset($_POST)) {
    $p = CategoryMenuData::getById($_POST['id']);
    $p->name = $_POST['name'];
    $p->icon = $_POST['icon'];
    $p->url = $_POST['url'];
    $p->category_id = $_POST["category_id"]!=""? $_POST["category_id"]:"NULL";

    $p->update();
    CategoryMenuData::delById_usergroups_categorias($_POST['id']);
    $last_id = $p->id;
    $ug = UserGroupsData::getAll();
    foreach ($ug as $ugl) {
        if (isset($_POST["category_".$ugl->id])) {
            $p->addUserGroupsCategoryMenu($ugl->id, $last_id);
        }
    }
    Session::msg("s", "Actualizado correctamente...");
    Core::redir("./?view=admincategorymenu");
}