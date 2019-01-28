<?php

/**
 * creatememorandum_view short summary.
 *
 * creatememorandum_view description.
 *
 * @version 1.0
 * @author sistemas
 */


?>



<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Crear minuta</h4>
        <p class="card-category">M&oacute;dulo para la creaci&oacute;n de minutas</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <hr />

        <form id="searchp">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="view" value="sell">
                    <select id="ddlmemorandum" name="ddlmemorandum" required class="custom-select">
                        <option value="">-- SELECCIONE --</option>
                        <?php foreach (TemplateMemorandumData::getAll() as $p):?>
                        <option value="<?php echo $p->id; ?>"><?php echo $p->name." ".$p->description; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary"><i class="material-icons">search</i> Elegir
                        plantilla</button>
                </div>
            </div>
        </form>

        <div id="show_search_results"></div>
        <script type="text/javascript">
        $(document).ready(function() {
            $("#searchp").on("submit", function(e) {
                e.preventDefault();

                $.get("./?action=searchtemplatememorandum", $("#searchp").serialize(),
                    function(data) {
                        $("#show_search_results").html(data);
                    });
                $("#ddlmemorandum").val("");

            });
        });
        </script>








    </div>
</div>