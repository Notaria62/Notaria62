<?php

/********** INCLUDE DE LIBRERIAS ***************/

use PhpParser\Node\Stmt\TryCatch;

//include 'lib/mySoap/ConsultaTx.php';
//include 'beans/Includes.php';
include 'beans/VPOS_plugin.php';
include 'lib/mySoap/MySoap.php';
/***********************************************/

/********** DEFINICIÓN DE WSDL *****************/
//$wsdl = 'https://testecommerce.credibanco.com/vpos2/services/VPOS2RESULTTXSOAP/META-INF/VPOS2RESULTTXSOAP.wsdl';
//$wsdl = 'https://testecommerce.credibanco.com/recaudo/services/VPOS2RECAUDO?wsdl';
/***********************************************/

/********** REFERECIAS DE CERTIFICADOS *********/
// /*SEND*/
define('CRYPTO_PUBLIC_SEND', './certificates/LLAVE.VPOS.CRB.CRYPTO.1024.X509.txt');
define('FIRMA_PRIVATE_SEND', './certificates/notaria62web.firma.privada.txt');
/*RECIVE*/
define('SIGNATURE_PUBLIC_RECIVE', './certificates/LLAVE.VPOS.CRB.SIGN.1024.X509.txt');
define('CIFRADO_PRIVATE_RECIVE', './certificates/notaria62web.cifrado.privado.txt');
/***********************************************/



$array_send['acquirerId'] = "1";
$array_send['commerceId'] = "2407";
$array_send['purchaseOperationNumber'] = "ORF939393";
$array_send['fingerPrint'] = "ORF939393";

$array_send['purchaseAmount'] = "1000000";
$array_send['purchaseCurrencyCode'] = "170";
$array_send['purchaseTerminalCode'] = "00054111";
$array_send['purchasePlanId'] = "01";
$array_send['purchaseQuotaId'] = "012";
$array_send['purchaseIpAddress'] = get_client_ip();
$array_send['billingAddress'] = "Carrera 24#53-26";
$array_send['billingCity'] = "Bogota";
$array_send['billingState'] = "CO";
$array_send['billingCountry'] = "CO";
$array_send['billingPostalCode'] = "10311";
$array_send['billingPhoneNumber'] = "5712489296";
$array_send['billingEmail'] = "Notaria 62";
$array_send['billingFirstName'] = "Sistemas";
$array_send['billingLastName'] = "Notaria 62";
$array_send['purchaseLanguage'] = "SP"; //En español
$array_send['additionalObservations'] = "Pruebas de pago Notaria 62";
$array_send['billingCelPhoneNumber'] = "3208183419";
$array_send['billingGender'] = "M";
$array_send['billingNationality'] = "CO";
$array_send['shippingCountry'] = "CO";
$array_send['shippingCity'] = "Bogota";
$array_send['shippingAddress'] = "Carrera 24#53-26";
$array_send['shippingState'] = "CO";
$array_send['shippingPostalCode'] = "10311";
//$array_send['taxName'] = "TAX_NOTARIAL";
//$array_send['taxAmount'] = "0";



//Setear un arreglo de cadenas con los parámetros que serán devueltos //por el componente
$array_get['XMLREQ'] = "";
$array_get['DIGITALSIGN'] = "";
$array_get['SESSIONKEY'] = "";
$ipaddress = get_client_ip();
//Vector de inicialización
$VI = "8bb48c5a82288521";

/********** CIFRAR BEAN ********************/

$vpos = new VPOS_plugin();
try {

    //print_r($vpos);
    $vpos->VPOSSend($array_send, $array_get, CRYPTO_PUBLIC_SEND, FIRMA_PRIVATE_SEND, $VI);
    print_r($array_get);
    echo "<br>El VI:" . $VI;
} catch (SoapFault $fault) {
    print("Fault: " . $fault->faultstring . "\n");
    print("Fault code: " . $fault->detail->WebServiceException->code . "\n");
}



//Obtiene la IP del cliente

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>

<head>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="author" content="" />
</head>

