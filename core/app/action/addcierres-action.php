<?php
if (count($_POST)>0) {
    $c = new CierresData();
    $c->nroescriturapublica = $_POST["nroescriturapublica"];
    $c->dateescritura = $_POST["dateescritura"];
    $c->numfolios = $_POST["numfolios"];
    $b->observationcopy1 = $_POST["observationcopy1"];
    $b->observationcopy2 = $_POST["observationcopy2"];
    $c->destino=$_POST["destino"];
    $c->notario_id =  $_POST["notario_id"];
    $c->user_id=Session::getUID();
    $c->add();
    Session::msg("s", "Agregado correctamente. El cierre de la E.P.: ".$_POST["nroescriturapublica"]);
    Core::redir("./?view=protocolocierres");
} else {
    pCore::redir("./?view=protocolocierres");
}
