<?php
$item = ItemData::getById($_GET["id"]);
$book = $item->getBook();
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">
                    <i class='fa fa-clock-o'></i><?php echo $item->code." - ".$book->title; ?>
                </h4>
            </div>
            <div class="card-content table-responsive">
                <a href="./?view=rent" class="btn btn-default">
                    <i class='fa fa-user'></i>Nuevo prestamo
                </a>
                <br />

                <form class="form-horizontal" role="form">
                    <input type="hidden" name="view" value="itemhistory" />
                    <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
                    <div class="form-group">
                        <div class="col-lg-3">
                            <div class="input-group">
                                <label for="" class="bmd-label-floating">Inicio</label>
                                <div class='input-group date' id='start_at_div'>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="start_at" id="start_at" class="form-control" required value="<?php if(isset($_GET["start_at"]) && $_GET["finish_at"]!=""){ echo $_GET["start_at"]; } ?>" placeholder="Fecha inicio" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <label for="" class="bmd-label-floating">Fecha fin</label>
                                <div class='input-group date' id='finish_at_div'>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="finish_at" id="finish_at" class="form-control" required value="<?php if(isset($_GET["start_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" placeholder="Fecha fin" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-primary btn-block">Procesar</button>
                        </div>

                    </div>
                </form>
                <?php
                        $products = array();
                        if(isset($_GET["start_at"]) && $_GET["start_at"]!="" && isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){
                        if($_GET["start_at"]<$_GET["finish_at"]){
                        $products = OperationData::getAllByItemIdAndRange($item->id,$_GET["start_at"],$_GET["finish_at"]);
                        }
                        }else{
                        $products = OperationData::getAllByItemId($item->id);
                        }
                        if(count($products)>0){
                ?>
                <br />
                <table class="table table-bordered table-hover	">
                    <thead>
                        <th>Ejemplar</th>
                        <th>Producto</th>
                        <th>Cliente</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Regreso</th>
                    </thead>
                    <?php foreach($products as $sell):
                            $item = $sell->getItem();
                            $book = $item->getBook();
                            $client = $sell->getClient();
                    ?>
                    <tr>
                        <td style="width:30px;">
                            <?php echo $item->code; ?>
                        </td>
                        <td>
                            <?php echo $book->title; ?>
                        </td>
                        <td>
                            <?php echo $client->name." ".$client->lastname; ?>
                        </td>
                        <td>
                            <?php echo $sell->start_at; ?>
                        </td>
                        <td>
                            <?php echo $sell->finish_at; ?>
                        </td>
                        <td>
                            <?php echo $sell->returned_at; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

                <div class="clearfix"></div>
                <?php
                        }else{
                ?>
                <p class="alert alert-danger">No hay prestamos.</p>
                <?php
                        }
                                                                   ?>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#start_at_div').datetimepicker({
            daysOfWeekDisabled: [0],
            format: 'YYYY/MM/DD HH:mm:ss',
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: ' fa fa-angle-up',
                down: 'fa fa-angle-down',
                previous: 'fa fa-angle-left',
                next: 'fa fa-angle-right',
                today: 'fa fa-crosshairs',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            },
            sideBySide: true
        });
        $('#finish_at_div').datetimepicker({
            daysOfWeekDisabled: [0],
            format: 'YYYY/MM/DD HH:mm:ss',
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: ' fa fa-angle-up',
                down: 'fa fa-angle-down',
                previous: 'fa fa-angle-left',
                next: 'fa fa-angle-right',
                today: 'fa fa-crosshairs',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            },
            sideBySide: true
        });
    });
</script>

<link href="themes/notaria62web/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<!-- jQuery UI -->
<script type="text/javascript" src="themes/notaria62web/js/jquery-ui.min.js"></script>
<script type="text/javascript" src='themes/notaria62web/js/moment.min.js'></script>
<script type="text/javascript" src="themes/notaria62web/js/es.js"></script>
<script type="text/javascript" src="themes/notaria62web/js/bootstrap-datetimepicker.js"></script>
