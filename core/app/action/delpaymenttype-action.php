<?php
PaymentTypeData::delById($_GET["id"]);
Session::msg("d", "Eliminado correctamente.");
//Core::redir("./?view=checklistbcs");