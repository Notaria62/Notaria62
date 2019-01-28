<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Prestamos</h4>
        <p class="card-category">M&oacute;dulo de historial de prestamos</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <a href="./?view=rent" class="btn btn-default">
                <i class="material-icons">add</i> Nuevo prestamo
            </a>
            <hr />
            <form class="form-horizontal" role="form">
                <input type="hidden" name="view" value="rents" />
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group bmd-form-group has-success">
                            <label for="start_at" class="bmd-label-floating">
                                Fecha inicio</label>
                            <input type="text" name="start_at" id="start_at" class="form-control datepicker-here"
                                data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii" placeholder=""
                                value="<?= (isset($_GET["start_at"]) && $_GET["finish_at"]!="") ? $_GET["start_at"] :''; ?>">
                            <span class="form-control-feedback">
                                <i class="material-icons">calendar_today</i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group bmd-form-group has-success">
                            <label for="finish_at" class="bmd-label-floating">
                                Fecha fin</label>
                            <input type="text" name="finish_at" id="finish_at" class="form-control datepicker-here"
                                data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii" placeholder=""
                                value="<?= (isset($_GET["start_at"]) && $_GET["finish_at"]!="") ? $_GET["finish_at"] :''; ?>">
                            <span class="form-control-feedback">
                                <i class="material-icons">calendar_today</i>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-primary btn-block">
                            <i class="material-icons">done</i> Procesar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
 $products = array();

 if (isset($_GET["start_at"]) && $_GET["start_at"]!="" && isset($_GET["finish_at"]) && $_GET["finish_at"]!="") {
     if ($_GET["start_at"]<$_GET["finish_at"]) {
         $products = OperationData::getRentsByRange($_GET["start_at"], $_GET["finish_at"]);
     }
 } else {
     $products = OperationData::getEvery();
 }
 if (count($products)>0) {
     ?>

                <table class="table table-bordered table-hover	">
                    <thead>
                        <tr>
                            <th>Ejemplar</th>
                            <th>Producto</th>
                            <th>Cliente</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($products as $sell):
             $item = $sell->getItem();
     $book = $item->getBook();
     $client = $sell->getClient(); ?>
                    <tr>
                        <td style="width:30px;">
                            <?=$item->code; ?>
                        </td>
                        <td>
                            <?=$book->title; ?>
                        </td>
                        <td>
                            <?=$client->name." ".$client->lastname; ?>
                        </td>
                        <td>
                            <?=$sell->start_at; ?>
                        </td>
                        <td>
                            <?=$sell->finish_at; ?>
                        </td>
                        <td style="width:60px;">
                            <?php if ($sell->returned_at==""):?>
                            <a href="./?action=finalize&id=<?=$sell->id; ?>"
                                class="btn btn-xs btn-success">Finalizar</a>
                            <?php endif; ?>
                        </td>
                        <td style="width:30px;">
                            <a href="./?action=deloperation&id=<?=$sell->id; ?>"
                                class="btn btn-xs btn-danger">
                                <i class="material-icons">close</i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

                <div class="clearfix"></div>
                <?php
 } else {
     ?>
                <p class="alert alert-danger">No hay prestamos.</p>
                <?php
 } ?>

            </div>
        </div>
    </div>

</div>




<script>
    $(document).ready(function() {});
</script>