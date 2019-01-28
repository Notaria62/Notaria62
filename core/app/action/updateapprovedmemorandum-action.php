<?php

/**
 * updateapprovedmemorandum short summary.
 *
 * updateapprovedmemorandum description.
 *
 * @version 1.0
 * @author sistemas
 */


//$subcheck = (isset($_POST['is_approved'])) ? 1 : 0;
//echo $subcheck;
//echo $_POST["id"];
if(count($_POST)>0){
    $b = MemorandumData::getById($_POST["id"]);
    $b->is_approved  = (isset($_POST['is_approved'])) ? 1 : 0;
    //echo $_POST["is_approved"];
    $b->updateApproved();
    Core::alert("Actualizado exitosamente!");
    print "<script>window.location='./?view=memorandumcreated';</script>";
}