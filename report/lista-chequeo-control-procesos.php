<?php

/**
 * lista_chequeo_control_procesos short summary.
 *
 * lista_chequeo_control_procesos description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
include "../core/autoload.php";
include "../core/app/model/MemorandumData.php";
include "../core/app/model/TemplateMemorandumData.php";
include "../core/app/model/DigitadoresData.php";
include "../core/app/model/NumeroALetras.php";
//session_start();
require_once '../PHPWord/bootstrap.php';
$memo = MemorandumData::getById($_GET['id']);
$digitador= DigitadoresData::getById($memo->digitador_id);
$tmemo = TemplateMemorandumData::getById($_GET['templatememo_id']);
$pathtemplatememo= $tmemo->container;
$dateescriturahipoteca = NumeroALetras::obtenerFechaEnLetra($memo->dateescriturahipoteca);
$dateotorgamiento = NumeroALetras::obtenerFechaEnLetra($memo->dateotorgamiento);

$identificacion1= number_format($memo->identificacion1, 0, ",", ".");
$identificacion2= number_format($memo->identificacion2, 0, ",", ".");
$identificacion3= number_format($memo->identificacion3, 0, ",", ".");
$identificacion4= number_format($memo->identificacion4, 0, ",", ".");
$builder = new \PhpOffice\PhpWord\TemplateProcessor('../PHPWord/resources/'.$pathtemplatememo);
// From
//echo $dateotorgamiento;
$builder->setValue('numeroescriturapublica', strtoupper($memo->numeroescriturapublica));
$builder->setValue('numeroescriturapublicaenletras', NumeroALetras::convertir($memo->numeroescriturapublica));
$builder->setValue('dateotorgamiento', strtoupper($dateotorgamiento));
$builder->setValue('matriculainmobiliaria', $memo->matriculainmobiliaria);
$builder->setValue('ubicacionpredio', strtoupper($memo->ubicacionpredio));
$builder->setValue('direccioninmueble', strtoupper($memo->direccioninmueble));
$builder->setValue('nombrebanco', strtoupper($memo->nombrebanco));
$builder->setValue('numeroescriturahipoteca', $memo->numeroescriturahipoteca);
$builder->setValue('numeroescriturahipotecaletras', NumeroALetras::convertir($memo->numeroescriturahipoteca));
$builder->setValue('dateescriturahipoteca', $dateescriturahipoteca);
$builder->setValue('numerocertificado', $memo->numerocertificado);
switch ($memo->notario_id) {
    case 1:
        $builder->setValue('nombredelnotarioquefirma', 'cuyo NOTARIO TITULAR es el Doctor CARLOS ARTURO SERRATO GALEANO,');
        break;
    case 2:
        $builder->setValue('nombredelnotarioquefirma', 'cuya NOTARIA ENCARGADA es la Doctora SANDY CATHERINE DUSSAN MORENO, mediante Resoluci�n numero 13132 de fecha veintiocho (28) de Noviembre de dos mil diecis�is (2016) de la Superintendencia de Notariado y Registro;');
        break;
    case 3:
        $builder->setValue('nombredelnotarioquefirma', 'cuya NOTARIA ENCARGADA es la Doctora DORA IN�S VELOSA REYES, mediante Resoluci�n numero 13946 de fecha quince (15) de Diciembre de dos mil diecis�is (2016) de la Superintendencia de Notariado y Registro;');
        break;
}



if ($memo->typeident1 !="0") {
    $builder->setValue('fullname1', strtoupper($memo->fullname1));
    $builder->setValue('typeident1', strtoupper($memo->typeident1));
    $builder->setValue('identificacion1', $identificacion1);
}
if ($memo->typeident2 !="0") {
    $builder->setValue('fullname2', strtoupper($memo->fullname2));
    $builder->setValue('typeident2', strtoupper($memo->typeident2));
    $builder->setValue('identificacion2', $identificacion2);
}
if ($memo->typeident3 !="0") {
    $builder->setValue('fullname3', strtoupper($memo->fullname3));
    $builder->setValue('typeident3', strtoupper($memo->typeident3));
    $builder->setValue('identificacion3', $identificacion3);
}
if ($memo->typeident2 !="0") {
    $builder->setValue('fullname4', strtoupper($memo->fullname4));
    $builder->setValue('typeident4', strtoupper($memo->typeident4));
    $builder->setValue('identificacion4', $identificacion4);
}

$builder->setValue('notariaescriturahipoteca', $memo->notariaescriturahipoteca);
$builder->setValue('oficinaregistrohipoteca', strtoupper($memo->oficinaregistrohipoteca));
$builder->setValue('cuantiahipoteca', number_format($memo->cuantiahipoteca, 2, ",", "."));
$builder->setValue('cuantiahipotecaletras', NumeroALetras::convertir($memo->cuantiahipoteca));
$builder->setValue('numerohojaspapelnotarial', $memo->numerohojaspapelnotarial);
$builder->setValue('iva', number_format($memo->iva, 2, ",", "."));
$builder->setValue('derechosnotariales', number_format($memo->derechosnotariales, 2, ",", "."));
$builder->setValue('superintendencia', number_format($memo->superintendencia, 2, ",", "."));
$builder->setValue('fondonacionalnotariado', number_format($memo->fondonacionalnotariado, 2, ",", "."));
switch ($memo->notario_id) {
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
        $builder->setValue('nombrenotario', 'DORA IN�S VELOSA REYES');
        $builder->setValue('OA', 'A');
        $builder->setValue('encargado', '(E)');
        break;
}
$builder->setValue('digitador', $digitador->name);
$filename = "plantilla-".time()."-".$pathtemplatememo;
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
//print "<script>window.location='./?view=memorandumcreated';</script>";
// End the session. BE CAREFUL; YOU NEED TO DO THIS THROUGH YOUR FRAMEWORK:
session_write_close();
exit();
