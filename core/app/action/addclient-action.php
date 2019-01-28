<?php

if(count($_POST)>0){
	$b = new ClientData();
	$b->name = $_POST["name"];
	$b->lastname = $_POST["lastname"];

	$b->address = $_POST["address"];
	$b->email = $_POST["email"];
	$b->phone = $_POST["phone"];
	$b->add();

print "<script>window.location='./?view=clients';</script>";


}


?>