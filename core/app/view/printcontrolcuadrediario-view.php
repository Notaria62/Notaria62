<?php

/**
 * newcontrolofprocess short summary.
 *
 * newcontrolofprocess description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */


//$idcp = $_GET['id'];
if (isset($_GET['id'])) {
    $id_cashregister = $_GET['id'];
    $cr = CashRegisterData::getById($id_cashregister);
    $result = PaymentTypeData::getAllCashRegister($cr->id);
    $radicado = $cr->radicado;
    $cuentaanticipos = $cr->cuentaanticipos;
    $cuentanotaria = $cr->cuentanotaria;
    $cuentaunicanotarial = $cr->cuentaunicanotarial;
    $cuentaapropiacion = $cr->cuentaapropiacion;
    $diferencias = $cr->diferencias;
    $totalpagos = $cr->totalpagos;
    $cajaauxuliar = $cr->cajaauxuliar;
    $cajaprincipal = $cr->cajaprincipal;
    $caja1erpiso = $cr->caja1erpiso;
    $created_at = $cr->created_at;
    $totalMount = 0.00;
    $totalMountAccount1 = 0.00;
    $totalMountAccount2 = 0.00;
    $totalMountAccount3 = 0.00;
    $totalMountAccount1Efectivo = 0.00;
    $totalMountAccount1Voucher = 0.00;
    $totalMountAccount1Cheque = 0.00;
    $totalMountAccount1Transferencia = 0.00;
    $totalMountAccount1Gastos = 0.00;
    $totalMountAccount1Cartera = 0.00;
    $totalMountAccount1Devoluciones = 0.00;
    $totalMountAccount2Efectivo = 0.00;
    $totalMountAccount2Voucher = 0.00;
    $totalMountAccount2Cheque = 0.00;
    $totalMountAccount2Transferencia = 0.00;
    $totalMountAccount2Gastos = 0.00;
    $totalMountAccount2Cartera = 0.00;
    $totalMountAccount2Devoluciones = 0.00;
    $totalMountAccount3Efectivo = 0.00;
    $totalMountAccount3Voucher = 0.00;
    $totalMountAccount3Cheque = 0.00;
    $totalMountAccount3Transferencia = 0.00;
    $totalMountAccount3Gastos = 0.00;
    $totalMountAccount3Cartera = 0.00;
    $totalMountAccount3Devoluciones = 0.00;
}
//echo Util::toDot("20000.87");
$display_number = 1;
?>
<div class="page-alway">

    <table class="material-datatables table-bordered">
        <tr>
            <td><img src="themes/notaria62web/img/logo.png" alt="Notaria 62" style="width: 70px;" /></td>
            <td align="center">
                <h3>NOTARIA SESENTA Y DOS (62) DEL CIRCULO DE BOGOTA CARLOS ARTURO SERRATO GALEANO</h3>
            </td>
        </tr>
        <tr>
            <td colspan="2">PLANILLA CONTROL CUADRE DIARIO: <strong>
                    <?= $created_at; ?></strong>
                del radicado: <strong>
                    <?= $radicado; ?></strong>
            </td>
        </tr>
    </table>
    <hr />

    <table class="material-datatables table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th colspan="2">CUENTA NOTARIA (1837)</th>
                <th>INGRESO SEGÚN CUADRE (SIGNO): <?= $cuentaanticipos + $cuentanotaria  ?></th>
            </tr>
            <tr>
                <th>Tipo transacción</th>
                <th>Núm. transacción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <?php foreach ($result as $key => $value) :
            //$ba=BankAccountsData::getById($value->id_bankaccounts);

            if ($value->id_bankaccounts == 1) {
                ?>
        <tr>
            <td>
                <?= $value->tipo ?>:
            </td>
            <td>
                <?= ($value->id_tipo == 0) ? "-" : $value->id_tipo; ?>
            </td>
            <td>
                <?= Util::toDot($value->mount) ?>
            </td>
        </tr>
        <?php }
                switch (true):
                    case ($value->id_bankaccounts == 1) && ($value->tipo == 'Efectivo'):
                        $totalMountAccount1Efectivo += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 1) && ($value->tipo == 'Voucher'):
                        $totalMountAccount1Voucher += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 1) && ($value->tipo == 'Cheque'):
                        $totalMountAccount1Cheque += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 1) && ($value->tipo == 'Transferencia'):
                        $totalMountAccount1Transferencia += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 1) && ($value->tipo == 'Gastos'):
                        $totalMountAccount1Gastos += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 1) && ($value->tipo == 'Cartera'):
                        $totalMountAccount1Cartera += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 1) && ($value->tipo == 'Devoluciones'):
                        $totalMountAccount1Develociones += $value->mount;
                        break;
                endswitch;
            endforeach;
            $totalMountAccount1 = $totalMountAccount1Efectivo + $totalMountAccount1Voucher + $totalMountAccount1Cheque + $totalMountAccount1Transferencia + $totalMountAccount1Gastos + $totalMountAccount1Cartera + $totalMountAccount1Devoluciones; ?>
        <tfoot>
            <tr>
                <td>
                </td>
                <td>EFECTIVO A*:</td>
                <td><?= Util::toDot($totalMountAccount1Efectivo) ?></td>
            </tr>
            <tr>
                <td>
                </td>
                <td>TOTAL INGRESO: </td>
                <td>
                    <?= Util::toDot($totalMountAccount1) ?>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>DIFERENCIA:</td>
                <td>
                    <?= Util::toDot($totalMountAccount1 - ($cuentaanticipos + $cuentanotaria))  ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <hr />
    <table class="material-datatables table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th colspan="2">CUENTA UNINCA NOTARIAL (1938)</th>
                <th>INGRESO SEGÚN CUADRE (SIGNO): <?= $cuentaunicanotarial ?></th>
            </tr>
            <tr>
                <th>Tipo transacción</th>
                <th>Núm. transacción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <?php foreach ($result as $key => $value) :
            if ($value->id_bankaccounts == 2) : ?>
        <tr>
            <td>
                <?= $value->tipo ?>:
            </td>
            <td>
                <?= ($value->id_tipo == 0) ? "-" : $value->id_tipo; ?>
            </td>
            <td>
                <?= Util::toDot($value->mount) ?>
            </td>
        </tr>
        <?php endif;
                switch (true):
                    case ($value->id_bankaccounts == 2) && ($value->tipo == 'Efectivo'):
                        $totalMountAccount2Efectivo += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 2) && ($value->tipo == 'Voucher'):
                        $totalMountAccount2Voucher += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 2) && ($value->tipo == 'Cheque'):
                        $totalMountAccount2Cheque += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 2) && ($value->tipo == 'Transferencia'):
                        $totalMountAccount2Transferencia += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 2) && ($value->tipo == 'Gastos'):
                        $totalMountAccount2Gastos += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 2) && ($value->tipo == 'Cartera'):
                        $totalMountAccount2Cartera += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 2) && ($value->tipo == 'Devoluciones'):
                        $totalMountAccount2Develociones += $value->mount;
                        break;
                endswitch;
            endforeach;
            $totalMountAccount2 = $totalMountAccount2Efectivo + $totalMountAccount2Voucher + $totalMountAccount2Cheque + $totalMountAccount2Transferencia + $totalMountAccount2Gastos + $totalMountAccount2Devoluciones + $totalMountAccount2Cartera;

            ?>

        <tfoot>
            <tr>
                <td>
                </td>
                <td>EFECTIVO B*:</td>
                <td><?= Util::toDot($totalMountAccount2Efectivo) ?>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>TOTAL INGRESO:</td>
                <td>
                    <?= Util::toDot($totalMountAccount2) ?>
                </td>

            </tr>
            <tr>
                <td>
                </td>
                <td>DIFERENCIA:</td>
                <td>
                    <?= Util::toDot($totalMountAccount2 - $cuentaunicanotarial) ?>
                </td>
            </tr>
        </tfoot>

    </table>
    <hr />
    <table class="material-datatables table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th colspan="2">CUENTA APROPIACI&Oacute;N (3426)</th>
                <th>INGRESO SEGÚN CUADRE (SIGNO): <?= $cuentaapropiacion ?></th>
            </tr>
            <tr>
                <th>Tipo transacción</th>
                <th>Núm. transacción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <?php foreach ($result as $key => $value) :
            if ($value->id_bankaccounts == 3) : ?>
        <tr>
            <td>
                <?= $value->tipo ?>:
            </td>
            <td>
                <?= ($value->id_tipo == 0) ? "-" : $value->id_tipo; ?>
            </td>
            <td>
                <?= Util::toDot($value->mount) ?>
            </td>
        </tr>
        <?php endif;
                switch (true):
                    case ($value->id_bankaccounts == 3) && ($value->tipo == 'Efectivo'):
                        $totalMountAccount3Efectivo += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 3) && ($value->tipo == 'Voucher'):
                        $totalMountAccount3Voucher += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 3) && ($value->tipo == 'Cheque'):
                        $totalMountAccount3Cheque += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 3) && ($value->tipo == 'Transferencia'):
                        $totalMountAccount3Transferencia += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 3) && ($value->tipo == 'Gastos'):
                        $totalMountAccount3Gastos += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 3) && ($value->tipo == 'Cartera'):
                        $totalMountAccount3Cartera += $value->mount;
                        break;
                    case ($value->id_bankaccounts == 3) && ($value->tipo == 'Devoluciones'):
                        $totalMountAccount3Develociones += $value->mount;
                        break;
                endswitch;
            endforeach;
            $totalMountAccount3 = $totalMountAccount3Efectivo + $totalMountAccount3Voucher + $totalMountAccount3Cheque + $totalMountAccount3Transferencia + $totalMountAccount3Gastos + $totalMountAccount3Cartera + $totalMountAccount3Develociones;

            ?>

        <tfoot>
            <tr>
                <td>
                </td>
                <td>EFECTIVO C*:</td>
                <td><?= Util::toDot($totalMountAccount3Efectivo) ?>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>TOTAL INGRESO:</td>
                <td>
                    <?= Util::toDot($totalMountAccount3) ?>
                </td>

            </tr>
            <tr>
                <td>
                </td>
                <td>DIFERENCIA:</td>
                <td>
                    <?= Util::toDot($totalMountAccount3 - $cuentaapropiacion) ?>
                </td>
            </tr>
        </tfoot>

    </table>

    <hr />
    <table class="material-datatables table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th colspan="2">TOTAL EFECTIVO REFLEJADO EN ARQUEOS</th>
            </tr>
        </thead>
        <tr>
            <td>C) CAJERO AUXILIAR</td>
            <td><?= Util::toDot($cajaauxuliar) ?></td>
        </tr>
        <tr>
            <td>D)CAJERO PRINCIPAL</td>
            <td><?= Util::toDot($cajaprincipal) ?></td>
        </tr>
        <tr>
            <td>E)CAJA 1ER PISO</td>
            <td><?= Util::toDot($caja1erpiso) ?></td>
        </tr>
        <tr>
            <td>SUME (C+D+E) TOTAL $</td>
            <td><?= Util::toDot($cajaauxuliar + $cajaprincipal + $caja1erpiso) ?></td>

        </tr>
        </thead>
        <tfoot>
            <tr>
                <th>SUME (A+B+C) EFECTIVO TOTAL:</th>
                <th>
                    <?= Util::toDot($totalMountAccount1Efectivo + $totalMountAccount2Efectivo + $totalMountAccount3Efectivo) ?>
                </th>
            </tr>

        </tfoot>

    </table>
    <hr />
    <div class="col-md-12">
        <p>
            (1)SIEMPRE DEBE DAR CERO, EN CASO CONTRARIO INDIQUE VALOR.</p>
        <p>(+) Ó (-) IMPLICA TRASLADAR MEDIANTE CHEQUE ENTRE LAS CUENTAS PARA CUADRAR. GIRE CHEQUE CUENTA CON (+)
        </p>
        <p>(*)BAUCHER(S): SI LAS CASILLAS NO LE ALCANZAN AGRUPELAS DE MENOR VALOR EN LA CASILLA ANTES DEL EFECTIVO.</p>
    </div>

