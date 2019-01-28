<?php
/**
* BookMedik
* @author digitalesweb
* @url http://digitalesweb.com/about/
**/

if (count($_POST)>0) {
    $user = new UserData();
    $user->name = $_POST["name"];
    $user->lastname = $_POST["lastname"];
    $user->cc = $_POST["cc"];
    $user->gender = $_POST["gender"];
    $user->username = $_POST["username"];
    $user->email = $_POST["email"];
    $user->user_level=$_POST["user_level"];
    $user->password = sha1(md5($_POST["password"]));
    $user->add();
    Session::msg("s", "Agregado correctamente. ".$_POST["username"]);
    Core::redir("./?view=users");
} else {
    Session::msg("d", "Error al agregar, por favor llame al administrador del sistema.");
    Core::redir("./?view=users");
}
