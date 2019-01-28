<?php

/**
 * admineditquestiontolist short summary.
 *
 * adminaeditquestiontolist description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
Session::currentURL();

$checklistquestion = ChecklistsquestionData::getById($_GET["id"]);
$checklists_id = $_GET["checklist"];

?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar pregunta para la lista maestra</h4>
        <p class="card-category">Se edita la pregunta del control proceso</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <a href="./?view=adminquestionlist" class="btn btn-default">
                <i class="material-icons">list_alt</i> Ver listas de preguntas
            </a>
        </div>

        <form class="" method="post" id="updatechecklistquestion" action="./?action=updatechecklistquestion"
            role="form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="ddllists" class="bmd-label-floating">Elija lista de control proceso</label>
                        <select id="ddllists" name="ddllists" class="form-control" required>
                            <?php foreach (ChecklistsData::getAll() as $list):?>
                            <option value="<?=$list->id; ?>" <?=($list->id == $checklists_id) ? "selected":"";?>>
                                <?=$list->name.": ".$list->description; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="question" class="bmd-label-floating">Pregunta</label>
                        <textarea name="question" id="question" class="form-control" rows="3" cols="20"
                            required><?=$checklistquestion->question;?></textarea>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description" class="bmd-label-floating">descripci&oacute;n de pregunta</label>
                        <textarea name="description" id="description" class="form-control" rows="3"
                            cols="20"><?=$checklistquestion->description;?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="linkpdf" class="bmd-label-floating">Enlace para PDF</label>
                        <input type="text" name="linkpdf" id="linkpdf" class="form-control"
                            value="<?=$checklistquestion->linkpdf; ?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="position" class="bmd-label-floating">Posic&oacute;n</label>
                        <input type="number" min="1" max="300" class="form-control" id="position" name="position"
                            value="<?=$checklistquestion->position;?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="ddllquestionstatus" class="bmd-label-floating">Estatus</label>
                        <select id="ddllquestionstatus" name="ddllquestionstatus" class="custom-select" required>
                            <option value="on"
                                <?php if ($checklistquestion->q_status == 'on') : echo"selected"; endif;
                                ?>>
                                Activo</option>
                            <option value="off"
                                <?php if ($checklistquestion->q_status == 'off') : echo"selected";
                                endif; ?>>
                                Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden" name="id" id="id" value="<?=$_GET['id'];?>" />
                        <button type="submit" class="btn btn-primary">Actualizar pregunta</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>