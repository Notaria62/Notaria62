<?php
/**
* BookMedik
* @author evilnapsis
**/

if (count($_POST)>0) {
    $user = new CategoryData();
    $user->name = $_POST["name"];
    $user->add();
    Session::msg("s", "Agregado correctamente.");

    print "<script>window.location='./?view=categories';</script>";
}
