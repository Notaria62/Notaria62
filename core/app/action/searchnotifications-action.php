<?php

/**
 * searchnotifications_action short summary.
 *
 * searchnotifications_action description.
 *
 * @version 1.0
 * @author sistemas
 */

if ($_POST["var"]=="notifications") {
    # code...
    $result = NotificationsData::getByRange($_POST['start_at'], $_POST['finish_at']);
if (count($result)>0) {
    # code...
    $ar = array();
    foreach ($result as $value) {
        //$u = UserData::getById($value->user_id);
        $us = UserData::getById(Session::getUID());
        //$nf = NotariosData::getById($value->notario_id);
        $btnDel = ($us->is_admin)?'<a href="./?action=delnotification&id='.$value->id.'" data-toggle="tooltip" title="Eliminar" class="btn btn-link btn-danger btn-just-icon btn-sm"> <i class="material-icons">delete</i></a>':'';
        $btnEdit ='<a href="./?view=editnotification&id='.$value->id.'" data-toggle="tooltip" title="Editar" class="btn btn-link btn-success btn-just-icon btn-sm"><i class="material-icons">edit</i> </a>';
        $ar[] = array(
        'id'=>$value->id,
        'mensaje'=>$value->mensaje,
        'autor'=>$value->autor,
        'fecha'=>$value->fecha,
        'options'=>$btnEdit.$btnDel
        );
    }
    echo json_encode($ar);

}}



if ($_POST["var"]=="prin") {

//$view = new NotificationsData();
//$view->updateView();
$result =  NotificationsData::getAllLimit();
//$result = mysqli_query($conn, $sql);
$response='';

foreach ($result as $key => $value) {
    # code...
    $fechaOriginal = $value->fecha;
	$fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
    $response = $response ." <li> <a href='?view=notifications'><div class='col-md-3 col-sm-3 col-xs-3'><div class='notify-img'><img src='http://placehold.it/45x45' alt=''></div></div>".
                    "<div class='col-md-9 col-sm-9 col-xs-9 pd-l0'><strong> ".$value->autor ."</strong> <p>".
                    $value->mensaje ."</p><p class='time'>".$fechaFormateada." </p></div>VER</a></li>";
}

if(!empty($response)) {
	print $response;
}
}



?>
