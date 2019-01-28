<?php

/**
 * pushbeneficencia_action short summary.
 *
 * pushbeneficencia_action description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */

$benefiCreated = BeneficenciaData::getAllNotDelivered();
$numShow = count($benefiCreated);
$count=0;

if (isset($_POST['view'])) {
    if (count($benefiCreated)>0) {
        # code...
        $ar = array();
        $count= BeneficenciaData::getAllStatusDelivered();
        foreach ($benefiCreated as $value) {
            $u = UserData::getById($value->user_id);
            if ($_POST["view"] != '') {
                # code...
                $us = new BeneficenciaData();
                $us->id = $value->id;
                $us->updateStatus();
            }
            if ($value->is_delivered == 0) {
                $ar[] = ['nroescriturapublica' => $value->nroescriturapublica,
                    'anho'=>$value->anho,
                    'usuarioSolicitud'=>$u->name,
                    'unseen_notification'=> count($count)
                ];
            }
        }
        $dato_json   = json_encode($ar);
        echo $dato_json;
    }
}
