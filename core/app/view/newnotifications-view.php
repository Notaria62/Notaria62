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
                                <textarea class="form-control" id="mensaje" name="mensaje" cols="30"
                                    required></textarea>
                            </div>
                        </div>
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
//     var availableTags = [];
//     autocomplete(document.getElementById("destino"), availableTags);
// });
</script>