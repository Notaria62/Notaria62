<?php

/**
 * searchnotifications_action short summary.
 *
 * searchnotifications_action description.
 *
 * @version 1.0
 * @author sistemas
 */
if ($_GET["var"]=="notifications") {
    # code...
    $result = NotificationsData::getByRange($_GET['start_at'], $_GET['finish_at']);
if (count($result)>0) {
    # code...
    $ar = array();
    foreach ($result as $value) {
        $u = UserData::getById($value->user_id);
        $us = UserData::getById(Session::getUID());
        $nf = NotariosData::getById($value->notario_id);
        $btnDel = ($us->is_admin)?'<a href="./?action=delcierre&id='.$value->id.'" data-toggle="tooltip" title="Eliminar" class="btn btn-link btn-danger btn-just-icon btn-sm"> <i class="material-icons">delete</i></a>':'';
        $btnEdit ='<a href="./?view=editcierre&id='.$value->id.'" data-toggle="tooltip" title="Editar" class="btn btn-link btn-success btn-just-icon btn-sm"><i class="material-icons">edit</i> </a>';
        $btnDownload = '<a href="report/protocolo-cierres.php?id='.$value->id.'" data-toggle="tooltip" title="Descargar" class="btn btn-link btn-info btn-just-icon btn-sm"><i class="material-icons">cloud_download</i></a>';
        $ar[] = array('nroescriturapublica' => $value->nroescriturapublica,
        'dateescritura'=>$value->dateescritura,
        'numfolios'=>$value->numfolios,
        'destino'=>$value->destino,
        'created_at'=>$value->created_at,
        'usuarioSolicitud'=>$u->name,
        'notario_id'=>$nf->name,
        'options'=>$btnDownload.$btnEdit.$btnDel
        );
    }
    echo json_encode($ar);

}}



if ($_GET["var"]=="prin") {

$view = new NotificationsData();
$view->updateView();
$result =  NotificationsData::getAllLimit();
//$result = mysqli_query($conn, $sql);
$response='';

foreach ($result as $key => $value) {
    # code...
    $fechaOriginal = $value->fecha;
	$fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
	$response = $response . "<a class='dropdown-item' href='#'>" .
	 $value->autor . " - <span>". $fechaFormateada . "</span><span> ". $value->mensaje  . "</span></a>" ;
}

if(!empty($response)) {
	print $response;
}
}



?>