<body class="">
    <form name="frmSolicitudPago" method="POST"
        action="https://testecommerce.credibanco.com/vpos2/MM/transactionStart20.do">
        <br>
        <br>
        <br>
        <br>
        <!-- acquirerId
        <input type="text" name="acquirerId" value="1"><br>
        commerceId
        <input type="text" name="commerceId" value="2407"><br>
         purchaseOperationNumber
        <input type="text" name="purchaseOperationNumber" value="ORF939393"><br>
        fingerPrint
        <input type="text" name="fingerPrint" value="ORF939393"><br>
        purchaseAmount
        <input type="text" name="purchaseAmount" value="1000000"><br>
        purchaseCurrencyCode
        <input type="text" name="purchaseCurrencyCode" value="170"><br>
        purchaseTerminalCode
        <input type="text" name="purchaseTerminalCode" value="00054111"><br>
        purchasePlanId
        <input type="text" name="purchasePlanId" value="01"><br>
        purchaseQuotaId
        <input type="text" name="purchaseQuotaId" value="012"><br>
        purchaseIpAddress
        <input type="text" name="purchaseIpAddress" value="<= $ipaddress ?>"><br>
        purchaseLanguage
        <input type="text" name="purchaseLanguage" value="SP"><br>
        additionalObservations
        <input type="text" name="additionalObservations" value="Pruebas de pago Notaria 62"><br>
        <hr />
        billingFirstName
        <input type="text" name="billingFirstName" value="SISTEMAS"><br>
        billingLastName
        <input type="text" name="billingLastName" value="NOTARIA 62"><br>
        billingCountry
        <input type="text" name="billingCountry" value="CO"><br>
        billingCity
        <input type="text" name="billingCity" value="Bogota"><br>
        billingState
        <input type="text" name="billingState" value="CO"><br>
        billingPostalCode
        <input type="text" name="billingPostalCode" value="10311"><br>
        billingAddress
        <input type="text" name="billingAddress" value="Cra 24 53 26"><br>
        billingPhoneNumber
        <input type="text" name="billingPhoneNumber" value="5712489296"><br>
        billingCelPhoneNumber
        <input type="text" name="billingCelPhoneNumber" value="3208183419"><br>
        billingGender
        <input type="text" name="billingGender" value="M"><br>
        billingEmail
        <input type="text" name="billingEmail" value="sistemas@notaria62bogota.com"><br>
        billingNationality
        <input type="text" name="billingNationality" value="CO"><br>

        <hr />
        < shippingReceiverName
        <input type="text" name="shippingReceiverName" value="shippingCountry"><br>
        shippingReceiverLastName
        <input type="text" name="shippingReceiverLastName" value="shippingReceiverLastName"><br>
        shippingReceiverIdentifier
        <input type="text" name="shippingReceiverIdentifier" value="shippingReceiverIdentifier"><br>
        shippingReceptionMethod
        <input type="text" name="shippingReceptionMethod" value="shippingReceptionMethod"><br> --
        shippingCountry
        <input type="text" name="shippingCountry" value="CO"><br>
        shippingCity
        <input type="text" name="shippingCity" value="Bogota"><br>
        shippingAddress
        <input type="text" name="shippingAddress" value="cr 24 53 26"><br>
        shippingState
        <input type="text" name="shippingState" value="CO"><br>
        shippingPostalCode
        <input type="text" name="shippingPostalCode" value="10311"><br>


        <hr />
        taxName
        <input type="text" name="taxName" value="TASA_NOTARIAL"><br>
        taxAmount
        <input type="text" name="taxAmount" value="0"><br> -->



        IDACQUIRER
        <input type="text" name="IDACQUIRER" value="1"><br>
        IDCOMMERCE
        <input type="text" name="IDCOMMERCE" value="2407"><br>
        TERMINALCODE
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        XMLREQ
        <input type="text" name="XMLREQ" value="<?= $array_get['XMLREQ']; ?>"><br>
        DIGITALSIGN
        <input type="text" name="DIGITALSIGN" value='<?= $array_get['DIGITALSIGN']; ?>'><br>
        SESSIONKEY
        <input type="text" name="SESSIONKEY" value="<?= $array_get['SESSIONKEY']; ?>"><br>
        <button type="submit" class="btn btn-primary">SEND</button>
    </form>

</body>

</html>