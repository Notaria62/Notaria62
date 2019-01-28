<?php

/**
 * delprocedure_action short summary.
 *
 * delprocedure_action description.
 *
 * @version 1.0
 * @author sistemas
 */
$proc = ProcedureData::getById($_GET["id"]);
$proc->del();
print "<script>window.location='./?view=notarialprocedure';</script>";