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
$result = MemorandumData::getByRange($_GET['start_at'], $_GET['finish_at']);
if (count($result)>0) {
    $ar = array();
    foreach ($result as $value) {
        $u = UserData::getById(Session::getUID());
        $up = UserGroupsData::getById($u->user_level);
        $us = UserData::getById(Session::getUID());
        $nameDigitador=DigitadoresData::getById($value->digitador_id);
        $templ = TemplateMemorandumData::getById($value->templatememo_id);
        $delUrl = "delmemorandum";
        $onclick = "onclick='md.showSwal(\"warning-message-and-confirmation-delete\",\"".$value->id."\", \"".$delUrl."\")'";
        $is_approved = ($value->is_approved == "1") ? 'checked': '';
        $btnDel = ($us->is_admin)?'<a '.$onclick.' data-toggle="tooltip" title="Eliminar" class="btn btn-link btn-danger btn-just-icon btn-sm"> <i class="material-icons">delete</i></a>':'';
        $btnEdit ='<a href="./?view=editmemorandum&id='.$value->id.'" data-toggle="tooltip" title="Editar" class="btn btn-link btn-success btn-just-icon btn-sm"><i class="material-icons">edit</i> </a>';
        $modal = ' <!-- Classic Modal -->
                        <div class="modal fade" id="myModal-'.$value->id.'"
                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Observación del
                                            radicado : <b>'.$value->radicado.'</b></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <i class="material-icons">clear</i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="./?action=addobservationmemorandum" method="post">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="" class="bmd-label-floating">Observaciones</label>
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
        $btnModal = '<a href="" data-toggle="modal" data-target="#myModal-'.$value->id.'" data-toggle="tooltip" title="Agregar observaciones" class="btn btn-link btn-danger btn-just-icon btn-sm"><i class="material-icons">report_problem</i></a>';
        $btnDownload = '<input type="hidden" name="id" id="id" value="'.$value->id.'" /> <a href="report/cancelacion-hipoteca.php?id='.$value->id.'&templatememo_id='.$value->templatememo_id.'" data-toggle="tooltip" title="Descargar minuta" class="btn btn-link btn-success btn-just-icon btn-sm"> <i class="material-icons">cloud_download</i> </a> ';
        $btnApprovalDownload = ($value->is_approved == "1")?'<a href="report/cancelacion-hipoteca.php?id='.$value->id.'&templatememo_id='.$value->templatememo_id.'" data-toggle="tooltip" title="Descargar minuta" class="btn btn-link btn-info btn-just-icon btn-sm"> <i class="material-icons">cloud_download</i> </a> ':'';
        $ar[] = array('radicado' => $value->observation!= "" ? $value->radicado .'<a data-toggle="tooltip" title="'.$value->observation.'" class="btn btn-link btn-warning btn-just-icon btn-sm"><i class="material-icons">comment</i></a>':$value->radicado ,
        'numerocertificado'=>$value->numerocertificado,
        'numeroescriturapublica'=>$value->numeroescriturapublica,
        'created_at'=>$value->created_at.$modal,
        'is_approved'=>($value->is_approved == "1") ? "Aprobado": "No aprobado",
        'approvals'=>'<form action="./?action=updateapprovedmemorandum" method="post"><input class="" type="checkbox" name="is_approved" id="is_approved" value="0" '.$is_approved.' ><button type="submit" data-toggle="tooltip" title="Actualizar" class="btn btn-link btn-info btn-just-icon btn-sm"><i class="material-icons">thumb_up_alt</i></button><input type="hidden" name="id" id="id" value="'.$value->id.'" /> '.$btnModal.$btnDownload.'</form>',
        'options'=>$btnApprovalDownload.$btnEdit.$btnDel
        );
    }
    echo json_encode($ar);
}