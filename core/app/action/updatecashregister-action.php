<?php

if (count($_POST) > 0) {

    $cr = CashRegisterData::getById($_POST["id_cashregister"]);
    // $cr->radicado = $_POST["radicado"];
    $cr->cuentaanticipos = Util::eliminar_puntos_tres_digitos($_POST["cuentaanticipos"]);
    $cr->cuentanotaria = Util::eliminar_puntos_tres_digitos($_POST["cuentanotaria"]);
    $cr->cuentaunicanotarial = Util::eliminar_puntos_tres_digitos($_POST["cuentaunicanotarial"]);
    $cr->diferencias = isset($_POST["diferencias"]) ? $_POST["diferencias"] : "0";;

    $cr->totalpagos = Util::eliminar_puntos_tres_digitos($_POST["totalpagos"]);
    $cr->cajaauxuliar = Util::eliminar_puntos_tres_digitos($_POST["cajaauxuliar"]);
    $cr->cajaprincipal = Util::eliminar_puntos_tres_digitos($_POST["cajaprincipal"]);
    $cr->caja1erpiso = Util::eliminar_puntos_tres_digitos($_POST["caja1erpiso"]);

    $cr->update();

    // if ($_POST["password"]!="") {
    //     $user->password = sha1(md5($_POST["password"]));
    //     $user->update_passwd();
    //     Session::msg("s", "Se ha actualizado el password correctamente.");
    //     Core::redir("./?view=users");
    // }
    Session::msg("s", "Actualizado el cuadre correctamente.");
    Core::redir("./?view=cashregister");
}