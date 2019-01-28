<?php

if (count($_POST)>0) {
    $u = UserGroupsData::getById($_POST["id"]);
    $u->group_status = Util::remove_junk($_POST["group_status"]);
    $u->update_status();
    Session::msg("s", "Actualizado correctamente.");
    Core::redir("./?view=usergroups&id=".$_POST["id"]);
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=usergroups");
}
