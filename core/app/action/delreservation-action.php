<?php
/**
* BookMedik
* @author evilnapsis
**/
$b = ReservationData::getById($_GET["id"]);
$b->del();
print "<script>window.location='index.php?view=reservations';</script>";

?>