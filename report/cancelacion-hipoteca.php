<?php

/**
 * cancelacion_hipoteca_ley_546_roberto short summary.
 *
 * cancelacion_hipoteca_ley_546_roberto description.
 *
 * @version 1.0
 * @author sistemas
 */
include "../core/autoload.php";
include "../core/app/model/MemorandumData.php";
include "../core/app/model/TemplateMemorandumData.php";
include "../core/app/model/DigitadoresData.php";
include "../core/app/model/NumeroALetras.php";
include "../core/app/model/CifrasEnLetras.php";
//session_start();
require_once '../PHPWord/bootstrap.php';
$memo = MemorandumData::getById($_GET['id']);
$digitador= DigitadoresData::getById($memo->digitador_id);
$tmemo = TemplateMemorandumData::getById($_GET['templatememo_id']);
$pathtemplatememo= $tmemo->container;
$dateescriturahipoteca = NumeroALetras::obtenerFechaEnLetra($memo->dateescriturahipoteca);
$dateotorgamiento = NumeroALetras::obtenerFechaEnLetra($memo->dateotorgamiento);
$dateresolucionnotario = NumeroALetras::obtenerFechaEnLetra($memo->dateresolucionnotario);

$identificacion1= number_format($memo->identificacion1, 0, ",", ".");
$identificacion2= number_format($memo->identificacion2, 0, ",", ".");
$identificacion3= number_format($memo->identificacion3, 0, ",", ".");
$identificacion4= number_format($memo->identificacion4, 0, ",", ".");
$builder = new \PhpOffice\PhpWord\TemplateProcessor('../PHPWord/resources/'.$pathtemplatememo);
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
        $builder->setValue('resolucion', '');
        break;
    case 2:
        $builder->setValue('nombredelnotarioquefirma', 'cuya NOTARIA ENCARGADA es la Doctora SANDY CATHERINE DUSSAN MORENO, mediante Resolución número '.$memo->resolucionnotario.' de fecha '. $dateresolucionnotario.' de la Superintendencia de Notariado y Registro;');
        $builder->setValue('resolucion', 'NOTARIA ENCARGADA SEGÚN RESOLUCIÓN '.$memo->resolucionnotario.' DE FECHA '.$dateresolucionnotario.' DE LA SNR');
        break;
    case 3:
        $builder->setValue('nombredelnotarioquefirma', 'cuya NOTARIA ENCARGADA es la Doctora DORA INÉS VELOSA REYES, mediante Resolución numero '.$memo->resolucionnotario.' de fecha '. $dateresolucionnotario.' de la Superintendencia de Notariado y Registro;');
        $builder->setValue('resolucion', 'NOTARIA ENCARGADA SEGÚN RESOLUCIÓN '.$memo->resolucionnotario.' DE FECHA '.$dateresolucionnotario.' DE LA SNR');
        break;
}
$deudoresstr1="";
$deudoresstr2="";
if ($memo->typeident1 !="0") {
    $builder->setValue('fullname1', strtoupper($memo->fullname1));
    $builder->setValue('typeident1', strtoupper($memo->typeident1));
    $builder->setValue('identificacion1', $identificacion1);
    $deudoresstr1 .= strtoupper($memo->fullname1).'<w:t xml:space="preserve"> </w:t></w:t></w:r><w:r><w:tab/></w:r><w:r><w:t><w:t xml:space="preserve"> </w:t><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial Unicode MS" w:cs="Arial Unicode MS"/></w:rPr>'.strtoupper($memo->typeident1)." ".$identificacion1;
    $deudoresstr2 .=strtoupper($memo->fullname1)." Identificado(s) con ".strtoupper($memo->typeident1)." Número(s) ".$identificacion1;
}
if ($memo->typeident2 !="0") {
    $builder->setValue('fullname2', strtoupper($memo->fullname2));
    $builder->setValue('typeident2', strtoupper($memo->typeident2));
    $builder->setValue('identificacion2', $identificacion2);
    $deudoresstr1 .= "<w:br/>".strtoupper($memo->fullname2).'<w:t xml:space="preserve"> </w:t></w:t></w:r><w:r><w:tab/></w:r><w:r><w:t><w:t xml:space="preserve"> </w:t><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial Unicode MS" w:cs="Arial Unicode MS"/></w:rPr>'.strtoupper($memo->typeident2)." ".$identificacion2;
    $deudoresstr2 .=" y ".strtoupper($memo->fullname2)." Identificado(s) con ".strtoupper($memo->typeident2)." Número(s) ".$identificacion2;
}
if ($memo->typeident3 !="0") {
    $builder->setValue('fullname3', strtoupper($memo->fullname3));
    $builder->setValue('typeident3', strtoupper($memo->typeident3));
    $builder->setValue('identificacion3', $identificacion3);
    $deudoresstr1 .= "<w:br/>".strtoupper($memo->fullname3).'<w:t xml:space="preserve"> </w:t></w:t></w:r><w:r><w:tab/></w:r><w:r><w:t><w:t xml:space="preserve"> </w:t><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial Unicode MS" w:cs="Arial Unicode MS"/></w:rPr>'.strtoupper($memo->typeident3)." ".$identificacion3;
    $deudoresstr2 .=" y ".strtoupper($memo->fullname3)." Identificado(s) con ".strtoupper($memo->typeident3)." Número(s) ".$identificacion3;
}
if ($memo->typeident4 !="0") {
    $builder->setValue('fullname4', strtoupper($memo->fullname4));
    $builder->setValue('typeident4', strtoupper($memo->typeident4));
    $builder->setValue('identificacion4', $identificacion4);
    $deudoresstr1 .= "<w:br/>".strtoupper($memo->fullname4).'<w:t xml:space="preserve"> </w:t></w:t></w:r><w:r><w:tab/></w:r><w:r><w:t><w:t xml:space="preserve"> </w:t><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial Unicode MS" w:cs="Arial Unicode MS"/></w:rPr>'.strtoupper($memo->typeident4)." ".$identificacion4;
    $deudoresstr2 .=" y ".strtoupper($memo->fullname4)." Identificado(s) con ".strtoupper($memo->typeident4)." Número(s) ".$identificacion4;
}

$builder->setValue('deudoresstr1', $deudoresstr1);
$builder->setValue('deudoresstr2', $deudoresstr2);
$builder->setValue('notariaescriturahipoteca', strtoupper($memo->notariaescriturahipoteca));
$builder->setValue('oficinaregistrohipoteca', strtoupper($memo->oficinaregistrohipoteca));
$builder->setValue('cuantiahipoteca', number_format($memo->cuantiahipoteca, 2, ",", "."));
$builder->setValue('cuantiahipotecaletras', mb_strtoupper(CifrasEnLetras::convertirPesosEnLetras($memo->cuantiahipoteca, 0)));
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
        $builder->setValue('nombrenotario', 'DORA INÉS VELOSA REYES');
        $builder->setValue('oa', 'A');
        $builder->setValue('encargado', '(E)');
        break;
}
$builder->setValue('digitador', $digitador->name);
$filename = "rad-".$memo->radicado."-ep-".$memo->numeroescriturapublica."-plantilla-".time()."-".$digitador->name."-".$pathtemplatememo;
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
