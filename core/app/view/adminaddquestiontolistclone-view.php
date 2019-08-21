<?php

/**
 * adminaddquestiontolistclone short summary.
 *
 * adminaddquestiontolistclone description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
$checklistquestion = ChecklistsquestionData::getById($_GET["id"]);
//echo count($checklistquestion);
?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Clonar pregunta para control maestro</h4>
        <p class="card-category">Receurde elegir la lista de control</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->

            <a href="./?view=adminchecklists" class="btn btn-default">
                <i class="material-icons">view_list</i>&nbsp;Ver preguntas
            </a>
        </div>

        <form class="" method="post" id="addchecklistquestion" action="./?action=addchecklistquestion" role="form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Elija lista de control proceso</label>
                        <select id="ddllists" name="ddllists" class="form-control" required>
                            <?php foreach (ChecklistsData::getAll() as $list):?>
                            <option value="<?php echo $list->id; ?>">
                                <?php echo $list->name.": ".$list->description; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Pregunta</label>
                        <textarea name="question" id="question" class="form-control" rows="3" cols="20"
                            required><?php echo $checklistquestion->question;?></textarea>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">descripci&oacute;n de pregunta</label>
                        <textarea name="description" id="description" class="form-control" rows="3"
                            cols="20"><?php echo $checklistquestion->description;?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Enlace para PDF</label>
                        <input type="text" name="linkpdf" id="linkpdf" class="form-control"
                            value="<?php echo $checklistquestion->linkpdf; ?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Posic&oacute;n</label>
                        <input type="number" min="1" max="300" class="form-control" id="position" name="position"
                            value="<?php echo $checklistquestion->position;?>" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="num_input" class="bmd-label-floating">Nro. botones radio</label>
                        <input type="number" min="1" max="10" class="form-control" id="num_input" name="num_input"
                            value="2" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="bmd-label-floating">Estatus</label>
                        <select id="ddllquestionstatus" name="ddllquestionstatus" class="form-control" required>
                            <option value="on"
                                <?php if ($checklistquestion->q_status == 'on') : echo"selected"; endif; ?>>
                                Activo
                            </option>
                            <option value="off"
                                <?php if ($checklistquestion->q_status == 'off') : echo"selected"; endif; ?>>
                                Inactivo
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>" />
                        <button type="submit" class="btn btn-primary">Clonar pregunta</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>