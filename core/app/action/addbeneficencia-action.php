<?php

if (count($_POST)>0) {
    $b = new BeneficenciaData();
    $b->nroescriturapublica = $_POST["nroescriturapublica"];
    $b->anho = $_POST["anho"];
    $b->tipo = $_POST["tipo"];
    //$b->book_id = $_POST["book_id"];
    $b->finished_at= isset($_POST["finished_at"]) ? $_POST["finished_at"] : "0";
    $b->user_id_delivered =  isset($_POST["user_id_delivered"]) ? $_POST["user_id_delivered"] : "0";
    $b->is_delivered =  isset($_POST["is_delivered"]) ? $_POST["is_delivered"] : "0";
    $b->status =  isset($_POST["status"]) ? $_POST["status"] : "0";
    $b->user_id=Session::getUID();
    $b->add();
    Session::msg("s", "Agregado correctamente.");
    Core::redir("./?view=beneficencia");
}