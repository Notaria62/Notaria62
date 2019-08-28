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
        $btnDel = ($us->is_admin)?'<a href="./?view=delvigencias&id='.$value->id.'" data-toggle="tooltip" title="Eliminar" class="btn btn-link btn-danger btn-just-icon btn-sm"> <i class="material-icons">delete</i></a>':'';
        $btnEdit ='<a href="./?view=editvigencias&id='.$value->id.'" data-toggle="tooltip" title="Editar" class="btn btn-link btn-success btn-just-icon btn-sm"><i class="material-icons">edit</i> </a>';
        $btnDownload = '<a href="report/protocolo-vigencias.php?id='.$value->id.'" data-toggle="tooltip" title="Descargar" class="btn btn-link btn-info btn-just-icon btn-sm"><i class="material-icons">cloud_download</i></a>';
        $ar[] = array('nroescriturapublica' => $value->nroescriturapublica,
        'dateescritura'=>$value->dateescritura,
        'poderdante'=>$value->poderdantename,
        'apoderado'=>$value->apoderadoname,
        'created_at'=>$value->created_at,
        'usuarioSolicitud'=>$u->name,
        'notario_id'=>$nf->name,
        'options'=>$btnDownload.$btnEdit.$btnDel
        );
    }
    echo json_encode($ar);
}
