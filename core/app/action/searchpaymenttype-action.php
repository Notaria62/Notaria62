<?php

/**
 * searchpaymenbnttype_action short summary.
 *
 * searchescrituras_action description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
if (count($_GET) > 0) {
    //$columns = array('tipo', 'id_tipo', 'mount','id_bankaccounts','id_cashregister', 'totalMountAccount1');
    $result = PaymentTypeData::getAllCashRegister($_GET["idcr"]);
    $us = UserData::getById(Session::getUID());
    $data = array();
    $totalMount = 0;
    $totalMountAccount1 = 0;
    $totalMountAccount2 = 0;
    $totalMountAccount3 = 0;
    $totalMountAccount1Efectivo = 0;
    $totalMountAccount1Voucher = 0;
    $totalMountAccount1Cheque = 0;
    $totalMountAccount1Transferencia = 0;
    $totalMountAccount1Gastos = 0;
    $totalMountAccount1Cartera = 0;
    $totalMountAccount2Efectivo = 0;
    $totalMountAccount2Voucher = 0;
    $totalMountAccount2Cheque = 0;
    $totalMountAccount2Transferencia = 0;
    $totalMountAccount2Gastos = 0;
    $totalMountAccount2Cartera = 0;
    $totalMountAccount3Efectivo = 0;
    $totalMountAccount3Voucher = 0;
    $totalMountAccount3Cheque = 0;
    $totalMountAccount3Transferencia = 0;
    $totalMountAccount3Gastos = 0;
    $totalMountAccount3Cartera = 0;
    foreach ($result as $value) {
        $ba = BankAccountsData::getById($value->id_bankaccounts);
        $sub_array = array();
        $totalMount = $totalMount + $value->mount;

        switch ($value->id_bankaccounts) {
            case 1:
                # code...
                $totalMountAccount1 = $totalMountAccount1 + $value->mount;
                $sub_array[] = $ba->numerocuenta;
                break;
            case 2:
                # code...
                $totalMountAccount2 = $totalMountAccount2 + $value->mount;
                $sub_array[] = $ba->numerocuenta;
                break;
            case 3:
                # code...
                $totalMountAccount3 = $totalMountAccount3 + $value->mount;
                $sub_array[] = $ba->numerocuenta;
                break;
        }

        // if ($value->id_bankaccounts == 1) {
        //     $totalMountAccount1 = $totalMountAccount1 + $value->mount;
        //     $sub_array[] = $ba->numerocuenta;
        // } else {
        //     $totalMountAccount2 = $totalMountAccount2 + $value->mount;
        //     $sub_array[] = $ba->numerocuenta;
        // }
        //$sub_array[] = '<div contenteditable class="update" data-id="'.$value->id.'" data-column="tipo">' . $value->id_bankaccounts. '</div>';

        $sub_array[] = $value->tipo;
        //$sub_array[] = '<div contenteditable class="update" data-id="'.$value->id.'" data-column="tipo">' . $value->tipo . '</div>';
        //$sub_array[] = ($value->id_tipo==0)? "-": $value->id_tipo;
        //$sub_array[] = $value->mount;
        $id_tipo = ($value->id_tipo == 0) ? "-" : $value->id_tipo;
        $sub_array[] = '<div contenteditable class="update form-control" data-id="' . $value->id . '" data-column="id_tipo">' . $id_tipo . '</div>';
        $sub_array[] = '<div contenteditable class="update form-control" data-id="' . $value->id . '" data-column="mount">' . Util::toDot($value->mount) . '</div>';

        //$sub_array[] = '<div contenteditable class="update" data-id="'.$value->id.'" data-column="tipo">' . $value->tipo . '</div>';
        /*$sub_array[] = '<div contenteditable class="update" data-id="'.$value->id.'" data-column="id_tipo">' . $value->id_tipo . '</div>';
            $sub_array[] = '<div contenteditable class="update" data-id="'.$value->id.'" data-column="mount">' . $value->mount . '</div>'; */
        $btnEdit = '<button type="button" id="' . $value->id . '" name="btnEdit" data-toggle="tooltip" title="Editar" class="btn btn-link btn-success btn-just-icon btn-sm btnEdit"><i class="material-icons">edit</i> </button>';
        $btnDel = ($us->is_admin || $us->user_level == 25) ? '<button type="button" mane="delete" id="' . $value->id . '" data-toggle="tooltip" title="Eliminar" class="btn btn-link btn-danger btn-just-icon btn-sm delete"> <i class="material-icons">delete</i></button>' : '';
        $sub_array[] = $btnDel;


        $data[] = $sub_array;
        switch (true) {
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
        }
        switch (true) {
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
            case ($value->id_bankaccounts == 1) && ($value->tipo == 'Gastos'):
                $totalMountAccount2Gastos += $value->mount;
                break;
            case ($value->id_bankaccounts == 1) && ($value->tipo == 'Cartera'):
                $totalMountAccount2Cartera += $value->mount;
                break;
        }
        switch (true) {
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
        }
    }
    $output = array(
        "draw"    => intval($_GET["draw"]),
        "recordsTotal"  =>  $_GET["length"],
        "totalMountAccount1" => $totalMountAccount1,
        "totalMountAccount2" => $totalMountAccount2,
        "totalMountAccount1Efectivo" => $totalMountAccount1Efectivo,
        "totalMountAccount1Voucher" => $totalMountAccount1Voucher,
        "totalMountAccount1Cheque" => $totalMountAccount1Cheque,
        "totalMountAccount2Efectivo" => $totalMountAccount2Efectivo,
        "totalMountAccount2Voucher" => $totalMountAccount2Voucher,
        "totalMountAccount2Cheque" => $totalMountAccount2Cheque,
        "totalMount" => $totalMount,
        "recordsFiltered" => count($result),
        "data"    => $data
    );
    //echo $totalMount;
    echo json_encode($output);
}