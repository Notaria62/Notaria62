<?php

/**
 * adminhecklists short summary.
 *
 * adminhecklists description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
 Session::currentURL();

 
?>



<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Listas control de proceso</h4>
        <p class="card-category">Se enlistan los control proceso</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
            <a href="./?view=admincreatechecklist" class="btn btn-default">
                <i class="material-icons">add</i> Crear control maestro
            </a>
            <a href="./?view=adminaddquestiontolist" class="btn btn-default">
                <i class="material-icons">library_add</i> Agregar pregunta
            </a>
            <a href="./?view=adminquestionlist" class="btn btn-default">
                <i class="material-icons">list_alt</i> Ver listas de preguntas
            </a>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">

                <?php
                $record_per_page = 5;
                $result = ChecklistsData::getAllNumRow();
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
                $checklists = ChecklistsData::getAllLimitRow($this_page_first_result, $record_per_page);
                if (count($checklists) > 0) {
                    ?>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripci&oacute;n</th>
                            <th>Estado</th>
                            <th>Fecha creaci&oacute;n</th>
                            <th>Usuario</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($checklists as $cl) {
                        $user = UserData::getById($cl->user_id);
                        //$userDelivered = UserData::getById($c->user_id_delivered);?>
                    <tr>
                        <td>
                            <?=$cl->id; ?>
                        </td>
                        <td>
                            <?=$cl->name; ?>
                        </td>
                        <td>
                            <?=$cl->description; ?>
                        </td>
                        <td>
                            <?=$cl->checklist_status; ?>
                        </td>
                        <td>
                            <?=$cl->created_at; ?>
                        </td>
                        <td>
                            <?= $user->name ?>
                        </td>



                        <td style="width:150px;" class="td-actions">
                            <a href="./?view=admineditchecklists&id=<?=$cl->id; ?>" data-toggle="tooltip" title="Editar"
                                class="btn btn-success btn-round">
                                <i class="material-icons">edit</i>
                            </a> |
                            <a onclick="openWindowsPrint('./?view=printcontrolmaestro&checklist=<?=$cl->id; ?>')"
                                data-toggle="tooltip" title="Descargar control proceso" class="btn btn-info btn-round">
                                <i class="material-icons">print</i>
                            </a>
                            |
                            <?php
                              $u = UserData::getById(Session::getUID());
                        if ($u->is_admin):
                            ?>
                            <a href="./?action=delchecklists&id=<?=$cl->id; ?>" data-toggle="tooltip" title="Eliminar"
                                class="btn btn-danger btn-round">
                                <i class="material-icons">delete</i>
                            </a><?php endif; ?>
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
                    Total registros:
                    <?=$total_records?>
                </div>
                <br />
                <br />
                <?php
                } else {
                    echo "<p class='alert alert-danger'>No hay listas de chequeo creadas.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
function openWindowsPrint($url) {
    var newWindow = window.open($url, 'Reporte',
        'width=700,height=700,location=no,menubar=no,scrollbars=no,resizable=no,left=200px'); //replace with your url
    newWindow.focus(); //Sets focus window

}
</script>