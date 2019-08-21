<?php

/**
 * adminaddquestiontolist short summary.
 *
 * adminaddquestiontolist description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
?>


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Crea una nueva pregunta para control maestro</h4>
        <p class="card-category">Se crea pregunta apra el control proceso</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <a href="./?view=adminchecklists" class="btn btn-default">
                <i class="material-icons">view_list</i> Ver lista de control maestro
            </a>
        </div>
        <hr />
        <form class="form-horizontal" method="post" id="addlist" action="./?action=addchecklistquestion" role="form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="ddllists" class="bmd-label-floating">Elija lista de control proceso</label>
                        <select id="ddllists" name="ddllists" class="custom-select" required>
                            <?php foreach (ChecklistsData::getAll() as $list):?>
                            <option value="<?=$list->id; ?>">
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
                            required></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description" class="bmd-label-floating">Descripci&oacute;n de pregunta</label>
                        <textarea name="description" id="description" class="form-control" rows="3"
                            cols="20"></textarea>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="linkpdf" class="bmd-label-floating">Enlace para PDF</label>
                        <input type="text" name="linkpdf" id="linkpdf" class="form-control" />

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="position" class="bmd-label-floating">Posic&oacute;n</label>
                        <input type="number" min="1" max="300" class="form-control" id="position" name="position"
                            value="999" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="num_input" class="bmd-label-floating">Nro. botones radio</label>
                        <input type="number" min="1" max="10" class="form-control" id="num_input" name="num_input"
                            value="2" required />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="" class="bmd-label-floating">Estatus</label>
                        <select id="ddllquestionstatus" name="ddllquestionstatus" class="custom-select" required>
                            <option value="on">Activo</option>
                            <option value="off" selected>Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-primary">Crear pregunta</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>