<?php

if (count($_GET)>0) {
    $b = new PaymentTypeData();
    $b->tipo = $_GET["tipo"];
    $b->id_tipo = $_GET["id_tipo"];
    $b->mount = $_GET["mount"];
    $b->id_bankaccounts =  isset($_GET["id_bankaccounts"]) ? $_GET["id_bankaccounts"] : "0";
    $b->id_cashregister =  isset($_GET["id_cashregister"]) ? $_GET["id_cashregister"] : "0";
    $b->status =  isset($_GET["status"]) ? $_GET["status"] : "1";
    $b->created_at= isset($_GET["created_at"]) ? $_GET["created_at"] : "0000-00-00 00:00:00";
    $b->user_id=Session::getUID();
    $b->add();
    Session::msg("s", "Agregado correctamente.");
    //Core::redir("./?view=beneficencia");
}