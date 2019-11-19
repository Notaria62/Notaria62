<?php

/**
 *  short summary.
 *
 *  description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
//if(count($_POST)>0){
$result = VigenciasData::getByRange($_GET['start_at'], $_GET['finish_at']);
if (!empty($result)) {
    # code...
    $ar = array();

    foreach ($result as $value) {
        $u = UserData::getById($value->user_id);
        $us = UserData::getById(Session::getUID());
        $nf = NotariosData::getById($value->notario_id);
        $btnDel = ($us->is_admin) ? '<a href="./?view=delvigencias&id=' . $value->id . '" data-toggle="tooltip" title="Eliminar" class="btn btn-link btn-danger btn-just-icon btn-sm"> <i class="material-icons">delete</i></a>' : '';
        $btnEdit = '<a href="./?view=editvigencias&id=' . $value->id . '" data-toggle="tooltip" title="Editar" class="btn btn-link btn-success btn-just-icon btn-sm"><i class="material-icons">edit</i> </a>';
        $btnDownload = '<a href="report/protocolo-vigencias.php?id=' . $value->id . '" data-toggle="tooltip" title="Descargar" class="btn btn-link btn-info btn-just-icon btn-sm"><i class="material-icons">cloud_download</i></a>';
        $tbnClone = '<a href="./?view=newclonvigencias&id=' . $value->id . '" data-toggle="tooltip" title="Clonar" class="btn btn-link btn-warning btn-just-icon btn-sm"><i class="material-icons">toll</i> </a>';
        $poderdante_ids = $value->poderdante_ids;
        $p_ids = explode("-", $poderdante_ids);
        $apoderado_ids = $value->apoderado_ids;
        $ap_ids = explode("-", $apoderado_ids);
        $fullnamep = "";
        foreach ($p_ids as $key => $v) {
            # code...
            $cs = ClientesignoData::getById($v);
            $fullnamep .= $cs->name . " " . $cs->lastname . "; ";
        }
        $fullnameap = "";
        foreach ($ap_ids as $key => $j) {
            # code...
            $cs = ClientesignoData::getById($j);
            $fullnameap .= $cs->name . " " . $cs->lastname . "; ";
        }

        $ar[] = array(
            'consecutivo' => $value->consecutivo, 'nroescriturapublica' => $value->nroescriturapublica,
            'dateescritura' => $value->dateescritura,
            'poderdante' => substr_replace($fullnamep, "", -2),
            'apoderado' => substr_replace($fullnameap, "", -2),
            'created_at' => $value->created_at,
            'usuarioSolicitud' => $u->name,
            'notario_id' => $nf->name,
            'options' => $btnDownload . $btnEdit . $btnDel . $tbnClone
        );
    }
    echo json_encode($ar);
}