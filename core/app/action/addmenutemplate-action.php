<?php
if (count($_POST)>0) {
    $c = new TemplateMemorandumData();
    $c->name = $_POST["nametemplate"];
    $c->description = $_POST["descriptiontemplate"]!="" ? $_POST["descriptiontemplate"] : "";
    $c->type = $_POST["type"]!="" ? $_POST["type"] : "0";
    $c->container = $_POST["ddlmemorandum"]!="" ? $_POST["ddlmemorandum"] : "";
    $c->add();
    Session::msg("s", "Agregado correctamente. La opción en el menú: ".$_POST["ddlmemorandum"]);
    Core::redir("./?view=admintemplates");
} else {
    Core::redir("./?view=admintemplates");
}