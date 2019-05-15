<?php

$result = ProtocoloDevolucionesData::getById($_GET['id']);
$resultep = ProtocoloDevolucionesData::getLikeBy($result->escritura_anho);

//print_r($resultep);
$sumclient = 0;
$sumsaldo = 0;
$acumActa = "";
foreach ($resultep as $key => $value) {
    # code...

    echo "Tipo deposito: " . $value->tipo_deposito . "<br> ";
    //echo "Num acta: " . $value->acta . "<br> ";
    echo "Valor del acta: " . $value->valor_acta . "<br> ";
    echo "Saldo del usuario: " . $value->saldo . "<br> ";
    $acumActa .= $value->acta . " - ";
    $sumsaldo += $value->saldo;
    $sumclient += $value->valor_acta;
}
echo "Nueros de actas: " . $acumActa;
echo "<br>Total pagado por el usuario:" . $sumclient;

echo "<br>Saldo a favor del cliente: " . $sumsaldo . " Para la escritura: " . $result->escritura_anho;