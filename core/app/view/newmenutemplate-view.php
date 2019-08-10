<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Agrega opciones al menú de las plantillas</h4>
        <p class="card-category">Se agrega al menú de la creacion de plantillas</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <form method="post" id="addmenutemplate" action="./?action=addmenutemplate" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nametemplate" class="bmd-label-floating">Nombre de la plantilla</label>
                        <input type="text" class="form-control" id="nametemplate" name="nametemplate"
                            required />
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="descriptiontemplate" class="bmd-label-floating">Descripción de la plantilla</label>
                        <input type="text" class="form-control" id="descriptiontemplate" name="descriptiontemplate" />
                    </div>
                </div>
                <div class="col-md-4">
                    <select id="ddlmemorandum" name="ddlmemorandum" required class="custom-select">
                        <option value="">-- SELECCIONE --</option>
                        <?php 
                        $listTemplate = NumeroALetras::obtenerListadoDeArchivos("PHPWord/resources");
                        foreach ($listTemplate as $p):?>
                        <option value="<?=substr($p["Nombre"],18); ?>"><?= substr($p["Nombre"],18); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                </div>
               <div class="row">
                    <div class="col-md-12">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {});
</script>