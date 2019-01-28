<?php

$client = CategoryMenuData::getById($_GET["id"]);
CategoryMenuData::delById_usergroups_categorias($_GET['id']);

$client->del();
Session::msg("s", "Borrador correctamente...");
//Core::redir("./?view=admincategorymenu");