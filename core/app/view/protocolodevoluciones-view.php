<?php


if (isset($_GET["finish_at"])) {
    $finish_at = strtotime($_GET["finish_at"]);
    $now = $_GET["finish_at"];
} else {
    $finish_at = strtotime(Util::getDatetimeNow());
    $now = date('Y\-m\-d\ H:i', strtotime("+1 hour", strtotime(Util::getDatetimeNow())));
}
if (isset($_GET["start_at"])) {
    $start_at = $_GET["start_at"];
} else {
    $start_at = date('Y\-m\-d\ H:i', strtotime("-1 month", $finish_at));
}

?>

<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Devoluciones</h4>
        <p class="card-category">Se listan las personas a las cuales se les dara una devolucion mayor a 10.000 pesos</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <a href="./?view=uploadprotocolodevoluciones" class="btn btn-default">
                <i class="material-icons">add</i> Cargar lista de devoluciones
            </a>
            <!-- <a href="./?view=newprotocolodevoluciones" class="btn btn-default">
                <i class="material-icons">add</i> Crear una devolución
            </a> -->
            <hr />
            <form class="form-horizontal" role="form">
                <input type="hidden" name="view" value="protocolodevoluciones" />
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group bmd-form-group has-success">
                            <label for="start_at" class="bmd-label-floating">
                                Fecha inicio</label>
                            <input type="text" name="start_at" id="start_at" class="form-control datepicker-here"
                                data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii"
                                placeholder="" value="<?= $start_at ?>">
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
                                data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii"
                                placeholder="" value="<?= $now; ?>">
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
        <hr />
        <div class="row">
            <div class="col-md-12">
                <?php
                $result = ProtocoloDevolucionesData::getAllNumRow();
                //print_r($result);
                if (count($result) > 0) : ?>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nro. escritura</th>
                                <th>Acta</th>
                                <th>Depositante</th>
                                <th>Email</th>
                                <th>Estatus</th>
                                <th>Fecha creaci&oacute;n</th>
                                <th class="disabled-sorting text-right">Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <?php else :
                echo "<p class='alert alert-danger'>No hay devoluciones creadas.</p>";
            endif; ?>
            </div>
        </div>
    </div>
</div>

<script language="javascript">
$(document).ready(function() {
    var $url =
        '<?= "./?action=searchprotocolodevoluciones&start_at=" . $start_at . "&finish_at=" . $now; ?>';
    $('#datatables').DataTable({
        "ajax": {
            "url": $url,
            "dataSrc": "",
            "type": "GET"
        },
        "columns": [{
                "data": "escritura_anho"
            },
            {
                "data": "acta"
            },
            {
                "data": "depositante"
            },
            {
                "data": "email"
            },
            {
                "data": "status"
            },
            {
                "data": "created_at"
            },
            {
                "data": "options"
            }
        ],
        "columnDefs": [{
            className: "text-right",
            "targets": [6]
        }],
        "rowCallback": function(row, data) {
            //alert(data.status);
            if (data.status == "1") {
                $(row).css('background-color', '#d4edda');
            } else {
                $(row).css('background-color', '#f8d7da');
            }
        },




        "processing": true,
        "pagingType": "full_numbers",
        "lengthMenu": [
            [5, 10, 20, -1],
            [5, 10, 20, "All"]
        ],
        responsive: true,
        dom: 'lBfrtip',
        buttons: [{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },

            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ],
        language: {
            buttons: {
                print: 'Imprimir'
            },
            search: "_INPUT_",
            searchPlaceholder: "Buscar...",
        }
    });

    var table = $('#datatables').DataTable();
    table.order([4, 'desc']).draw();
    $('.card .material-datatables label').addClass('form-group');

});
</script>