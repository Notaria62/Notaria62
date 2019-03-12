<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Productos</h4>
        <p class="card-category">Lista de los productos agregados</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
            <a href="./?view=newbook" class="btn btn-default">
                <i class="material-icons">add</i> Product
            </a>
        </div>

        <?php
        $books = BookData::getAll();
        if (count($books) > 0) {
            ?>
        <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                width="100%" style="width:100%">
                <thead>
                    <th>Serial</th>
                    <th>T&iacute;tulo</th>
                    <th>Tutor</th>
                    <th>Ejemplares</th>
                    <th>Disponibles</th>
                    <th>Categor&iacute;a</th>
                    <th class="disabled-sorting text-right">Opciones</th>
                </thead>
                <?php
                foreach ($books as $user) {
                    $category  = $user->getCategory(); ?>
                <tr>
                    <td>
                        <?php echo $user->isbn; ?>
                    </td>
                    <td>
                        <?php echo $user->title; ?>
                    </td>
                    <td>
                        <?php echo $user->subtitle; ?>
                    </td>
                    <td>
                        <?php echo ItemData::countByBookId($user->id)->c; ?>
                    </td>
                    <td>
                        <?php echo ItemData::countAvaiableByBookId($user->id)->c; ?>
                    </td>
                    <td>
                        <?php if ($category != null) {
                        echo $category->name;
                    } ?>
                    </td>
                    <td style="width:210px;" class="td-actions">
                        <a href="./?view=items&id=<?php echo $user->id; ?>"
                            class="btn btn-default btn-xs">Ejemplares</a>
                        <a href="./?view=editbook&id=<?php echo $user->id; ?>" data-toggle="tooltip" title="Editar"
                            class="btn btn-warning btn-round">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="./?view=delbook&id=<?php echo $user->id; ?>" data-toggle="tooltip" title="Eliminar"
                            class="btn btn-danger btn-round">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
                <?php
                } ?>
            </table>
            <?php
        } else {
            echo "<p class='alert alert-danger'>No hay productos</p>";
        }
        ?>
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