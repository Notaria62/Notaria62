<?php

/**
 * addmemorandum_action short summary.
 *
 * addmemorandum_action description.
 *
 * @version 1.0
 * @author sistemas
 */
//echo "paso ". count($_POST);
//echo isset($_POST["identificacion3"]);
//echo isset($_POST["identificacion4"]);
if(count($_POST)>0){
	$memo = MemorandumData::getById($_POST["id"]);
    $memo->observation = $_POST["observation"];
    $memo->user_id=Session::getUID();
	$memo->updateObservation();
   print "<script>window.location='./?view=memorandumcreated';</script>";
}
