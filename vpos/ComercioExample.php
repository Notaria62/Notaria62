<?php

/********** INCLUDE DE LIBRERIAS ***************/

use PhpParser\Node\Stmt\TryCatch;

include 'lib/mySoap/ConsultaTx.php';
include 'beans/Includes.php';
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
$consultaTx = new ConsultaTx();
//echo "paso 1";
//print_r($consultaTx);
//$vposConsulta = $consultaTx->consultaEstadoTx("10", "2408", "0000090", CRYPTO_PUBLIC_SEND, FIRMA_PRIVATE_SEND, SIGNATURE_PUBLIC_RECIVE, CIFRADO_PRIVATE_RECIVE, "2cb3a5f8b93dbb42", $wsdl);
$vposConsulta = $consultaTx->consultaEstadoTx("1", "2407", "", CRYPTO_PUBLIC_SEND, FIRMA_PRIVATE_SEND, SIGNATURE_PUBLIC_RECIVE, CIFRADO_PRIVATE_RECIVE, "2cb3a5f8b93dbb42", $wsdl);

try {
    //code...
    print_r($vposConsulta);
} catch (\Throwable $th) {
    throw $th;
}
?>

<head>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="author" content="" />
</head>

<body class="">
    <form name="frmSolicitudPago" method="post"
        action="https://testecommerce.credibanco.com/vpos2/MM/transactionStart20.do">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <input type="text" name="IDACQUIRER" value="1"><br>
        <input type="text" name="IDCOMMERCE" value="2407"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="purchaseOperationNumber" value="numero de order"><br>
        <input type="text" name="purchaseAmount" value="10000"><br>
        <input type="text" name="purchaseCurrencyCode" value="170"><br>
        <input type="text" name="purchaseTerminalCode" value="00054111"><br>
        <!-- <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br>
        <input type="text" name="TERMINALCODE" value="00054111"><br> -->
        <input type="text" name="XMLREQ" value="D2ZQMEg4c9qlxJE3r2u3Y8PXT7vZ 5JNkrY84pEg4c94c9hS14k9OUWk4Y1"><br>
        <input type="text" name="DIGITALSIGN"
            value="hS14k9OUWk4c9qldiN2vfBdjg4jB9 Wk4D2ZQMEg4c94c9qlOxVUg4yj2Q9atvfByY"><br>
        <input type="text" name="SESSIONKEY" value="S14k9OUWk"><br>
        <button type="submit" class="btn btn-primary">Primary</button>
    </form>

</body>

</html>