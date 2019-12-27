<?php

/********** INCLUDE DE LIBRERIAS ***************/

use PhpParser\Node\Stmt\TryCatch;

//include 'lib/mySoap/ConsultaTx.php';
//include 'beans/Includes.php';
include 'beans/vpos_plugin.php';
include 'lib/mySoap/MySoap.php';
/***********************************************/

/********** DEFINICIÓN DE WSDL *****************/
$wsdl = 'https://testecommerce.credibanco.com/vpos2/services/VPOS2RESULTTXSOAP/META-INF/VPOS2RESULTTXSOAP.wsdl';
/***********************************************/

/********** REFERECIAS DE CERTIFICADOS *********/
/*SEND*/
define('CRYPTO_PUBLIC_SEND', './certificates/LLAVE.VPOS.CRB.CRYPTO.1024.X509.txt');
define('FIRMA_PRIVATE_SEND', './certificates/notaria62bogota.firma.privada.txt');
/*RECIVE*/
define('SIGNATURE_PUBLIC_RECIVE', './certificates/LLAVE.VPOS.CRB.SIGN.1024.X509.txt');
define('CIFRADO_PRIVATE_RECIVE', './certificates/notaria62bogota.cifrado.privado.txt');
/***********************************************/
//echo "Paso";

//$se = new 
//echo "se: " . generateSessionKey();
//$consultaTx = new ConsultaTx();
//echo "paso 1";
//print_r($consultaTx);
//$vposConsulta = $consultaTx->consultaEstadoTx("10", "2408", "0000090", CRYPTO_PUBLIC_SEND, FIRMA_PRIVATE_SEND, SIGNATURE_PUBLIC_RECIVE, CIFRADO_PRIVATE_RECIVE, "2cb3a5f8b93dbb42", $wsdl);
//$vposConsulta = $consultaTx->consultaEstadoTx("1", "2407", "069467021", CRYPTO_PUBLIC_SEND, FIRMA_PRIVATE_SEND, SIGNATURE_PUBLIC_RECIVE, CIFRADO_PRIVATE_RECIVE, "2cb3a5f8b93dbb42", $wsdl);

// try {
//     //code...
//     //print_r($vposConsulta);
// } catch (\Throwable $th) {
//     throw $th;
// }




//Todos los parámetros del componente se colocan en un arreglo de
//cadenas, cuyo campo llave es el nombre del parámetro 
$array_send['acquirerId'] = "1";
$array_send['commerceId'] = "2407";
$array_send['purchaseAmount'] = "10000";
$array_send['purchaseCurrencyCode'] = "170";
$array_send['purchaseOperationNumber'] = "069467021";
$array_send['billingAddress'] = "cra. 24 #53-26";
$array_send['billingCity'] = "Boogta";
$array_send['billingState'] = "Boogta";
$array_send['billingCountry'] = "Colombia";
//$array_send['billingZIP'] = "10311";
//$array_send['billingPhone'] = "2489296";
//$array_send['billingEMail'] = "sistemas@notaria62bogota.com";
$array_send['billingFirstName'] = "Anderson";
$array_send['billingLastName'] = "Lugo";
//$array_send['language'] = 'SP'; //En español

//Setear un arreglo de cadenas con los parámetros que serán devueltos //por el componente
$array_get['XMLREQ'] = "";
$array_get['DIGITALSIGN'] = "";
$array_get['SESSIONKEY'] = "";
//Vector de inicialización
$VI = "0000000000000000";

/********** CIFRAR BEAN ********************/
//echo 'Cifrando datos comercio....' . "\n";
$vpos = new Vpos_plugin();
//$vposConsultaXML = new VPOSConsultaResp();
try {

    //print_r($vpos);
    //$vpos->VPOSSend($array_send, $array_get, CRYPTO_PUBLIC_SEND, FIRMA_PRIVATE_SEND, $VI);
    //print_r($array_get);


    if ($vpos->VPOSResponse($arrayIn, $arrayOut, SIGNATURE_PUBLIC_RECIVE, CIFRADO_PRIVATE_RECIVE, $VI)) {
        //La salida esta en $arrayOut con todos los parámetros decifrados devueltos por el VPOS
        print_r($arrayOut);
        $resultadoAutorizacion = $arrayOut['authorizationResult'];
        $codigoAutorizacion = $arrayOut['authorizationCode'];
    } else {
        echo "VPOSResponse false";
        //Puede haber un problema de mala configuración de las llaves, vector de //inicializacion o el VPOS no ha enviado valores correctos
    }
    //$vpos->VPOSSend($vposConsulta, $vposConsultaXML, CRYPTO_PUBLIC_SEND, FIRMA_PRIVATE_SEND, $vi);
} catch (SoapFault $fault) {
    print("Fault: " . $fault->faultstring . "\n");
    print("Fault code: " . $fault->detail->WebServiceException->code . "\n");
}
?>

<head>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="author" content="" />
</head>

<body class="">


</body>

</html>