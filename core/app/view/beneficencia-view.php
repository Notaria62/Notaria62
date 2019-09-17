<?php

/**
 * controlofprocess short summary.
 *
 * controlofprocess description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
Session::currentURL();

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
        <h4 class="card-title">Solicitudes de matrices o beneficencias</h4>
        <p class="card-category">Se le hace actualizaci&oacute;n formal a la solicitud</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
            <a href="./?view=newbeneficencia" class="btn btn-default">
                <i class="material-icons">add</i> Solicitar
            </a>
            <a href="./?view=beneficencia" class="btn btn-info" id="updateNotification">
                <i class="material-icons">update</i> Actualizar
            </a>
            <span class="badge badge-notify notification"></span>
            <hr />
            <form class="form-horizontal" role="form">
                <input type="hidden" name="view" value="beneficencia" />
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group bmd-form-group has-success">
                            <label for="start_at" class="bmd-label-floating">
                                Fecha inicio</label>
                            <input type="text" name="start_at" id="start_at" class="form-control datepicker-here"
                                data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii"
                                placeholder="" value="<?=$start_at?>">
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
                                placeholder="" value="<?=$now;?>">
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
                header("refresh:500;  url=./?view=beneficencia");
                $result = BeneficenciaData::getAllNumRow();
                if (count($result) > 0) :
                    ?>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nro. escritura</th>
                                <th>Tipo doc.</th>
                                <th>A&ntilde;o escritura</th>
                                <th>Fecha solicitud</th>
                                <th>Usuario solicitante</th>
                                <th>Fecha entregado</th>
                                <th>Usuario que entrego</th>
                                <th class="disabled-sorting text-right">Aprobaci&oacute;n</th>
                                <th class="disabled-sorting text-right">Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <?php
                else:
                    echo "<p class='alert alert-danger'>No hay beneficencias creadas.</p>";
                endif;
                ?>
            </div>
        </div>
    </div>
</div>


<script language="javascript">
$(document).ready(function() {
    var $url =
        '<?="./?action=searchescrituras&start_at=".$start_at."&finish_at=".$now;?>';
    $('#datatables').DataTable({
        "processing": true,
        "ajax": {
            "url": $url,
            "dataSrc": "",
            "type": "GET"
        },
        "columns": [{
                "data": "nroescriturapublica"
            },
            {
                "data": "tipo"
            },
            {
                "data": "anho"
            },
            {
                "data": "created_at"
            },
            {
                "data": "usuarioSolicitud"
            },
            {
                "data": "finished_at"
            },
            {
                "data": "userDelivered"
            },
            {
                "data": "approvals"
            }, {
                "data": "options"
            }
        ],
        "columnDefs": [{
            className: "text-right",
            "targets": [7, 8]
        }],
        "bProcessing": true,
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 15, 20, -1],
            [10, 15, 20, "All"]
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
    table.order([3, 'desc']).draw();
    $('.card .material-datatables label').addClass('form-group');



    //Notificacions
    //load_unseen_notification();

    function load_unseen_notification(view = '') {
        $.ajax({
            url: "./?action=pushbeneficencia",
            method: "POST",
            data: {
                view: view
            },
            dataType: "json",
            success: function(data) {
                var text = "";
                for (var c = 0; c < data.length; c++) {
                    var infocancion = "- Nro escritura: " + data[c].nroescriturapublica;
                    infocancion += " del año: " + data[c].anho;
                    infocancion += ", Usuario: " + data[c].usuarioSolicitud;
                    text += infocancion + "\n";
                    if (data[c].unseen_notification > 0) {
                        $('.notification').html(data[c].unseen_notification);
                    }
                }
                if (data.length > 0) {
                    push("Tienes: " + data.length + " solicitud(es)", text);
                    document.title = "(" + data.length + ") solicitud(es)";
                }
            }
        });
    }
    $(document).on('click', '#updateNotification', function() {
        $('.notification').html('');
        load_unseen_notification('yes');
    });

    setInterval(function() {
        load_unseen_notification();
    }, 90000);

    function push($v1, $v2) {
        var notification = null;
        if (!('Notification' in window)) {
            // el navegador no soporta la API de notificaciones
            alert('Su navegador no soporta la API de Notificaciones :(');
            return;
        } else if (Notification.permission === "granted") {
            // Se puede emplear las notificaciones
            notification = new Notification($v1, {
                body: $v2,
                dir: 'auto',
                icon: 'themes/notaria62web/img/logo.png'
            });

        } else if (Notification.permission !== 'denied') {
            // se pregunta al usuario para emplear las notificaciones
            Notification
                .requestPermission(function(permission) {
                    if (permission === "granted") {
                        notification = new Notification($v1, {
                            body: $v2,
                            dir: 'auto',
                            icon: 'themes/notaria62web/img/logo.png'
                        });
                    }
                });
        }
        notification.onclick = function(event) {
            event
                .preventDefault(); // Previene al buscador de mover el foco a la pestaña del Notification
            location.href = "./?view=beneficencia";
        }

    }

});
</script>