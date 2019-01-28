<?php

/**
 * delmemorandum short summary.
 *
 * delmemorandum description.
 *
 * @version 1.0
 * @author sistemas
 */
$m = MemorandumData::getById($_GET["id"]);
$m->del();
