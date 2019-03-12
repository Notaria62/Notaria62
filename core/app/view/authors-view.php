<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Creadores o fabricantes <i class="material-icons">import_contacts</i></h4>
        <p class="card-category"></p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
            <a href="./?view=newcategory" class="btn btn-default">
                <i class="material-icons">add</i> Categoria
            </a>
            <a href="./?view=newauthor" class="btn btn-default">
                <i class="material-icons">add</i> Autor
            </a>
        </div>

        <div class="row">
            <div class="col-md-12">

                <?php
                $users = AuthorData::getAll();
                if (count($users) > 0) {
                    ?>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <th>Nombre</th>
                            <th class="disabled-sorting text-right">Opciones</th>
                        </thead><?php
                                foreach ($users as $user) {
                                    ?>
                        <tr>
                            <td><?php echo $user->name . " " . $user->lastname; ?>
                            </td>
                            <td class="td-actions">
                                <a href="./?view=editauthor&id=<?php echo $user->id; ?>" data-toggle="tooltip"
                                    title="Editar" class="btn btn-warning btn-round"><i
                                        class="material-icons">edit</i></a>
                                <a href="./?action=delauthor&id=<?php echo $user->id; ?>" data-toggle="tooltip"
                                    title="Eliminar" class="btn btn-danger btn-round">
                                    <i class="material-icons">delete</i>
                            </td>
                        </tr>
                        <?php
                                } ?>
                    </table>
                    <?php
                } else {
                    echo "<p class='alert alert-danger'>No hay Autores</p>";
                }
                ?>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#datatables').DataTable({
        "pagingType": "full_numbers",
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
</script>