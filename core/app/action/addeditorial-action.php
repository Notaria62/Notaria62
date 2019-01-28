<?php

if(count($_POST)>0){
	$b = new EditorialData();
	$b->name = $_POST["name"];
	$b->add();

print "<script>window.location='index.php?view=editorials';</script>";


}


?>