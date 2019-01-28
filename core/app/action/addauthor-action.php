<?php
if (count($_POST)>0) {
    $b = new AuthorData();
    $b->name = $_POST["name"];
    $b->lastname = $_POST["lastname"];
    $b->add();
    Session::msg("s", "Agregado correctamente.");

    print "<script>window.location='./?view=authors';</script>";
}
