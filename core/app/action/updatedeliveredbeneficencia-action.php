<?php

/**
 * updatedeliveredbeneficencia_action short summary.
 *
 * updatedeliveredbeneficencia_action description.
 *
 * @version 1.0
 * @author sistemas
 */
if (count($_POST)>0) {
    $b = BeneficenciaData::getById($_POST["id"]);
    $b->is_delivered = (isset($_POST['is_delivered'])) ? 1 : 0;
    $b->user_id_delivered=Session::getUID();
    $b->updateDelivered();
    Session::msg("s", "ha sido entregada el número de escritura: $b->nroescriturapublica del año: $b->anho, satisfactoriamente.");
    Core::redir("./?view=beneficencia");
}
