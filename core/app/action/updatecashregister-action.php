<?php

if (count($_POST)>0) {

    $cr = CashRegisterData::getById($_POST["id_cashregister"]);
    // $cr->radicado = $_POST["radicado"];
    $cr->cuentaanticipos = $_POST["cuentaanticipos"];
    $cr->cuentanotaria = $_POST["cuentanotaria"];
    $cr->cuentaunicanotarial = $_POST["cuentaunicanotarial"];
    $cr->diferencias = $_POST["diferencias"];

    $cr->totalpagos = $_POST["totalpagos"];
    $cr->cajaauxuliar = $_POST["cajaauxuliar"];
    $cr->cajaprincipal = $_POST["cajaprincipal"];
    $cr->caja1erpiso = $_POST["caja1erpiso"];
     
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