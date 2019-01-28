
<?php

/**
 * delchecklist short summary.
 *
 * delchecklist description.
 *
 * @version 1.0
 * @author sistemas
 */
$cl = ChecklistsData::getById($_GET["id"]);
$cl->del();
print "<script>window.location='./?view=adminchecklists';</script>";