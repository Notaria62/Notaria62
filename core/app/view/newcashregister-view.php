<?php
if (isset($_GET["start_at"])) {
    $start_at = $_GET["start_at"];
} else {
    $start_at = Util::getDatetimeNow();
}



$result = CashRegisterData::getByLastRadicado(date("Y"));
$b = new CashRegisterData();

if (isset($_GET['idcr'])) {
    $id_cashregister = $_GET['idcr'];
    $cr = CashRegisterData::getById($id_cashregister);
    $const = $cr->radicado;
    $id_cashregister = $cr->id;

    /* if (count($result)<=0) {
    $const = date("Y"). Util::zero_fill(1, 3);
} else {
    foreach ($result as $value) {
        $const = $value->radicado;
        $const++;
        $id_cashregister= $value->id;
    }
} */
} else {
    if (count($result) <= 0) {
        $const = date("Y") . Util::zero_fill(1, 3);
        $b->radicado = $const;
        $b->user_id = Session::getUID();
        $b->addRadicado();
        $result = CashRegisterData::getByLastRadicado(date("Y"));
        foreach ($result as $value) {
            $id_cashregister = $value->id;
        }
    } else {
        foreach ($result as $value) {
            $const = $value->radicado;
            $const++;
            $id_cashregister = $value->id;
            $id_cashregister++;
        }
        $b->radicado = $const;
        $b->user_id = Session::getUID();
        $b->addRadicado();
    }
}






//$const =date("Y"). Util::zero_fill($cons, 3);






