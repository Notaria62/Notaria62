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
    $result =PaymentTypeData::getAllCashRegister($cr->id);
    $radicado = $cr->radicado;
    $cuentaanticipos = $cr->cuentaanticipos;
    $cuentanotaria = $cr->cuentanotaria;
    $cuentaunicanotarial = $cr->cuentaunicanotarial;
    $diferencias = $cr->diferencias;
    $totalpagos = $cr->totalpagos;
    $cajaauxuliar = $cr->cajaauxuliar;
    $cajaprincipal = $cr->cajaprincipal;
    $caja1erpiso = $cr->caja1erpiso;
    $created_at = $cr->created_at;
    $totalMount =0;
$totalMountAccount1 =0;
$totalMountAccount2 =0;
$totalMountAccount1Efectivo =0;
$totalMountAccount1Bouchers =0;
$totalMountAccount1Cheque =0;
$totalMountAccount1Transferencia =0;
$totalMountAccount2Efectivo =0;
$totalMountAccount2Bouchers =0;
$totalMountAccount2Cheque =0;
$totalMountAccount2Transferencia =0;

}

$display_number = 1;
?>



<table class="material-datatables table-bordered">
    <tr>
        <td><img src="themes/notaria62web/img/logo.png" alt="Notaria 62" style="width: 70px;" /></td>
        <td align="center">
            <h3>NOTARIA SESENTA Y DOS (62) DEL CIRCULO DE BOGOTA CARLOS ARTURO SERRATO GALEANO</h3>
        </td>
    </tr>
    <tr>
        <td colspan="2">PLANILLA CONTROL CUADRE DIARIO: <strong>
                <?= $created_at;?></strong>
            del radicado: <strong>
                <?= $radicado;?></strong>
        </td>
    </tr>
</table>
<hr />

<table class="material-datatables table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th colspan="2">CUENTA NOTARIA (1837)</th>
            <th>INGRESO SEGÚN CUADRE (SIGNO): <?=$cuentaanticipos + $cuentanotaria  ?></th>
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
            <?= $value->tipo?>:
        </td>
        <td>
            <?= ($value->id_tipo==0)? "-": $value->id_tipo;?>
        </td>
        <td>
            <?= $value->mount?>
        </td>
    </tr>
    <?php }
switch (true) :
            case ($value->id_bankaccounts == 1) && ($value->tipo == 'Efectivo'):
                $totalMountAccount1Efectivo +=$value->mount;
                break;
            case ($value->id_bankaccounts == 1) && ($value->tipo == 'Bouchers'):
                $totalMountAccount1Bouchers+=$value->mount;
                break;
            case ($value->id_bankaccounts == 1) && ($value->tipo == 'Cheque'):
                $totalMountAccount1Cheque+=$value->mount;
                break;
                case ($value->id_bankaccounts == 1) && ($value->tipo == 'Transferencia'):
                $totalMountAccount1Transferencia+=$value->mount;
                break;
endswitch;
endforeach; ?>

    <tfoot>
        <tr>
            <td>
            </td>
            <td>EFECTIVO:</td>
            <td><?=$totalMountAccount1Efectivo?></td>
        </tr>
        <tr>
            <td>
            </td>
            <td>TOTAL INGRESO: </td>
            <td>
                <?=$totalMountAccount1Efectivo + $totalMountAccount1Bouchers +$totalMountAccount1Cheque +$totalMountAccount1Transferencia ?>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>DIFERENCIA:</td>
            <td>
                <?=$totalMountAccount1Efectivo + $totalMountAccount1Bouchers +$totalMountAccount1Cheque +$totalMountAccount1Transferencia-($cuentaanticipos + $cuentanotaria)  ?>
            </td>
        </tr>
    </tfoot>

</table>
<hr />
<table class="material-datatables table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th colspan="2">CUENTA UNINCA NOTARIAL (1938)</th>
            <th>INGRESO SEGÚN CUADRE (SIGNO): <?=$cuentaunicanotarial ?></th>
        </tr>
        <tr>
            <th>Tipo transacción</th>
            <th>Núm. transacción</th>
            <th>Monto</th>
        </tr>
    </thead>
    <?php foreach ($result as $key => $value) :
    //$ba=BankAccountsData::getById($value->id_bankaccounts);

     if ($value->id_bankaccounts == 2) {
     ?>
    <tr>
        <td>
            <?= $value->tipo?>:
        </td>
        <td>
            <?= ($value->id_tipo==0)? "-": $value->id_tipo;?>
        </td>
        <td>
            <?= $value->mount?>
        </td>
    </tr>
    <?php }
switch (true) :
            case ($value->id_bankaccounts == 2) && ($value->tipo == 'Efectivo'):
                $totalMountAccount2Efectivo +=$value->mount;
                break;
            case ($value->id_bankaccounts == 2) && ($value->tipo == 'Bouchers'):
                $totalMountAccount2Bouchers+=$value->mount;
                break;
            case ($value->id_bankaccounts == 2) && ($value->tipo == 'Cheque'):
                $totalMountAccount2Cheque+=$value->mount;
                break;
                case ($value->id_bankaccounts == 2) && ($value->tipo == 'Transferencia'):
                $totalMountAccount2Transferencia+=$value->mount;
                break;
endswitch;
endforeach; ?>

    <tfoot>
        <tr>
            <td>
            </td>
            <td>EFECTIVO:</td>
            <td><?=$totalMountAccount2Efectivo?>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>TOTAL INGRESO:</td>
            <td>
                <?=$totalMountAccount2Efectivo + $totalMountAccount2Bouchers +$totalMountAccount2Cheque +$totalMountAccount2Transferencia ?>
            </td>

        </tr>
        <tr>
            <td>
            </td>
            <td>DIFERENCIA:</td>
            <td>
                <?=$totalMountAccount2Efectivo + $totalMountAccount2Bouchers +$totalMountAccount2Cheque +$totalMountAccount1Transferencia-($cuentaunicanotarial)  ?>
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
        <td><?=$cajaauxuliar?></td>
    </tr>
    <tr>
        <td>D)CAJERO PRINCIPAL</td>
        <td><?=$cajaprincipal?></td>
    </tr>
    <tr>
        <td>E)CAJA 1ER PISO</td>
        <td><?=$caja1erpiso?></td>
    </tr>
    <tr>
        <td>SUME (C+D+E) TOTAL $</td>
        <td><?= $cajaauxuliar + $cajaprincipal + $caja1erpiso?></td>

    </tr>
    </thead>
    <tfoot>
        <tr>
            <th>SUME (A+B) TOTAL:</th>
            <th>
                <?=$totalMountAccount1Efectivo + $totalMountAccount2Efectivo ?>
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
</style>