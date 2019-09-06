<?php

/**
 * protocolo_ short summary.
 *
 * protocolo_ description.
 *
 * @version 1.0
 * @author sistemas
 */
include "../core/autoload.php";
include "../core/app/model/Util.php";
include "../core/app/model/UserData.php";
include "../core/app/model/ClientesignoData.php";
include "../core/app/model/VigenciasData.php";
include "../core/app/model/NumeroALetras.php";
include "../core/app/model/CifrasEnLetras.php";

//session_start();
require_once '../PHPWord/bootstrap.php';
$cierr = VigenciasData::getById($_GET['id']);
$u = UserData::getById($cierr->user_id);

$pathtemplate = "protocolo-vigencias.docx";
$dateescrituratextshort = NumeroALetras::dateShortToWords($cierr->dateescritura);
$dateescrituratext = NumeroALetras::obtenerFechaEnLetraEscritura($cierr->dateescritura);
$created_attext = NumeroALetras::obtenerFechaEnLetra($cierr->created_at);


$builder = new \PhpOffice\PhpWord\TemplateProcessor('../PHPWord/resources/'.$pathtemplate);


$builder->setValue('consecutivo', substr($cierr->consecutivo, -4)." / ".substr($cierr->consecutivo, 0, -4));
$builder->setValue('nroescriturapublica', strtoupper($cierr->nroescriturapublica));
$builder->setValue('nroescriturapublicatext', NumeroALetras::convertirEscritura($cierr->nroescriturapublica));
$builder->setValue('dateescrituratextshort', strtoupper($dateescrituratextshort));
//$builder->setValue('dateescrituratext', strtoupper($dateescrituratext));
$poderdante_ids = $value->poderdante_ids;
        $p_ids = explode("-", $poderdante_ids);
        $apoderado_ids = $value->apoderado_ids;
        $ap_ids = explode("-", $apoderado_ids);
        $poderdante="";
        foreach ($p_ids as $key => $v) {
            # code...
            $cs = ClientesignoData::getById($v);
            $fullnamep = $cs->name. " ".$cs->lastname;
            if ($key <=0) {
                # code...
                $poderdante .=  "en esta Notaria ".strtoupper($fullnamep).", identifica con $cs->typeidentification número $cs->identification expedida en $cs->identificationexpedida";
            } else {
                # code...
                $poderdante .=  " y ".strtoupper($fullnamep).", identifica con $cs->typeidentification número $cs->identification expedida en $cs->identificationexpedida";
            }
        }
        $apoderado="";
        foreach ($ap_ids as $key => $j) {
            # code...
            $cs = ClientesignoData::getById($j);
            $fullnameap = $cs->name." ".$cs->lastname;
            if ($key <=0) {
                # code...
                $apoderado .=  "".strtoupper($fullnameap).", identifica $cs->typeidentification número $cs->identification expedida en $cs->identificationexpedida}";
            } else {
                # code...
                $apoderado .=  " y ".strtoupper($fullnameap).", identifica con $cs->typeidentification número $cs->identification expedida en $cs->identificationexpedida";
            }
        }








$builder->setValue('poderdante', $poderdante);
$builder->setValue('apoderado', strtoupper($cierr->apoderado));
$builder->setValue('solicitante', strtoupper($cierr->solicitante));
$builder->setValue('otorgotipo', strtoupper($cierr->otorgotipo));
$builder->setValue('observation', strtoupper($cierr->observation));
$builder->setValue('digitador', strtoupper($u->name));

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

$filename = "plantilla-".time()."-".$pathtemplate;
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