?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Planilla control cuadre diario</h4>
        <p class="card-category">Page of test </p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
        </div>
        <form class="form-horizontal" role="form" method="post" action="./?action=updatecashregister"
            id="updatecashregister">
            <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="radicado" class="bmd-label-floating">Cuadre diario nro.</label>
                        <input type="text" class="form-control" id="radicado" name="radicado" required
                            value="<?= $const ?>" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group bmd-form-group has-success">
                        <label for="created_at" class="bmd-label-floating">
                            Fecha</label>
                        <input type="text" name="created_at" id="created_at" class="form-control datepicker-here"
                            data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii:s"
                            placeholder="" value="<?= $start_at ?>">
                        <span class="form-control-feedback">
                            <i class="material-icons">calendar_today</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cuentaanticipos" class="bmd-label-floating">Cuenta anticipos (SIGNO 1837)</label>
                        <input type="text" class="form-control" id="cuentaanticipos" name="cuentaanticipos" required />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cuentanotaria" class="bmd-label-floating">Cuenta notaria (SIGNO 1837)</label>
                        <input type="text" class="form-control" id="cuentanotaria" name="cuentanotaria" required />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cuentaunicanotarial" class="bmd-label-floating">Cuenta unica notarial
                            (SIGNO 1938)</label>
                        <input type="text" class="form-control" id="cuentaunicanotarial" name="cuentaunicanotarial"
                            required />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cuentaapropiacion" class="bmd-label-floating">Cuenta apropiacion
                            (SIGNO 3426)</label>
                        <input type="text" class="form-control" id="cuentaapropiacion" name="cuentaapropiacion"
                            required />
                    </div>
                </div>
                <!-- <div class="col-md-2">
                <div class="form-group">
                    <label for="diferencias" class="bmd-label-floating">Diferencia</label>
                    <input type="text" class="form-control" id="diferencias" name="diferencias" required />
                </div>
            </div> -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="totalpagos" class="bmd-label-floating">Total pagos</label>
                        <input type="text" class="form-control" id="totalpagos" name="totalpagos" required />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cajaauxuliar" class="bmd-label-floating">Cajero auxiliar</label>
                        <input type="text" class="form-control target txtMounts" id="cajaauxuliar" name="cajaauxuliar"
                            value="0" required />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cajaprincipal" class="bmd-label-floating">Cajero principal</label>
                        <input type="text" class="form-control target" id="cajaprincipal" name="cajaprincipal" value="0"
                            required />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="caja1erpiso" class="bmd-label-floating">Caja 1er primer</label>
                        <input type="text" class="form-control target" id="caja1erpiso" name="caja1erpiso" value="0"
                            required />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_cashregister" name="id_cashregister"
                            value="<?= $id_cashregister; ?>" />
                        <button type="submit" name="btnupdatecashregister" id="btnupdatecashregister"
                            class="btn btn-success btn-xs">Actualizar</button>
                        <a href="./?view=cashregister" class="btn btn-default">Volver</a>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-md-12">
            <div style="display:block;" id="efectivosobrante">0</div>
            <input type="hidden" class="form-control" id="totalMountAccountCash" name="totalMountAccountCash"
                value="0" />
            <input type="hidden" class="form-control" id="totalMountCash" name="totalMountCash" value="0" />
            <button type="button" name="btncalculator" id="btncalculator"
                class="btn btn-success btn-xs">Calcular</button>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <div align="right">
                    <button type="button" name="add" id="add" class="btn btn-info">Add</button>
                </div>
                <br />
                <div id="alert_message"></div>
                <table id="user_data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Cuenta bancaria</th>
                            <th>Tipo de trans.</th>
                            <th>Número (Voucher o cheque)</th>
                            <th class="sum">Monto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align:right">Total:</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>




        <input type="hidden" class="form-control" id="id_cashregister" name="id_cashregister"
            value="<?= $id_cashregister; ?>" />
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group bmd-form-group is-filled">
                            <label for="id_bankaccounts" class="bmd-label-floating">Tipo de cuenta bancaria</label>
                            <select id="id_bankaccounts" name="id_bankaccounts" class="custom-select" required>
                                <option value="" selected="selected"></option>
                                <?php foreach (BankAccountsData::getAll() as $d) : ?>
                                <option value="<?= $d->id; ?>">
                                    <?= $d->nombrecuenta . " " . $d->numerocuenta; ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group bmd-form-group is-filled">
                            <label for="tipo" class="bmd-label-floating">Tipo de trans.</label>
                            <select id="tipo" name="tipo" class="custom-select" required>
                                <option value="" selected="selected"></option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Voucher">Voucher</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Gastos">Gastos</option>
                                <option value="Cartera">Cartera</option>
                                <option value="Devoluciones">Devoluciones</option>
                                <option value="Consignaciones">Consignaciones</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="id_tipo" class="bmd-label-floating">N&uacute;mero o identificador</label>
                            <input type="text" class="form-control" id="id_tipo" name="id_tipo" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mount" class="bmd-label-floating">Monto</label>
                            <input type="text" class="form-control" id="mount" name="mount" required />
                            <button onclick="sum()" class="btn btn-primary btn-sm">Sumar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript" language="javascript">
