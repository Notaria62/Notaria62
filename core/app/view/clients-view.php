<?php Session::currentURL();?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Empleados</h4>
        <p class="card-category">Se listan los usuarios</p>
    </div>
    <?php
?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Lista de empleados</h4>
                </div>
                <div class="card-content table-responsive">
                    <a href="./?view=newclient" class="btn btn-default">
                        <i class='fa fa-male'></i>Nuevo empleado
                    </a>
                    <?php
                $record_per_page = 5;
                $result = ClientData::getAllNumRow();
                //echo " sdsdfsdfs ". $result."---";
                $total_records = count($result);
                $total_pages = ceil($total_records / $record_per_page);
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                $this_page_first_result = ($page - 1) * $record_per_page;
                $users = ClientData::getAllLimitRow($this_page_first_result, $record_per_page);

                //$users = ClientData::getAll();
                if (count($users)>0) {
                    // si hay usuarios?>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nombre completo</th>
                                <th>C.C.</th>
                                <th>Direccion</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php foreach ($users as $user) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $user->name." ".$user->lastname; ?>
                            </td>
                            <td>
                                <?php echo $user->cc; ?>
                            </td>
                            <td>
                                <?php echo $user->address; ?>
                            </td>
                            <td>
                                <?php echo $user->email; ?>
                            </td>
                            <td>
                                <?php echo $user->phone; ?>
                            </td>
                            <td style="width:150px;" class="td-actions">
                                <a href="index.php?view=clienthistory&id=<?php echo $user->id; ?>"
                                    class="btn btn-default btn-xs">Historial</a>
                                <a href="./?view=editclient&id=<?php echo $user->id; ?>" data-toggle="tooltip"
                                    title="Editar" class="btn btn-simple btn-warning btn-xs">
                                    <i class='fa fa-pencil'></i>
                                </a>
                                <?php
                              $u = UserData::getById(Session::getUID());
                        if ($u->is_admin):
                            ?>
                                <a href="./?action=delclient&id=<?php echo $user->id; ?>" data-toggle="tooltip"
                                    title="Eliminar" class=" btn-simple btn btn-danger btn-xs">
                                    <i class='fa fa-remove'></i>
                                </a>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <?php
                    } ?>
                    </table>
                    <div alogin="center">
                        <br />
                        <?php
                    $start_loop = $page;
                    $difference = $total_pages - $page;
                    if ($difference <= 5) {
                        $start_loop = $total_pages - 5;
                    }
                    $end_loop = $start_loop + 5;
                    if ($page == 1) {
                        echo '<ul class="pagination"><li class="disabled"><a href="./?view='.$_GET['view'].'&page=1"><<</a></li>';
                        echo '<li class="disabled"><a href="./?view='.$_GET['view'].'&page='.$page.'"><</a></li>';
                    } else {
                        echo '<ul class="pagination"><li><a href="./?view='.$_GET['view'].'&page=1"><<</a></li>';
                        echo '<li><a href="./?view='.$_GET['view'].'&page='.($page-1).'"><</a></li>';
                    }
                    for ($i=$start_loop; $i<=$end_loop; $i++) {
                        $active ="";
                        if ($i == $_GET['page']) {
                            $active = "active";
                        }
                        echo '<li class="'.$active.'"><a href="./?view='.$_GET['view'].'&page='.$i.'">'.$i.'</a><li>';
                    }
                    // Setting up the Next & Last Button
                    if ($page == $total_pages) {
                        echo'<li class="disabled"><a href="./?view='.$_GET['view'].'&page='.($page-1).'">></a></li>';
                        echo '<li class="disabled"><a href="./?view='.$_GET['view'].'&page='.$number_of_pages.'">>></a></li></ul>';
                    } else {
                        echo'<li><a href="./?view='.$_GET['view'].'&page='.($_GET['page']+1).'">></a></li>';
                        echo '<li><a href="./?view='.$_GET['view'].'&page='.$total_pages.'">>></a></li>';
                    }
                    echo'</ul>'; ?>
                    </div>
                    <div class="form-group">
                        Total registros: <?php echo $total_records?>
                    </div>
                    <br />
                    <br />
                    <?php
                } else {
                    echo "<p class='alert alert-danger'>No hay empleados registrados</p>";
                }
                ?>


                </div>
            </div>
        </div>
    </div>