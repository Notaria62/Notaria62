<?php

$vigen = VigenciasData::getById($_GET["id"]);
$vigen->del();
Core::redir("./index.php?view=protocolovigencias");