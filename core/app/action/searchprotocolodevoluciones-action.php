<?php

/**
 * searchescrituras_action short summary.
 *
 * searchescrituras_action description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
//if(count($_POST)>0){
$result = ProtocoloDevolucionesData::getByRange($_GET['start_at'], $_GET['finish_at']);
//print_r($result);
if (count($result) > 0) {
    //echo "paso";
    # code...
    $ar = array();
    foreach ($result as $value) {
        //$u = UserData::getById($value->user_id);
        //$us = UserData::getById(Session::getUID());
        $btnDownload = '<input type="hidden" name="id" id="id" value="' . $value->id . '" /> <a href="report/protocolo-devoluciones.php?id=' . $value->id . '" data-toggle="tooltip" title="Descargar" class="btn btn-link btn-success btn-just-icon btn-sm"> <i class="material-icons">cloud_download</i> </a> ';
        $btnEmail =  '<a href="./?action=sendemailprotocolodevoluciones&id=' . $value->id . '" data-toggle="tooltip" title="Enviar" class="btn btn-link btn-warning btn-just-icon btn-sm"><i class="material-icons">email</i> </a> ';
        $ar[] = array(
            'escritura_anho' => $value->escritura_anho,
            'acta' => $value->acta,
            'depositante' => $value->depositante,
            'email' => $value->email,
            'status' => $value->status,
            'created_at' => $value->created_at,
            'options' => $btnDownload . $btnEmail
        );
    }
    //print_r(json_encode($ar));

    echo json_encode($ar);
}