<?php

/**
 * controlofprocess short summary.
 *
 * controlofprocess description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
Session::currentURL();

?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Listas de control procesos con E.P.</h4>
        <p class="card-category">Se listan los control proceso para una escritura</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
            <a href="./?view=newcontrolofprocess" class="btn btn-default">
                <i class="material-icons">add</i> Nuevo control proceso
            </a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                $result = ChecklistsanswerData::getAllNumRowAnswerToList();
                if (!empty($result)) {
                    ?>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nro. E.P.</th>
                                <th>A&ntilde;o</th>
                                <th>Estado</th>
                                <th>Fecha creaci&oacute;n</th>
                                <th>Lo creo</th>
                                <th>Asignado</th>
                                <th class="disabled-sorting text-right">Opciones</th>
                            </tr>
                        </thead>
                        <?php foreach ($result as $cla) {
                        $user = UserData::getById($cla->user_id);
                        $client = ClientData::getById($cla->client_id);
                        $color= $cla->a_code_approval; ?>

                        <tr data-background-color-approval="<?=($color!="")? 'approval': 'no-approval'; ?>">
                            <td>
                                <?=$cla->numeroescriturapublica; ?>
                            </td>
                            <td>
                                <?=$cla->ep_anho; ?>
                            </td>
                            <td>
                                <?=$cla->a_code_approval; ?>
                            </td>
                            <td>
                                <?=$cla->created_at; ?>
                            </td>
                            <td>
                                <?= $user->name ?>
                            </td>
                            <td>
                                <?= $client->name ?>
                            </td>
                            <td class="text-right">
                                <input type="hidden" name="id" id="id" value="<?=$cla->numeroescriturapublica; ?>" />
                                <a onclick="openWindowsPrint('./?view=printcontrolofprocess&nep=<?=$cla->numeroescriturapublica; ?>&anho=<?=$cla->ep_anho; ?>&idcp=<?=$cla->id; ?>&checklists_id=<?=$cla->checklists_id; ?>')"
                                    data-toggle="tooltip" title="Descargar control proceso"
                                    class="btn btn-link btn-info btn-just-icon btn-sm print">
                                    <i class="material-icons">print</i>
                                </a>
                                <?php
                              $u = UserData::getById(Session::getUID());
                        if ($u->is_admin):
                            ?>
                                <a href="./?view=editcontrolofprocess&nep=<?=$cla->numeroescriturapublica; ?>&anho=<?=$cla->ep_anho; ?>&idcp=<?=$cla->id; ?>&checklists_id=<?=$cla->checklists_id; ?>"
                                    data-toggle="tooltip" title="Editar"
                                    class="btn btn-link btn-warning btn-just-icon btn-sm edit">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="./?view=admindelchecklists&nep=<?=$cla->numeroescriturapublica; ?>&ep_anho=<?=$cla->ep_anho; ?>&checklists_id=<?=$cla->checklists_id; ?>"
                                    data-toggle="tooltip" title="Eliminar"
                                    class="btn btn-link btn-danger btn-just-icon btn-sm remove">
                                    <i class="material-icons">delete</i>
                                </a><?php endif; ?>
                            </td>
                        </tr>
                        <?php
                    } ?>
                    </table>
                </div>
                <?php
                } else {
                    echo "<p class='alert alert-danger'>No hay listas de chequeo creadas.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
            $('#datatables').DataTable({
                " pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                dom: 'lBfrtip',
                buttons: [{
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                }, {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }],
                language: {
                    buttons: {
                        print: 'Imprimir',
                        copy: 'Copiar'
                    },
                    search: "_INPUT_",
                    searchPlaceholder: "Buscar...",
                }
            });
            var table = $('#datatables').DataTable();
            table.order([3, 'desc']).draw();
            $('.card .material-datatables
                    label ').addClass('
                    form - group '); }); function openWindowsPrint($url) { var
                    newWindow = window.open($url, 'Reporte',
                        'width=800,height=700,location=no,menubar=no,scrollbars=no,resizable=no,left=200px'
                    ); //replace with your url newWindow.focus(); //Sets focus window } 
</script>