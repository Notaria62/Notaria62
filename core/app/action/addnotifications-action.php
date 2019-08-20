<?php
if (count($_POST)>0) {
    $user = UserData::getById(Session::getUID());
    $fullname = $user->name . " " . $user->lastname;
    $c = new NotificationsData();
    $c->mensaje = $_POST["mensaje"];
    $c->autor=$fullname;
    $c->add();
    Session::msg("s", "Agregado correctamente. El mensaje: ".$_POST["mensaje"]);
    Core::redir("./?view=notifications");
} else {
    pCore::redir("./?view=notifications");
}