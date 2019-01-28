<?php

print_r($_GET);

$operation = OperationData::getById($_GET["id"]);
$operation->del();

print "<script>window.location='index.php?view=$_GET[ref]&product_id=$_GET[id]';</script>";
