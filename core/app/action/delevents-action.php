<?php

if(!empty($_POST)){
	$ef = new EventosData();
	$ef->title = $_POST["title"];
	$ef->body = $_POST["body"];
	$ef->returned_at = $_POST["returned_at"];
	$ef->start_at = $_POST["start_at"];
	$ef->tipo = $_POST["tipo"];
	$ef->url = $_POST["url"];
	$ef->user_id=$_SESSION["user_id"];
	$ef->id=$_POST["id"];
	$ef->del();
}
//Core::alert("Agregado exitosamente!");
Core::redir("./?view=fechafirma");
?>