</div>

<div class="page-alway">
    <table class="material-datatables table-bordered" style="width: 100%;">
        <tr>
            <td><img src="themes/notaria62web/img/logo.png" alt="Notaria 62" style="width: 70px;" /></td>
            <td align="center" colspan="6">
                <h3>CONTROL VOUCHER SIN PROCESAR</h3>
            </td>
        </tr>
        <tr>
            <td>NUMERO</td>
            <td>CUENTA N°</td>
            <td>VALOR</td>
            <td colspan="4">
                <table class="material-datatables table-bordered" style="width:100%">
                    <tr>
                        <td colspan="4">Control contabilidad</td>
                    </tr>
                    <tr>
                        <td colspan="3">Procesado</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Fecha</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>

    </table>

    <div class="col-md-12">
        <p>
            Se le informa a contabilidad y entregó copia de voucher y del listado para reclamar al banco: Si_______
            No_______</p>

        <p>Firma y sello de contabilidad como constancia de haber verificado y obtenido el abono de los voucher</p>
        <table style="border:2px solid #000;">
            <tr>
                <td class="text-center" style="width:200px; height:70px; border:2px solid #000;">Contabilidad</td>
                <td class="text-center" style="width:200px; height:70px;border:2px solid #000;text">Notario</td>
            </tr>
        </table>
    </div>

    <table class="material-datatables table-bordered" style="width: 100%;">
        <tr>
            <td><img src="themes/notaria62web/img/logo.png" alt="Notaria 62" style="width: 70px;" /></td>
            <td class="text-center" colspan="6">
                <h3>Control translados retefuente reteica por pagos tarjeta d y c</h3>
            </td>
        </tr>
        <tr>
            <td>Fecha extracto</td>
            <td>Valor exacto en extracto retencion</td>
            <td>exacto en extracto reteica</td>
            <td colspan="4">
                <table class="material-datatables table-bordered" style="width:100%">
                    <tr>
                        <td colspan="4">Control contabilidad</td>
                    </tr>
                    <tr>
                        <td colspan="4">Se elaboro nota translado</td>

                    </tr>
                    <tr>
                        <td>Si</td>
                        <td>No</td>
                        <td colspan="2">Total</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>&nbsp;
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>

    </table>
    <div class="col-md-12">


        <p>Firma y sello de contabilidad como constancia de haber transladodo los valores de retefuente y reteica del
            dia______ mes_____ año____</p>
        <table style="border:2px solid #000;">
            <tr>
                <td class="text-center" style="width:200px; height:70px; border:2px solid #000;">Contabilidad</td>
                <td class="text-center" style="width:200px; height:70px;border:2px solid #000;text">Notario</td>
            </tr>
        </table>
    </div>

</div>





<button onclick="javascript:window.print()" class="btn btn-success"><i class="material-icons">print</i>
    Imprimir</button>
<button onclick="javascript:window.close()" class="btn btn-danger"><i class="material-icons">close</i>
    Cerrar</button>
<style>
.sidebar,
.footer,
nav,
.navbar {
    display: none;
}

.main-panel {
    float: none;
    width: 100%;
    font-size: 12px !important;
}

body,
span,
label {
    background-color: #fff;
    color: #000 !important;
    font-size: 12px !important;
}

.main-panel>.content {
    margin-top: 0px;
    padding: 0px;
    min-height: 100%;
}

tfoot {
    font-weight: bold;
}

.page-alway {
    page-break-after: always;
}
</style>