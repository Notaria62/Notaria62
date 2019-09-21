<?php
/**
* searchchecklistbcs short summary.
*
* searchchecklistbcs description.
*
* @version 1.0
* @author DigitalesWeb
*/
$result = ChecklistsanswerData::getAllNumRowAnswerToListByRange($_GET['start_at'], $_GET['finish_at']);
if (count($result)>0) {
    $ar = array();
    foreach ($result as $value) {
        $u = UserData::getById($value->user_id);
        $client = ClientData::getById($value->client_id);

        $us = UserData::getById(Session::getUID());
        $delUrl = "admindelchecklists";
        $onclick = "onclick='md.showSwal(\"warning-message-and-confirmation-delete\",\"".$value->id."\", \"".$delUrl."\")'";
        $btnEdit = ($us->user_level == 1 || $us->user_level == 20)?'<a href="./?view=editcontrolofprocess&nep='.$value->numeroescriturapublica.'&anho='.$value->ep_anho.'&idcp='.$value->id.'&checklists_id='.$value->checklists_id.'" data-toggle="tooltip" title="Editar" class="btn btn-link btn-success btn-just-icon btn-sm"><i class="material-icons">edit</i> </a>':'';
        $btnView = ($us->user_level)?'<a href="./?view=viewcontrolofprocess&nep='.$value->numeroescriturapublica.'&anho='.$value->ep_anho.'&idcp='.$value->id.'&checklists_id='.$value->checklists_id.'" data-toggle="tooltip" title="Ver lista" class="btn btn-link btn-success btn-just-icon btn-sm"><i class="material-icons">visibility</i> </a>':'';
        $btnDel = ($us->user_level == 1 || $us->user_level == 20)?'<a href="./?action=admindelchecklists&checklists_id='.$value->checklists_id.'&nep='.$value->numeroescriturapublica.'&ep_anho='.$value->ep_anho.'" data-toggle="tooltip" title="Eliminar" class="btn btn-link btn-danger btn-just-icon btn-sm"> <i class="material-icons">delete</i></a>':'';
        $btnPrint =($us->user_level)? '<a onclick="openWindowsPrint(\'./?view=printcontrolofprocess&nep='.$value->numeroescriturapublica.'&anho='.$value->ep_anho.'&idcp='.$value->id.'&checklists_id='.$value->checklists_id.'\')"
                     data-toggle="tooltip" title="Imprimir lista de chequeo" class="btn btn-link btn-info btn-just-icon btn-sm"><i class="material-icons">print</i> </a> <input type="hidden" name="id" id="id" value="'.$value->numeroescriturapublica.'" />':'';
        $modal = ' <!-- Classic Modal -->
                        <div class="modal fade" id="myModal-'.$value->id.'"
                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Observación de la escritura publica : <b>'.$value->numeroescriturapublica.'</b></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <i class="material-icons">clear</i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="./?action=addobservationchecklistcp" method="post">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="observation" class="bmd-label-floating">Observaciones</label>
                                                        <textarea name="observation" id="observation" class="form-control"
                                                            rows="3" cols="20" required>'.$value->observation.'</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-round">Enviar
                                                observaciones</button>
                                            <input type="hidden" name="id" id="id" value="'.$value->id.'" />
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  End Modal --> ';
        $btnModal = ($us->user_level == 1 || $us->user_level == 20)?'<a href="" data-toggle="modal" data-target="#myModal-'.$value->id.'" data-toggle="tooltip" title="Agregar observaciones" class="btn btn-link btn-danger btn-just-icon btn-sm"><i class="material-icons">report_problem</i></a>':'';
        $ar[] = array('numeroescriturapublica' => $value->observation!= "" ? $value->numeroescriturapublica .'<a data-toggle="tooltip" title="'.$value->observation.'" class="btn btn-link btn-warning btn-just-icon btn-sm"><i class="material-icons">comment</i></a>':$value->numeroescriturapublica ,
        'ep_anho'=>$value->ep_anho,
        'code_approval'=>$value->a_code_approval,
        'created_at'=>$value->created_at,
        'usuarioSolicitud'=>$u->name,
        'asignado'=>"$client->name".$modal,
        'options'=>$btnView.$btnPrint.$btnEdit.$btnDel.$btnModal
        );
    }
    echo json_encode($ar);
}