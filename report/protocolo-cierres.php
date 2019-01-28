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
include "../core/app/model/CierresData.php";
include "../core/app/model/NumeroALetras.php";
//session_start();
require_once '../PHPWord/bootstrap.php';
$cierr = CierresData::getById($_GET['id']);


$pathtemplate= "protocolo-cierres.docx";
$dateescrituratextshort = NumeroALetras::dateShortToWords($cierr->dateescritura);
$dateescrituratext = NumeroALetras::obtenerFechaEnLetraEscritura($cierr->dateescritura);
$created_attext = NumeroALetras::obtenerFechaEnLetra($cierr->created_at);
$observationcopy1 = $cierr->observationcopy1;
$observationcopy2 = $cierr->observationcopy2;

$numfoliostext =NumeroALetras::convertir($cierr->numfolios);
$builder = new \PhpOffice\PhpWord\TemplateProcessor('../PHPWord/resources/'.$pathtemplate);
// From

if ($observationcopy1 != "") {
    $observationcopy1 = "Folios desde: $observationcopy1";
}
if ($observationcopy2 != "") {
    $observationcopy2 = "Folios desde: $observationcopy2";
}

$builder->setValue('nroescriturapublica', strtoupper($cierr->nroescriturapublica));
$builder->setValue('nroescriturapublicatext', NumeroALetras::convertirEscritura($cierr->nroescriturapublica));
$builder->setValue('dateescrituratextshort', strtoupper($dateescrituratextshort));
$builder->setValue('dateescrituratext', strtoupper($dateescrituratext));
$builder->setValue('destino', strtoupper($cierr->destino));
$builder->setValue('observationcopy1', $observationcopy1);
$builder->setValue('observationcopy2', $observationcopy2);
$builder->setValue('numfolios', strtoupper($cierr->numfolios));
$builder->setValue('numfoliostext', strtoupper($numfoliostext));
$builder->setValue('created_attext', strtoupper($created_attext));


switch ($cierr->notario_id) {
    case 1:
        $builder->setValue('nombrenotario', 'CARLOS ARTURO SERRATO GALEANO');
        $builder->setValue('oa', 'O');
        $builder->setValue('encargado', '');
        break;
    case 2:
        $builder->setValue('nombrenotario', 'SANDY CATHERINE DUSSAN MORENO');
        $builder->setValue('oa', 'A');
        $builder->setValue('encargado', '(E)');
        break;
    case 3:
        $builder->setValue('nombrenotario', 'DORA INÉS VELOSA REYES');
        $builder->setValue('oa', 'A');
        $builder->setValue('encargado', '(E)');
        break;
}

$filename = "plantilla-".time()."-".$pathtemplate;
//$builder = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
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
header('Content-Disposition: attachment; filename='.$filename);
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));
flush();
readfile($filename);
unlink($filename);
session_write_close();
exit();
