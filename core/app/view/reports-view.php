
                <div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Categorias</h4>
        <p class="card-category">Se listan las categorias</p>
    </div>

<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">
                <table class="egt">


                </h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-vertical" role="form">
                    <input type="hidden" name="view" value="reports" />
                    <div class="form-group">
                        <div class=<html>
<head><title>Ejemplo de tabla sencilla</title></head>
<body>
                            <div class="input-group">
                                <label for="" class="bmd-label-floating">Inicio</label>
                                <div class='input-group date' id='start_at_div'>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="start_at" id="start_at" class="form-control" required value="<?php if(isset($_GET["start_at"]) && $_GET["finish_at"]!=""){ echo $_GET["start_at"]; } ?>" placeholder="Fecha inicio" />
 </div>
<div>
                                </div>
  
                        <div class="col-lg-9">

                            <div class="input-group">
                                <label for="" class="bmd-label-floating">Fecha fin</label>
                                <div class='input-group date' id='finish_at_div'>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="finish_at" id="finish_at" class="form-control" required value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" placeholder="Fecha fin" />
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-primary btn-block">Procesar</button>
                        </div>

                    </div>
                </form>

                <?php
                if (isset($_GET["start_at"]) && $_GET["start_at"]!="" && isset($_GET["finish_at"]) && $_GET["finish_at"]!="") {
                    $users = OperationData::getByRange($_GET["start_at"], $_GET["finish_at"]);
                    if (count($users)>0) {
                        // si hay usuarios
                        $_SESSION["report_data"] = $users; ?>
               
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Ejemplar</th>
                                <th>Titulo</th>
                                <th>Empleado</th>
                                <th>Fecha regreso</th>
                            </tr>
                        </thead><?php
                        $total = 0;
                        foreach ($users as $user) {
                            $item  = $user->getItem();
                            $client  = $user->getClient();
                            $book = $item->getBook(); ?>
                        <tr>
                            <td>
                                <?php echo $item->code; ?>
                            </td>
                            <td>
                                <?php echo $book->title; ?>
                            </td>
                            <td>
                                <?php echo $client->name." ".$client->lastname; ?>
                            </td>
                            <td>
                                <?php echo $user->returned_at; ?>
                            </td>
                        </tr><?php
                        }
                             ?>
                    </table><?php
                    } else {
                        echo "<p class='alert alert-danger'>No hay datos.</p>";
                    }
                } else {
                    echo "<p class='alert alert-danger'>Debes seleccionar un rango de fechas.</p>";
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