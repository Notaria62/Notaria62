<?php

if(count($_POST)>0){
	$b = new ItemData();
	$b->code = $_POST["code"];
	$b->book_id = $_POST["book_id"];
	$b->status_id = $_POST["status_id"];
	$b->add();

print "<script>window.location='?view=items&id=$_POST[book_id]';</script>";


}


?>