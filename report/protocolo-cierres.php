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
include "../core/app/model/Util.php";
include "../core/app/model/NumeroALetras.php";
include "../core/app/model/CifrasEnLetras.php";

//session_start();
require_once '../PHPWord/bootstrap.php';
$cierr = CierresData::getById($_GET['id']);


switch ($cierr->nrocopia) {
    case 0:
        $pathtemplate = "protocolo-cierres.docx";
        break;
    default:
        if ($cierr->is_ejemplar == 1) {
            $pathtemplate = "protocolo-cierres-ejemplar.docx";
            break;
        } else {
            if ($cierr->is_sustituto == 1) {
                $pathtemplate = "protocolo-cierres-sustitutivo.docx";
                break;
            } else {
                $pathtemplate = "protocolo-cierres-interesado.docx";
                break;
            }
        }
}



$dateescrituratextshort = NumeroALetras::dateShortToWords($cierr->dateescritura);
$dateescrituratext = NumeroALetras::obtenerFechaEnLetraEscritura($cierr->dateescritura);
$created_attext = NumeroALetras::obtenerFechaEnLetra($cierr->created_at);
$observationcopy1 = $cierr->observationcopy1;
$observationcopy2 = $cierr->observationcopy2;

$numfoliostext = NumeroALetras::convertir($cierr->numfolios);
$builder = new \PhpOffice\PhpWord\TemplateProcessor('../PHPWord/resources/' . $pathtemplate);
// From
if ($cierr->nrocopia != 0) {
    $builder->setValue('nrocopia', strtoupper(CifrasEnLetras::$listaUnidadesOrdinalesFemenino[$cierr->nrocopia]));
}

if ($cierr->is_registro == 1) {
    $builder->setValue('is_registro', "Art. 14 Ley 1579 de 2012");
} else {
    $builder->setValue('is_registro', "Art. 85 Decreto 960 de 1970");
}


if ($observationcopy1 != "") {
    $observationcopy1 = "Se utilizaron folios: $observationcopy1";
}
if ($observationcopy2 != "") {
    $observationcopy2 = "Se utilizaron folios: $observationcopy2";
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
        $builder->setValue('description', 'NOTARIO SESENTA Y DOS (62) DEL CÍRCULO DE BOGOTÁ D.C.');
        break;
    case 2:
        $builder->setValue('nombrenotario', 'SANDY CATHERINE DUSSAN MORENO');
        $builder->setValue('description', 'NOTARIA SESENTA Y DOS (62) (E) DEL CÍRCULO DE BOGOTÁ D.C.');

        break;
    case 3:
        $builder->setValue('nombrenotario', 'DORA INÉS VELOSA REYES');
        $builder->setValue('description', 'NOTARIA SESENTA Y DOS (62) (E) DEL CÍRCULO DE BOGOTÁ D.C.');
        //$builder->setValue('encargado', '(E)');
        break;
    case 4:
        $builder->setValue('nombrenotario', 'DORA INÉS VELOSA REYES');
        $builder->setValue('description', 'SECRETARIA DELEGADA PARA COPIAS DCTO. 1534 DE 1989');
        //$builder->setValue('encargado', '');
        break;
}

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