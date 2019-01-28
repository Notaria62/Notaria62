<?php

if(count($_POST)>0){
	$paper = new SafetyPaperData();
	$paper->codsheet = $_POST["codsheet"];
	$paper->ep = $_POST["ep"];
	$paper->user_id=$_SESSION["user_id"];
	$paper->address = $_POST["address"];
	$paper->radicadosnr = $_POST["radicadosnr"];
	$paper->reportdate = $_POST["reportdate"];
	$paper->add();

print "<script>window.location='index.php?view=safetypaper';</script>";


}


?>