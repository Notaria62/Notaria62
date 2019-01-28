<?php Session::currentURL();?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Usuarios del sistema</h4>
        <p class="card-category">Se encuentran los usuarios del sistema</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
            <a href="./?view=newuser" class="btn btn-default">
                <i class="material-icons">add</i> Nuevo Usuario
            </a>
        </div>
        <hr />
        <?php
                $result = UserData::find_all_user();
                if (count($result) > 0) {
                    ?>
        <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                width="100%" style="width:100%">
                <thead>
                    <th>Nombre completo</th>
                    <th>Rol de usuario</th>
                    <th>Email</th>
                    <th>Nick</th>
                    <th>Estado</th>
                    <th>Ultimo login</th>
                    <th class="disabled-sorting text-right">Opciones</th>
                </thead>
                <?php foreach ($result as $user) :
                
                   ?>
                <tr>
                    <td>
                        <?= $user->name." ".$user->lastname; ?>
                    </td>
                    <td>
                        <?= $user->group_name; ?>
                    </td>
                    <td>
                        <?=$user->email; ?>
                    </td>
                    <td>
                        <?= $user->username; ?>
                    </td>
                    <td>
                        <?php if ($user->is_active):?>
                        <i class="fa fa-check"></i>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?=$user->last_login; ?>

                    </td>
                    <td class="text-right">
                        <a href="./?view=edituser&id=<?= $user->id; ?>"
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