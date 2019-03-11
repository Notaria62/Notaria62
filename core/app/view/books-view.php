<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Productos</h4>
        <p class="card-category">Lista de los productos agregados</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <a href="./?view=newbook" class="btn btn-default pull-right">
                <i class="fa fa-book"></i> Nuevo
            </a>
        </div>

        <?php
                $books = BookData::getAll();
                if (count($books)>0) {
                    // si hay usuarios?>
        <table class="table table-bordered table-hover">
            <thead>
                <th>Serial</th>
                <th>T&iacute;tulo</th>
                <th>Tutor</th>
                <th>Ejemplares</th>
                <th>Disponibles</th>
                <th>Categor&iacute;a</th>
                <th></th>
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
                    <?php if ($category!=null) {
                            echo $category->name;
                        } ?>
                </td>
                <td style="width:210px;" class="td-actions">
                    <a href="./?view=items&id=<?php echo $user->id; ?>" class="btn btn-default btn-xs">Ejemplares</a>
                    <a href="./?view=editbook&id=<?php echo $user->id; ?>" data-toggle="tooltip" title="Editar"
                        class="btn btn-simple btn-warning btn-xs">
                        <i class="material-icons">edit</i>
                    </a>
                    <a href="./?view=delbook&id=<?php echo $user->id; ?>" data-toggle="tooltip" title="Eliminar"
                        class="btn btn-simple btn-danger btn-xs">
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