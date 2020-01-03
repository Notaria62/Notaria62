<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Consulta de Tramites</h4>
        <p class="card-category">Se listan las consultas de los tramites</p>
    </div>
    

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">
                    Procesos notariales
                </h4>
            </div>
            <div class="card-content table-responsive">

                <a href="./?view=newprocedure" class="btn btn-default">
                    <i class='fa fa-newspaper-o'></i>
                    Nuevo proceso
                </a>
                <a href="./?view=uploadprocedure" class="btn btn-default">
                    <i class='fa fa-upload'></i>Cargar masiva
                </a>
                <div class="btn-group pull-left">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-download"></i>Descargar
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="report/clients-word.php">Word 2007 (.docx)</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form class="navbar-form navbar-right" accept-charset="utf-8" method="POST">
                            <div class="form-group  is-empty">
                                <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Búscar" maxlength="9" autocomplete="off" onkeyup="buscar();" />
                                <span class="material-input"></span>
                                <i class="material-icons">search</i>
                            </div>
                        </form>
                        <div id="resultadoBusqueda"></div>

                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#resultadoBusqueda").html();
                            });
                            function buscar() {
                                var textoBusqueda = $("input#busqueda").val();

                                if (textoBusqueda != "") {
                                    $.post("./?action=searchnotarialprocedure", { valorBusqueda: textoBusqueda }, function (message) {
                                        $("#resultadoBusqueda").html(message);
                                    });
                                } else {
                                    $("#resultadoBusqueda").html();
                                };
                            };
                        </script>
                    </div>
                </div>
                <?php
                $record_per_page = 5;
                $result = ProcedureData::getAllNumRow();
                //echo " sdsdfsdfs ". $result."---";
                $total_records = count($result);
                $total_pages = ceil($total_records / $record_per_page);
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                if (!isset($number_of_pages)) {
                    $number_of_pages = 1;
                }

                $this_page_first_result = ($page - 1) * $record_per_page;
                $procedures = ProcedureData::getAllLimitRow($this_page_first_result, $record_per_page);
                if (count($procedures) > 0) {
                    ?>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Radicado</th>
                            <th>Escritura</th>
                            <th>Email</th>
                            <th>Año</th>
                            <th>Cedula de identidad</th>
                            <th>Estatus</th>
                            <th>Usuario ultima actualizaci&oacute;n</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($procedures as $procedure) {
                        ?>
                    <tr>
                        <td>
                            <?php echo $procedure->radicado; ?>
                        </td>
                        <td>
                            <?php echo $procedure->escritura; ?>
                        </td>
                        <td>
                            <?php echo $procedure->email; ?>
                        </td>
                        <td>
                            <?php echo $procedure->anho; ?>
                        </td>
                        <td>
                            <?php echo $procedure->ci; ?>
                        </td>
                        <td>
                            <?php
                        $sp= StatusData::getById($procedure->estatus);
                        echo utf8_encode($sp->name); ?>
                        </td>
                        <td>
                            <?php //echo $procedure->user_id;
                        //  $u=null;
                        if ($procedure->user_id!="") {
                            $u = UserData::getById($procedure->user_id);
                            $user = $u->name." ".$u->lastname;
                            echo $user;
                        } ?>
                        </td>

                        <td style="width:130px;" class="td-actions">
                            <a href="./?view=editprocedure&id=<?php echo $procedure->id; ?>" data-toggle="tooltip" title="Editar" class="btn btn-simple btn-warning btn-xs">
                                  <i class="material-icons">edit</i>
                            </a>
                            <a href="./?action=delprocedure&id=<?php echo $procedure->id; ?>" data-toggle="tooltip" title="Eliminar" class=" btn-simple btn btn-danger btn-xs">
                                <i class="material-icons">delete</i>
                            </a>
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
                        if ($page  == $i) {
                            $active = "active";
                        }
                        if ($i >0) {
                            echo '<li class="'.$active.'"><a href="./?view='.$_GET['view'].'&page='.$i.'">'.$i.'</a><li>';
                        }
                    }

                    // Setting up the Next & Last Button
                    if ($page == $total_pages) {
                        echo'<li class="disabled"><a href="./?view='.$_GET['view'].'&page='.($page-1).'">></a></li>';
                        echo '<li class="disabled"><a href="./?view='.$_GET['view'].'&page='.$number_of_pages.'">>></a></li></ul>';
                    } else {
                        echo'<li><a href="./?view='.$_GET['view'].'&page='.($page+1).'">></a></li>';
                        echo '<li><a href="./?view='.$_GET['view'].'&page='.$total_pages.'">>></a></li>';
                    }
                    echo'</ul>'; ?>
                </div>
                <div class="form-group">
                    Total registros: <?php echo $total_records?>
                </div>
                <br />

                <?php
                } else {
                    echo "<p class='alert alert-danger'>No hay procesos notariales registrados</p>";
                }
                ?>






            </div>
        </div>
    </div>
</div>
