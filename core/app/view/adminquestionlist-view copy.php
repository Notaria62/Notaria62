<!--/**
 * ChecklistsquestionsData short summary.
 *
 * ChecklistsquestionsData description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */-->
<?php


 if (isset($_GET['checklist'])) {
     $checklists_id = $_GET['checklist'];
 } else {
     $checklists_id=0;
 }
?>


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Lista las preguntas</h4>
        <p class="card-category">Se listan las preguntas de cada lista de chequeo</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->

            <a href="./?view=adminchecklists" class="btn btn-default">
                <i class="material-icons">view_list</i> Ver lista de control maestro
            </a>
            <a href="./?view=admincreatechecklist" class="btn btn-default">
                <i class="material-icons">add</i> Crear control maestro
            </a>
            <a href="./?view=adminaddquestiontolist" class="btn btn-default">
                <i class="material-icons">library_add</i> Agregar pregunta
            </a>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group bmd-form-group is-filled">
                    <label for="ddllists" class="bmd-label-floating">Elija lista de control proceso</label>
                    <select id="ddllists" name="ddllists" class="custom-select"
                        onchange="location = this.options[this.selectedIndex].value;" required>
                        <option value="/?view=adminquestionlist&checklist=0">--- SELECCIONE ---</option>
                        <?php foreach (ChecklistsData::getAll() as $list):?>
                        <option value="/?view=adminquestionlist&checklist=<?=$list->id; ?>" <?=($list->id ==
                            $checklists_id) ?
                            "selected":"";?>>
                            <?=$list->name.": ".$list->description; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">


                <?php
                $record_per_page = 10;
                $result = ChecklistsquestionData::getAllNumRowQuestionToList($checklists_id);

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
                $checklistsquestion = ChecklistsquestionData::getAllLimitRowQuestionToList($checklists_id, $this_page_first_result, $record_per_page);
                if (count($checklistsquestion) > 0) {
                    ?>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Posici&oacute;n</th>
                            <th>Pregunta</th>
                            <th>Descricion</th>
                            <th>Tipo proceso</th>
                            <th>Fecha creacion</th>
                            <th>Usuario</th>
                            <th>Opciones</th>

                        </tr>
                    </thead>
                    <?php foreach ($checklistsquestion as $cq) {
                        $user = UserData::getById($cq->user_id);
                        $color= $cq->q_status; ?>
                    <tr data-background-color-approval="<?=($color==" off")? 'no-approval' : '' ; ?>">
                        <td>
                            <?=$cq->position; ?>
                        </td>
                        <td>
                            <?php $question = $cq->question;
                        echo substr($question, 0, 100);
                        echo ($question !="")?"...":""; ?>
                        </td>
                        <td>
                            <?=substr($cq->description, 0, 50);
                        echo ($cq->description !="")?"...":""; ?>
                        </td>
                        <td>
                            <?=$cq->checklists_id; ?>
                        </td>
                        <td>
                            <?=$cq->created_at; ?>
                        </td>
                        <td>
                            <?= $user->name ?>
                        </td>
                        <td style="width:150px;" class="td-actions">
                            <a href="./?view=admineditquestiontolist&id=<?=$cq->id; ?>&checklist=<?=$cq->checklists_id; ?>"
                                data-toggle="tooltip" title="Editar" class="btn btn-success btn-round">
                                <i class="material-icons">edit</i>
                            </a> |
                            <a href="./?view=adminaddquestiontolistclone&id=<?=$cq->id; ?>" data-toggle="tooltip"
                                title="Clonar pregunta" class="btn btn-warning btn-round">
                                <i class="material-icons">toll</i>
                            </a> |
                            <?php
                              $u = UserData::getById(Session::getUID());
                        if ($u->is_admin):
                            ?>
                            <a href="./?action=delquestionchecklist&id=<?=$cq->id; ?>" data-toggle="tooltip"
                                title="Eliminar" class="btn btn-danger btn-round">
                                <i class="material-icons">delete</i>
                            </a>
                            <?php endif; ?>

                        </td>

                    </tr>
                    <?php
                    } ?>
                </table>
                <div align="center">
                    <br />
                    <?php
                    $start_loop = $page;
                    $difference = $total_pages - $page;
                    if ($difference <= 5) {
                        $start_loop = $total_pages - 5;
                    }
                    $end_loop = $start_loop + 5;



                    if ($page == 1) {
                        echo '<ul class="pagination"><li class="disabled"><a href="./?view='.$_GET['view'].'&checklist='.$_GET['checklist'].'&page=1"><<</a></li>';
                        echo '<li class="disabled"><a href="./?view='.$_GET['view'].'&checklist='.$_GET['checklist'].'&page='.$page.'"><</a></li>';
                    } else {
                        echo '<ul class="pagination"><li><a href="./?view='.$_GET['view'].'&checklist='.$_GET['checklist'].'&page=1"><<</a></li>';
                        echo '<li><a href="./?view='.$_GET['view'].'&page='.($page-1).'"><</a></li>';
                    }
                    for ($i=$start_loop; $i<=$end_loop; $i++) {
                        $active ="";
                        if ($page  == $i) {
                            $active = "active";
                        }
                        if ($i >0) {
                            echo '<li class="'.$active.'"><a href="./?view='.$_GET['view'].'&checklist='.$_GET['checklist'].'&page='.$i.'">'.$i.'</a><li>';
                        }
                    }
                    // Setting up the Next & Last Button
                    if ($page == $total_pages) {
                        echo'<li class="disabled"><a href="./?view='.$_GET['view'].'&checklist='.$_GET['checklist'].'&page='.($page-1).'">></a></li>';
                        echo '<li class="disabled"><a href="./?view='.$_GET['view'].'&checklist='.$_GET['checklist'].'&page='.$number_of_pages.'">>></a></li></ul>';
                    } else {
                        echo'<li><a href="./?view='.$_GET['view'].'&checklist='.$_GET['checklist'].'&page='.($page+1).'">></a></li>';
                        echo '<li><a href="./?view='.$_GET['view'].'&checklist='.$_GET['checklist'].'&page='.$total_pages.'">>></a></li>';
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
                    echo "<p class='alert alert-danger'>No hay preguntas en la listas de control de proceso seleccionada.</p>";
                }
                ?>
            </div>
        </div>

    </div>
</div>