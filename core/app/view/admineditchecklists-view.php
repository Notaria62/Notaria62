<?php
/**
 * admineditchecklists short summary.
 *
 * admineditchecklists description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
//Session::currentURL();

 $checklist = ChecklistsData::getById($_GET["id"]);
?>





<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Editar lista control de proceso</h4>
        <p class="card-category">Se edita el control proceso</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <a href="./?view=adminquestionlist" class="btn btn-default">
                <i class="material-icons">list_alt</i> Ver listas de preguntas
            </a>
        </div>

        <hr />
        <form class="" method="post" id="updatechecklist" action="./?action=updatechecklist" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Nombre de lista</label>
                        <input type="text" class="form-control" id="name" value="<?=$checklist->name;?>" name="name"
                            require />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description" class="bmd-label-floating">descripci&oacute;n de lista</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="<?=$checklist->description;?>" require />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filleds">
                        <label for="ddlchecklist_status" class="bmd-label-floating">Estatus</label>
                        <select id="ddlchecklist_status" name="ddlchecklist_status" class="custom-select" required>
                            <option value="open" <?= ($checklist->checklist_status == 'open') ? "selected":"";?>>Activo
                            </option>
                            <option value="close" <?=($checklist->checklist_status == 'close') ? "selected":"";?>>
                                Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-lg-offset-2 col-lg-10">
                            <input type="hidden" name="id" id="id" value="<?=$_GET['id'];?>" />
                            <button type="submit" class="btn btn-primary">Actualizar lista</button>
                        </div>
                    </div>
                </div>

        </form>
    </div>
</div>