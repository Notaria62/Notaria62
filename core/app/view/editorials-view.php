<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Empresa <i class="material-icons">import_contacts</i></h4>
        <p class="card-category">Empresas que fabrica o distribuyen los equipos</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
            <a href="index.php?view=newcategory" class="btn btn-default">
                <i class="material-icons">add</i> Category
            </a>
            <a href="index.php?view=neweditorial" class="btn btn-default">
                <i class="material-icons">add</i> Editorial
            </a>
        </div>
        <div class="row">
            <div class="col-md-12">

                <?php
                $users = EditorialData::getAll();
                if (count($users) > 0) {
                    ?>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <th>Nombre</th>
                            <th class="disabled-sorting text-right">Opciones</th>
                        </thead>
                        <?php foreach ($users as $user) : ?>
                        <tr>
                            <td>
                                <?= $user->name; ?>
                            </td>
                            <td class="td-actions">
                                <a href="./?view=editeditorial&id=<?php echo $user->id; ?>" data-toggle="tooltip"
                                    title="Editar" class="btn btn-warning btn-round">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="./?action=deleditorial&id=<?php echo $user->id; ?>" data-toggle="tooltip"
                                    title="Eliminar" class="btn btn-danger btn-round">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    endforeach; ?>
                    </table>
                    <?php
                } else {
                    echo "<p class='alert alert-danger'>No hay Editoriales</p>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>