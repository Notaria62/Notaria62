<?php

// if (count($_POST)>0) {
//     $u = new UserGroupsData();
//     $u->group_name = Util::remove_junk($_POST["group_name"]);
//     $u->group_level = Util::remove_junk($_POST["group_level"]);
//     $u->group_status = Util::remove_junk($_POST["group_status"]);
//     $groups= UserGroupsData::find_by_groupName($_POST["group_name"]);
//     $level= UserGroupsData::find_by_groupLevel($_POST["group_level"]);

//     if ($groups->group_name === Util::remove_junk($_POST["group_name"])) {
//         Core::redir("./?view=newgroup&type=danger&msg=<b>Error!</b> El nombre de grupo existe en la base de datos.");
//     } elseif ($level->group_level === Util::remove_junk($_POST['group_level'])) {
//         Core::redir("./?view=newgroup&type=danger&msg=<b>Error!</b> El nivel de grupo existe en la base de datos.");
//     } else {
//         $u->add();
//         Core::redir("./?view=usergroups&type=info&msg=Se guardo de forma correctamente.");
//     }
// } else {
//
// }

Session::msg("d", "Hello ,.");
Core::redir("./?view=users");
