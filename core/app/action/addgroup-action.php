<?php

if (count($_POST)>0) {
    $u = new UserGroupsData();
    $u->group_name = Util::remove_junk($_POST["group_name"]);
    $u->group_level = Util::remove_junk($_POST["group_level"]);
    $u->group_status = Util::remove_junk($_POST["group_status"]);
    $groups= UserGroupsData::find_by_groupName($_POST["group_name"]);
    $level= UserGroupsData::find_by_groupLevel($_POST["group_level"]);

    if ($groups->group_name === Util::remove_junk($_POST["group_name"])) {
        Session::msg("d", "<b>Error!</b> El nombre de grupo existe en la base de datos.");
        Core::redir("./?view=newgroup");
    } elseif ($level->group_level === Util::remove_junk($_POST['group_level'])) {
        Session::msg("d", "<b>Error!</b> El nivel de grupo existe en la base de datos.");
        Core::redir("./?view=newgroup");
    } else {
        $u->add();
        Session::msg("s", "Agregado satisfactoriamente.");
        Core::redir("./?view=usergroups");
    }
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=usergroups");
}
