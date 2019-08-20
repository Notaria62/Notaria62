<?php

if (count($_POST) > 0) {
    $b = new PaymentTypeData();
    $b->tipo = $_POST["tipo"];
    $b->id_tipo = $_POST["id_tipo"];
    $b->mount = Util::eliminar_puntos_tres_digitos($_POST["mount"]);
    $b->id_bankaccounts =  isset($_POST["id_bankaccounts"]) ? $_POST["id_bankaccounts"] : "0";
    $b->id_cashregister =  isset($_POST["id_cashregister"]) ? $_POST["id_cashregister"] : "0";
    $b->status =  isset($_POST["status"]) ? $_POST["status"] : "1";
    $b->created_at = isset($_POST["created_at"]) ? $_POST["created_at"] : "0000-00-00 00:00:00";
    $b->user_id = Session::getUID();
    $b->add();
    Session::msg("s", "Agregado correctamente.");
    //Core::redir("./?view=beneficencia");
}