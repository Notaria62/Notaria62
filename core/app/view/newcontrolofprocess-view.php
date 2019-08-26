<?php

/**
 * newcontrolofprocess short summary.
 *
 * newcontrolofprocess description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Nuevo control de proceso</h4>
        <p class="card-category">Se crea el control proceso para una escritura</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <form id="searchp">
            <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="numeroescriturapublica" class="bmd-label-floating">Nro. E.P.</label>
                        <input type="number" class="form-control" id="numeroescriturapublica"
                            name="numeroescriturapublica" required />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group bmd-form-group has-success">
                        <label for="ep_anho" class="bmd-label-floating">
                            A&ntilde;o escritura</label>
                        <input type="text" name="ep_anho" id="ep_anho" min="1900" max="2300"
                            class="form-control datepicker-here" data-timepicker="false" data-min-view="years"
                            data-view="years" data-date-format="yyyy" placeholder=""
                            value="<?=substr(Util::getDatetimeNow(), 0, 4);?>">
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="" class="bmd-label-floating">Tipo de proceso</label>
                        <select id="ddllists" name="ddllists" class="custom-select" required>
                            <option value="">-- SELECCIONE ---</option>
                            <?php foreach (ChecklistsData::getAllOpen() as $list):?>
                            <option value="<?php echo $list->id; ?>">
                                <?php echo $list->name.": ".$list->description; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="" class="bmd-label-floating">Abogado</label>
                        <select id="ddlabogado" name="ddlabogado" class="custom-select" required>
                            <option value="">-- SELECCIONE ---</option>
                            <?php foreach (ClientData::getAllDrActive() as $list):?>
                            <option value="<?= $list->id; ?>">
                                <?php echo $list->name." ".$list->lastname; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="observation" class="bmd-label-floating">Observación</label>
                        <input type="text" class="form-control" id="observation" name="observation" />
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons">check</i> Elegir</button>
                </div>
            </div>
        </form>
        <div id="show_search_results"></div>
    </div>
</div>




<script>
$(document).ready(function() {
    $("#searchp").on("submit", function(e) {
        e.preventDefault();
        var id_list = $("#ddllists option:selected").val();
        $.get("./?action=searchcontrolofprocess&id=" + id_list, $("#searchp").serialize(), function(
            data) {
            $("#show_search_results").html(data);
        });
        $("#ddlmemorandum").val("");
    });
});
</script>