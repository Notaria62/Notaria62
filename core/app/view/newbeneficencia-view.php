<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Nueva solicitud de matrices o beneficencias</h4>
        <p class="card-category">Se le hace pedido formal al departamento de protocolo</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <form method="post" id="addbeneficencia" action="./?action=addbeneficencia" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nroescriturapublica" class="bmd-label-floating">N&uacute;mero de escritura</label>
                        <input type="number" class="form-control" id="nroescriturapublica" name="nroescriturapublica"
                            required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-filled">
                        <label for="tipo" class="bmd-label-floating">Tipo</label>
                        <select id="tipo" name="tipo" class="custom-select" required>
                            <option value="Beneficencia y registro">Beneficencia y registro</option>
                            <option value="Beneficencia">Beneficencia</option>
                            <option value="Matriz">Matriz</option>
                            <option value="Registro">Registro</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="example">
                        <div class="form-group bmd-form-group has-success">
                            <label for="anho" class="bmd-label-floating">
                                A&ntilde;o escritura</label>
                            <input type="number" name="anho" id="anho" min="1900" max="2300" class="form-control datepicker-here"
                                data-timepicker="false" data-min-view="years" data-view="years" data-date-format="yyyy"
                                placeholder="" value="<?=substr(Util::getDatetimeNow(), 0, 4);?>">
                            <span class="form-control-feedback">
                                <i class="material-icons">calendar_today</i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-primary">Solicitar</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {});
</script>