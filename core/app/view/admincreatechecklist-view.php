<?php
/**
 * admincreatechecklist short summary.
 *
 * admincreatechecklist description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */


?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Nuevo control de proceso</h4>
        <p class="card-category">Se crea el control proceso</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <a href="./?view=adminchecklists" class="btn btn-default">
                <i class="material-icons">view_list</i> Ver lista de control maestro
            </a>
            <a href="./?view=adminaddquestiontolist" class="btn btn-default">
                <i class="material-icons">library_add</i> Agregar pregunta
            </a>
        </div>
        <hr />
        <form class="form-horizontal" method="post" id="addchecklist" action="./?action=addchecklist" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mane" class="bmd-label-floating">Nombre de lista</label>
                        <input type="text" class="form-control" id="name" name="name" require />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description" class="bmd-label-floating">descripci&oacute;n de lista</label>
                        <input type="text" class="form-control" id="description" name="description" require />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="ddlchecklist_status" class="bmd-label-floating">Estatus</label>
                        <select id="ddlchecklist_status" name="ddlchecklist_status" class="custom-select" required>
                            <option value="open">Activo</option>
                            <option value="close">Inactivo</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-primary">Crear lista</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>