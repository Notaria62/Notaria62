<?php

if (count($_POST)>0) {
    $user = new ClientData();
    $user->name = $_POST["name"];
    $user->lastname = $_POST["lastname"];
    $user->cc = $_POST["cc"];
    $user->email = $_POST["email"];
    $user->address = $_POST["address"];
    $user->phone = $_POST["phone"];
    $user->is_dr = isset($_POST["is_dr"]) ? "1" : "0";
    $user->add();
    Session::msg("s", "Agregado correctamente.");

    print "<script>window.location='./?view=clients';</script>";
}
