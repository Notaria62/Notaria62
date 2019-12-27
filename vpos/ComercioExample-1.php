<?php

/********** INCLUDE DE LIBRERIAS ***************/
include 'lib/mySoap/ConsultaTx.php';
include 'beans/Includes.php';
/***********************************************/

/********** DEFINICIÓN DE WSDL *****************/
$wsdl = 'https://testecommerce.credibanco.com/vpos2/services/VPOS2RESULTTXSOAP/META-INF/VPOS2RESULTTXSOAP.wsdl';
//$wsdl = 'https://testecommerce.credibanco.com/recaudo/services/VPOS2RECAUDO?wsdl';
/***********************************************/

/********** REFERECIAS DE CERTIFICADOS *********/
/*SEND*/
define('CRYPTO_PUBLIC_SEND', './certificates/LLAVE.VPOS.CRB.CRYPTO.1024.X509.txt');
define('FIRMA_PRIVATE_SEND', './certificates/notaria62web.firma.privada.txt');
/*RECIVE*/
define('SIGNATURE_PUBLIC_RECIVE', './certificates/LLAVE.VPOS.CRB.SIGN.1024.X509.txt');
define('CIFRADO_PRIVATE_RECIVE', './certificates/notaria62web.cifrado.privado.txt');
/***********************************************/

$consultaTx = new ConsultaTx();
$vposConsulta = $consultaTx->consultaEstadoTx("1", "2407", "OR-F-7676", CRYPTO_PUBLIC_SEND, FIRMA_PRIVATE_SEND, SIGNATURE_PUBLIC_RECIVE, CIFRADO_PRIVATE_RECIVE, "fb9e5939f743b4e0", $wsdl);
print_r($vposConsulta);