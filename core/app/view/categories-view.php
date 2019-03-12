<?php
/**
 * categories short summary.
 *
 * categories description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
Session::currentURL();

$result = CategoryData::getAll();
?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Categorias</h4>
        <p class="card-category">Se listan las categorias de productos de prestamos</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
            <a href="index.php?view=newcategory" class="btn btn-default">
                <i class="material-icons">add</i> Nueva Categoria
            </a>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php if (count($result) > 0) : ?>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <th>Id categoria</th>
                            <th>Nombre de categoria</th>
                            <th class="disabled-sorting text-right">Opciones</th>

                        </thead>
                        <?php foreach ($result as $ca) : ?>

                        <tr>
                            <td><?= $ca->id; ?>
                            </td>
                            <td><?= $ca->name; ?>
                            </td>
                            <td><a href="./?view=editcategory&id=<?php echo $ca->id; ?>" data-toggle="tooltip"
                                    title="Editar" class="btn btn-link btn-success btn-just-icon btn-sm">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="index.php?view=delcategory&id=<?php echo $ca->id; ?>" data-toggle="tooltip"
                                    title="Eliminar" class="btn btn-link btn-danger btn-just-icon btn-sm">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php
        else :
            echo "<P class='alert alert-danger'>No hay categorias creadas.</p>";
        endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#datatables').DataTable({
        "columnDefs": [{
            className: "text-right",
            "targets": [2]
        }],
        "pagingType": "full_numbers",
        "lengthMenu": [
            [5, 10, 20, -1],
            [5, 10, 20, "All"]
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Buscar...",
        }

    });
});

$('.card .material-datatables label').addClass('form-group');
</script>