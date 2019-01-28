<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Grupos</h4>
        <p class="card-category">Se encuentran los grupos del sistema</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
            <a href="./?view=newgroup" class="btn btn-default">
                <i class="material-icons">add</i> Nuevo grupo
            </a>
        </div>
        <hr />
        <?php
                $result = UserGroupsData::getAllNumRow();
                if (count($result) > 0) {
                    ?>
        <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                style="width:100%">
                <thead>
                    <th>#</th>
                    <th>Nombre del grupo</th>
                    <th>Nivel del grupo</th>
                    <th>estado</th>
                    <th class="disabled-sorting text-right">Opciones</th>
                </thead>
                <?php foreach ($result as $g) : ?>
                <tr>
                    <td>
                        <?= $g->id; ?>
                    </td>
                    <td>
                        <?= $g->group_name; ?>
                    </td>
                    <td>
                        <?= $g->group_level; ?>
                    </td>
                    <td>
                        <?php if ($g->group_status === '1'): ?>
                        <span class="label label-success"><?php echo "Activo"; ?></span>
                        <?php else: ?>
                        <span class="label label-danger"><?php echo "Inactivo"; ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="text-right">
                        <a href="./?view=editgroup&id=<?= $g->id; ?>"
                            class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                <?php
                    endforeach; ?>
            </table>
        </div>
        <?php
                } else {
                    echo "<p class='alert alert-danger'>No hay usuarios creados.</p>";
                }
                ?>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Buscar...",
            }
        });
        var table = $('#datatables').DataTable();
        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');
            var data = table.row($tr).data();
            //alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });
        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });
        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });
        $('.card .material-datatables label').addClass('form-group');
    });
</script>