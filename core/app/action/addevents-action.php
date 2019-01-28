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
//$r->category_id = $_POST["category_id"]!="" ? $_POST["category_id"] : "NULL";
//$r->editorial_id = $_POST["editorial_id"]!="" ? $_POST["editorial_id"] : "NULL";
//$r->author_id = $_POST["author_id"]!="" ? $_POST["author_id"] : "NULL";
	$ef->add();
}
//Core::alert("Agregado exitosamente!");
Core::redir("./index.php?view=fechafirma");
?>