$(document).ready(function() {
    fetch_data();


    function fetch_data() {
        $id_cashregister = '<?= $id_cashregister ?>';
        var $url = "./?action=searchpaymenttype&idcr=" + $id_cashregister;
        var dataTable = $('#user_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: $url,
                type: "GET"
            },
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // Total over all pages
                total = api
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                // Update footer
                $(api.column(2).footer()).html(
                    '$' + pageTotal + ' ( $' + total + ' total)'
                );
            }
        });
        $("#totalpagos").val()
        $('#id_bankaccounts').val("");
        $('#tipo').val("");
        $('#id_tipo').val("");
        $('#mount').val("");

    }

    function update_data(id, column_name, value) {
        $.ajax({
            url: "update.php",
            method: "POST",
            data: {
                id: id,
                column_name: column_name,
                value: value
            },
            success: function(data) {
                $('#alert_message').html('<div class="alert alert-success">' +
                    data +
                    '</div>');
                $('#user_data').DataTable().destroy();
                fetch_data();
            }
        });
        setInterval(function() {
            $('#alert_message').html('');
        }, 5000);
    }

    $(document).on('blur', '.update', function() {
        var id = $(this).data("id");
        var column_name = $(this).data("column");
        var value = $(this).text();
        update_data(id, column_name, value);
    });

    $('#add').click(function() {

        $("#myModal").modal();
        //var html = '<tr>';
        /*  html += '<td contenteditable id="data1"></td>';
         html += '<td contenteditable id="data2"></td>';
         html += '<td contenteditable id="data3"></td>';
         html +=
             '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
         html += '</tr>';
         $('#user_data tbody').prepend(html); */



    });

    $(document).on('click', '#insert', function() {
        var $url = "./?action=addpaymenttype";
        var id_bankaccounts = $('#id_bankaccounts').val();
        var id_cashregister = $('#id_cashregister').val();
        var tipo = $('#tipo').val();
        var id_tipo = $('#id_tipo').val();
        var mount = $('#mount').val();
        if (tipo != '' && id_tipo != '') {
            $.ajax({
                url: $url,
                method: "POST",
                data: {
                    tipo: tipo,
                    id_tipo: id_tipo,
                    mount: mount,
                    id_bankaccounts: id_bankaccounts,
                    id_cashregister: id_cashregister
                },
                success: function(data) {
                    $('#alert_message').html(
                        '<div class="alert alert-success">' +
                        data +
                        '</div>');
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                }
            });
            setInterval(function() {
                $('#alert_message').html('');

            }, 5000);
        } else {
            alert("Both Fields is required");
        }
    });

    $(document).on('click', '.delete', function() {
        var id = $(this).attr("id");
        var $url = "./?action=delpaymenttype";
        if (confirm("Seguro quiere eliminar?")) {
            $.ajax({
                url: $url,
                method: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#alert_message').html(
                        '<div class="alert alert-success">' +
                        data +
                        '</div>');
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                }
            });
            setInterval(function() {
                $('#alert_message').html('');
            }, 5000);
        }
    });
    $(document).on('click', '#btncalculator', function() {
        var totalMountAccountCash = Number($("#totalMountAccountCash").val());
        var totalMountCash = Number($("#totalMountCash").val());
        var cajaauxuliar = Number($("#cajaauxuliar").val());
        var cajaprincipal = Number($("#cajaprincipal").val());
        var caja1erpiso = Number($("#caja1erpiso").val());
        var cuentaapropiacion = Number($("#cuentaapropiacion").val());
        var cuentaunicanotarial = Number($("#cuentaunicanotarial").val());
        var aux1 = cuentaunicanotarial - cuentaapropiacion;
        $("#cuentaunicanotarial").val(aux1);
        var totalMountCash = cajaauxuliar + cajaprincipal + caja1erpiso;

        var cash = totalMountCash - totalMountAccountCash;
        $("#efectivosobrante").html('Efectivo sobrante : $' + cash);

    });
});

function sum() {
    sumofnums = 0;
    nums = document.getElementById("mount").value.split(",");
    for (i = 0; i < nums.length; i++) {
        sumofnums += parseInt(nums[i]);
    }
    //alert(sumofnums);
    $("#mount").val(sumofnums)
}

$(function() {

    $("#tipo").change(function() {
        var flag = 0;
        $("#tipo option:selected").each(function() {
            flag = $(this).val();
        });
        //alert(flag);
        switch (flag) {
            case "Efectivo":
                $('#id_tipo').val(0);
                $('#div_id_tipo').hide();
                break;
            case "Voucher":
                $('#id_tipo').val("");
                $('#div_id_tipo').show();
                break;
            case "Cheque":
                $('#id_tipo').val("");
                $('#div_id_tipo').show();
                break;
            case "Transferencia":
                $('#did_tipo').val("");
                $('#div_id_tipo').show();
                break;
        }
    }).trigger("change");

    $('.txtMounts').keyup(function() {
        var val = $(this).val();
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2)
                val = val.replace(/\.+$/, "");
        }
        $(this).val(val);
    });

});
</script>