<?php
ChecklistsanswerData::delBy($_GET['nep'], $_GET['ep_anho'], $_GET['checklists_id']);
Session::msg("s", "Borrador correctamente...");
Core::redir("./?view=controlofprocess");