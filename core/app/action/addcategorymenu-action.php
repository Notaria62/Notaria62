<?php

if (count($_POST)>0) {
    $b = new CategoryMenuData();
    $b->name = $_POST["name"];
    $b->icon = $_POST["icon"]!=""? $_POST["icon"]:"view_agenda";
    $b->url= $_POST["url"]!="" ? $_POST["url"] : "#";
    $b->category_id = $_POST["category_id"]!=""? $_POST["category_id"]:"NULL";
    $b->add();


    $last_id = CategoryMenuData::getLastId();
    $ug = UserGroupsData::getAll();
    foreach ($ug as $ugl) {
        if (isset($_POST["category_".$ugl->id])) {
            $b->addUserGroupsCategoryMenu($ugl->id, $last_id->id);
        }
    }
    Session::msg("s", "Agregado correctamente...");
    Core::redir("./?view=admincategorymenu");
}