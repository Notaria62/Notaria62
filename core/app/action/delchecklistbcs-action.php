<?php

/**
 * delchecklistbcs short summary.
 *
 * delchecklistbcs description.
 *
 * @version 1.0
 * @author sistemas
 */
ChecklistsanswerBCSData::delBy($_GET["cid"], $_GET["ep"], $_GET["nr"]);
Session::msg("d", "Eliminado correctamente.");
Core::redir("./?view=checklistbcs");
