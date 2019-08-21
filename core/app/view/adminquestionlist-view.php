<!--/**
 * ChecklistsquestionsData short summary.
 *
 * ChecklistsquestionsData description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */-->
<?php


 if (isset($_GET['checklist'])) {
     $checklists_id = $_GET['checklist'];
 } else {
     $checklists_id=0;
 }
?>


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Lista las preguntas</h4>
        <p class="card-category">Se listan las preguntas de cada lista de chequeo</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->

            <a href="./?view=adminchecklists" class="btn btn-default">
                <i class="material-icons">view_list</i> Ver lista de control maestro
            </a>
            <a href="./?view=admincreatechecklist" class="btn btn-default">
                <i class="material-icons">add</i> Crear control maestro
            </a>
            <a href="./?view=adminaddquestiontolist" class="btn btn-default">
                <i class="material-icons">library_add</i> Agregar pregunta
            </a>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group bmd-form-group is-filled">
                    <label for="ddllists" class="bmd-label-floating">Elija lista de control proceso</label>
                    <select id="ddllists" name="ddllists" class="custom-select"
                        onchange="location = this.options[this.selectedIndex].value;" required>
                        <option value="/?view=adminquestionlist&checklist=0">--- SELECCIONE ---</option>
                        <?php foreach (ChecklistsData::getAll() as $list):?>
                        <option value="/?view=adminquestionlist&checklist=<?=$list->id; ?>" <?=($list->id ==
                            $checklists_id) ?
                            "selected":"";?>>
                            <?=$list->name.": ".$list->description; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">


                <?php
                $result = ChecklistsquestionData::getAllNumRowQuestionToList($checklists_id);
                if (count($result) > 0) {
                    ?>

                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>

                                <th>Posici&oacute;n</th>
                                <th>Pregunta</th>
                                <th>Descricion</th>
                                <th>Tipo proceso</th>
                                <th>Fecha creacion</th>
                                <th>Usuario</th>
                                <th class="disabled-sorting text-right">Opciones</th>

                            </tr>
                        </thead>
                        <tbody class="row_position">
                            <?php foreach ($result as $cq) {
                        $user = UserData::getById($cq->user_id);
                        $color= $cq->q_status; ?>
                            <tr data-background-color-approval="<?=($color==" off")? 'no-approval' : '' ; ?>"
                                id="<?=$cq->id; ?>" style="cursor:move">

                                <td>
                                    <?=$cq->position; ?>
                                </td>
                                <td>
                                    <?php $question = $cq->question;
                        echo substr($question, 0, 100);
                        echo ($question !="")?"...":""; ?>
                                </td>
                                <td>
                                    <?=substr($cq->description, 0, 50);
                        echo ($cq->description !="")?"...":""; ?>
                                </td>
                                <td>
                                    <?=$cq->checklists_id; ?>
                                </td>
                                <td>
                                    <?=$cq->created_at; ?>
                                </td>
                                <td>
                                    <?= $user->name ?>
                                </td>
                                <td style="width:150px;" class="td-actions">
                                    <a href="./?view=admineditquestiontolist&id=<?=$cq->id; ?>&checklist=<?=$cq->checklists_id; ?>"
                                        data-toggle="tooltip" title="Editar"
                                        class="btn btn-link btn-success btn-just-icon btn-sm">
                                        <i class="material-icons">edit</i>
                                    </a> |
                                    <a href="./?view=adminaddquestiontolistclone&id=<?=$cq->id; ?>"
                                        data-toggle="tooltip" title="Clonar pregunta"
                                        class="btn btn-link btn-warning btn-just-icon btn-sm">
                                        <i class="material-icons">toll</i>
                                    </a> |
                                    <?php
                              $u = UserData::getById(Session::getUID());
                        if ($u->is_admin):
                            ?>
                                    <a href="./?action=delquestionchecklist&id=<?=$cq->id; ?>" data-toggle="tooltip"
                                        title="Eliminar" class="btn btn-link btn-danger btn-just-icon btn-sm">
                                        <i class="material-icons">delete</i>
                                    </a>
                                    <?php endif; ?>

                                </td>

                            </tr>
                            <?php
                    } ?>
                        </tbody>
                    </table>


                    <br />
                    <br />
                    <?php
                } else {
                    echo "<p class='alert alert-danger'>No hay preguntas en la listas de control de proceso seleccionada.</p>";
                }
                ?>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="themes/notaria62web/js/plugins/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#datatables').DataTable({
        "paging": true,
        "ordering": true,
        "info": false,
        "order": [
            [0, "asc"]
        ],
        "columnDefs": [{
            className: "text-right",
            "targets": [6]
        }],
        "processing": true,
        "pagingType": "full_numbers",
        "lengthMenu": [
            [-1, 10, 20],
            ["All", 5, 10, 20]
        ],
        responsive: true,
        dom: 'lBfrtip',
        buttons: [{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ],
        language: {
            buttons: {
                print: 'Imprimir'
            },
            search: "_INPUT_",
            searchPlaceholder: "Buscar...",
        }
    });
    $('.card .material-datatables label').addClass('form-group');
});


$(".row_position").sortable({
    delay: 150,
    stop: function() {
        var selectedData = new Array();
        $('.row_position>tr').each(function() {
            selectedData.push($(this).attr("id"));
        });
        updateOrder(selectedData);

    }

});


function updateOrder(data) {
    $.ajax({
        url: "./?action=updatechecklistquestionsorting",
        type: 'post',
        data: {
            position: data,
            checklist_id: <?=$checklists_id?>
        },
        success: function() {
            alert('Posición guardada correctamente.');
            document.location.href = "/?view=" +
                "<?=$_GET['view']?>" +
                "&checklist=" +
                "<?=$_GET['checklist']?>";
        }

    });
}
</script>