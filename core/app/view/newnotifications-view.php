<?php

?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Creacion de notificaiones para el personal</h4>
        <p class="card-category">Se crean las notificaiones para el personal</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="addnotifications" action="./?action=addnotifications" role="form">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mensaje" class="bmd-label-floating">Mensaje</label>
                                <input type="text" class="form-control" id="mensaje"
                                    name="mensaje" required />
                            </div>
                        </div>
                        
                        <!-- <div class="col-md-4">
                            <div class="form-group bmd-form-group is-filled">
                                <label for="notario_id" class="bmd-label-floating">Notario</label>
                                <select id="notario_id" name="notario_id" required class="custom-select">
                                    <php foreach (NotariosData::getAll() as $d) : 
                                    <option value="php echo $d->id; >">
                                        < $d->name." ".$d->lastname; >
                                    </option>
                                    <php endforeach >
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="observationcopy1" class="bmd-label-floating">Primera copia folios</label>
                                <textarea class="form-control" id="observationcopy1" name="observationcopy1"
                                    cols="30"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="observationcopy2" class="bmd-label-floating">Segunda copia folios</label>
                                <textarea class="form-control" id="observationcopy2" name="observationcopy2"
                                    cols="30"></textarea>
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
// $(document).ready(function() {
//     var availableTags = [<?php echo $text;?>];
//     autocomplete(document.getElementById("destino"), availableTags);
// });
</script>