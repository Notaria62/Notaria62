<?php

if (count($_POST)>0) {
    $is_dr=0;
    if (isset($_POST["is_dr"])) {
        $is_dr=1;
    }

    $user = ClientData::getById($_POST["id"]);
    $user->name = $_POST["name"];
    $user->lastname = $_POST["lastname"];
    $user->cc = $_POST["cc"];

    $user->address = $_POST["address"];
    $user->email = $_POST["email"];
    $user->phone = $_POST["phone"];
    $user->is_dr = $is_dr;

    $user->update();

    Core::alert("Actualizado exitosamente!");
    print "<script>window.location='./?view=clients';</script>";
}