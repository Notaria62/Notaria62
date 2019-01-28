<?php

if (count($_POST)>0) {
    $is_admin=0;
    if (isset($_POST["is_admin"])) {
        $is_admin=1;
    }
    $is_active=0;
    if (isset($_POST["is_active"])) {
        $is_active=1;
    }
    $user = UserData::getById($_POST["user_id"]);
    $user->name = $_POST["name"];
    $user->lastname = $_POST["lastname"];
    $user->cc = $_POST["cc"];
    $user->gender = $_POST["gender"];

    $user->username = $_POST["username"];
    $user->email = $_POST["email"];
    $user->is_admin=$is_admin;
    $user->is_active=$is_active;
    $user->update();

    if ($_POST["password"]!="") {
        $user->password = sha1(md5($_POST["password"]));
        $user->update_passwd();
        Session::msg("s", "Se ha actualizado el password correctamente.");
        Core::redir("./?view=users");
    }
    Session::msg("s", "Actualizado el usuario correctamente.");
    Core::redir("./?view=users");
}
