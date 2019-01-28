<?php

if (count($_POST)>0) {
    $b = new CategoryData();
    $b->name = $_POST["name"];
    $b->add();
    Session::msg("s", "Agregado correctamente.");
    Core::redir("./index.php?view=categories");
}
