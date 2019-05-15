<?php

/**
 * protocolo_cierres short summary.
 *
 * protocolo_cierres description.
 *
 * @version 1.0
 * @author sistemas
 */
include "../core/autoload.php";
include "../core/app/model/ProtocoloDevolucionesData.php";
include "../core/app/model/Util.php";


//session_start();
require_once '../PHPWord/bootstrap.php';
$result = ProtocoloDevolucionesData::getById($_GET['id']);
$resultep = ProtocoloDevolucionesData::getLikeBy($result->escritura_anho);
$pathtemplate = "protocolo-devoluciones.docx";


$builder = new \PhpOffice\PhpWord\TemplateProcessor('../PHPWord/resources/' . $pathtemplate);
$acumActa = "";
$acumSaldo = 0;
$acumTipoDeposito = "";
$acumValorActa = 0;



foreach ($resultep as $key => $value) {
    # code...
    $acumActa .= $value->acta . " - ";
    $acumValorActa += $value->valor_acta;
    $acumSaldo += $value->saldo;
    $acumTipoDeposito .= $value->tipo_deposito . ", ";
}
$acumActa = substr($acumActa, 0, -2);
$acumTipoDeposito = substr($acumTipoDeposito, 0, -2);
$builder->setValue('acta', $acumActa);
$builder->setValue('depositante', $result->depositante);
$builder->setValue('escritura_anho', $result->escritura_anho);
$builder->setValue('tipo_deposito', $acumTipoDeposito);
$builder->setValue('valor_acta', $acumValorActa);
$builder->setValue('acumValorActa', $acumValorActa);
$builder->setValue('acumSaldo', $acumSaldo);

$filename = "plantilla-" . time() . "-" . $pathtemplate;
$builder->saveAs($filename);
// Doc generated on the fly, may change so do not cache it; mark as public or
// private to be cached.
header('Pragma: no-cache');
// Mark file as already expired for cache; mark with RFC 1123 Date Format up to
// 1 year ahead for caching (ex. Thu, 01 Dec 1994 16:00:00 GMT)
header('Expires: 0');
// Forces cache to re-validate with server
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.oasis.opendocument.text');
header('Content-Disposition: attachment; filename=' . $filename);
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));
flush();
readfile($filename);
unlink($filename);
session_write_close();
exit();