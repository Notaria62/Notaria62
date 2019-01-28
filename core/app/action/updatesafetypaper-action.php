<?php

if(count($_POST)>0){
	$paper = SafetyPaperData::getById($_POST["id"]);
	$paper->codsheet = $_POST["codsheet"];
	$paper->ep = $_POST["ep"];
	$paper->user_id=$_SESSION["user_id"];
	$paper->address = $_POST["address"];
	$paper->radicadosnr = $_POST["radicadosnr"];
	$paper->reportdate = $_POST["reportdate"];

	$paper->update();

	Core::alert("Actualizado exitosamente!");
	print "<script>window.location='index.php?view=safetypaper';</script>";


}


?>