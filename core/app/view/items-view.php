<?php
$book = BookData::getById($_GET["id"]);
?>



<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title"><?php echo $book->title; ?> <small>Ejemplares</small><i class="material-icons">books</i>
        </h4>
        <p class="card-category"></p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card-content table-responsive">
                    <a href="./?view=newitem&book_id=<?php echo $book->id; ?>" class="btn btn-default">
                        <i class="material-icons">add</i> Nuevo Ejemplar
                    </a>
                    <br />
                    <?php
                    $users = ItemData::getAllByBookId($book->id);
                    if (count($users) > 0) {
                        ?>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <th>Codigo</th>
                            <th>Estado</th>
                            <th></th>
                        </thead><?php
                                foreach ($users as $user) {
                                    ?>
                        <tr>
                            <td>
                                <?php echo $user->code; ?>
                            </td>
                            <td>
                                <?php echo $user->getStatus()->name; ?>
                            </td>
                            <td style="width:200px;">
                                <a href="index.php?view=itemhistory&id=<?php echo $user->id; ?>"
                                    class="btn btn-default btn-xs">Historial</a>
                                <a href="index.php?view=edititem&id=<?php echo $user->id; ?>"
                                    class="btn btn-warning btn-xs">Editar</a>
                                <a href="index.php?action=delitem&id=<?php echo $user->id; ?>"
                                    class="btn btn-danger btn-xs">Eliminar</a>
                            </td>
                        </tr><?php
                                } ?>
                    </table><?php
                    } else {
                        echo "<p class='alert alert-danger'>No hay Ejemlpares</p>";
                    }
                        ?>


                </div>
            </div>

        </div>
    </div>
</div>
</div>