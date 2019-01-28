<?php


if (isset($_SESSION["user_id"])) {
    $user = UserData::getById($_SESSION["user_id"]);
    $password = sha1(md5($_POST["password"]));
    if ($password==$user->password) {
        $user->password = sha1(md5($_POST["newpassword"]));
        $user->update_passwd();
        setcookie("password_updated", "true");
        Session::msg("s", '¡Se ha cambiado la contraseña exitosamente!');
        Core::redir("./logout.php", false);
    } else {
        Session::msg("d", "Contraseña incorrecta.");
        Core::redir("./?view=security", false);
    }
} else {
    Core::redir("./?view=login", false);
    //print "<script>window.location='index.php';</script>";
}
