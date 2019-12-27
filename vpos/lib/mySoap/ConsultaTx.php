<?php

/********** INCLUDE DE LIBRERIAS ***************/
include 'MySoap.php';
/***********************************************/
class ConsultaTx
{
    function consultaEstadoTx($acquirerId, $commerceId, $numOrder, $rutaLlavePubCifrado, $rutaLlavePrivFirma, $rutaLlavePubFirma, $rutaLlavePrivCifrado, $vi, $wsdl)
    {
        try {
            echo 'Inicio proceso....' . "\n<br>";
            /********** CREACIÓN DE BEAN CON DATA ********************/
            echo 'Llenado datos comercio....' . "\n<br>";
            $vposConsulta = new VOPOSConsulta();
            $vposConsulta->acquirerId = $acquirerId;
            $vposConsulta->commerceId = $commerceId;
            //$vposConsulta->numOrder = $numOrder;

            $array_send['acquirerId'] = "1";
            $array_send['commerceId'] = "2407";
            $array_send['purchaseOperationNumber'] = "ORF939393";
            $array_send['fingerPrint'] = "ORF939393";

            $array_send['purchaseAmount'] = "1000000";
            $array_send['purchaseCurrencyCode'] = "170";
            $array_send['purchaseTerminalCode'] = "00054111";
            $array_send['purchasePlanId'] = "01";
            $array_send['purchaseQuotaId'] = "012";
            $array_send['purchaseIpAddress'] = "192.168.0.10";
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

            /********** CIFRAR BEAN ********************/
            echo 'Cifrando datos comercio....' . "\n<br>";;
            $vpos = new VPOS_plugin_consulta();
            $vposConsultaXML = new VPOSConsultaResp();
            print_r($vposConsultaXML);
            $vpos->VPOSSend($array_send, $vposConsultaXML, $rutaLlavePubCifrado, $rutaLlavePrivFirma, $vi);

            /********** INVOCACIÓN A WS Y PROCESO DE REPUESTA ********************/
            echo 'Conectando a WS....' . "\n<br>";
            //print_r($wsdl);
            $sClient = new MySoap($wsdl);
            //print_r($vposConsultaXML);
            echo "<br>";
            $sClient->__setLocation($wsdl);
            var_dump($sClient);

            echo "<h1> FUNCIONES DISPONIBLES </h1>";
            echo '<pre>';
            $functiones = $sClient->__getFunctions();
            $getTypes = $sClient->__getTypes();
            var_dump($getTypes);
            var_dump($functiones);
            echo '</pre>';





            $old_location = $sClient->__setLocation();
            var_dump($vposConsultaXML);
            echo "<br>";
            $result = $sClient->search($vposConsultaXML);
            print_r($result);
            echo "<br>";
            $vposConsultaResponse = $sClient->procesarRespuestaConsulta($result);
            // print_r($vposConsultaResponse);

            /********** DECIFRAR RESPUESTA ********************/
            echo 'Decifrando Respuesta....' . "\n<br>";
            $vpos->VPOSResponse($vposConsultaResponse, $vposConsulta, $rutaLlavePubFirma, $rutaLlavePrivCifrado, $vi);
            echo "Fin proceso...." . "\n";

            return $vposConsulta;
        } catch (SoapFault $fault) {
            print("Fault: " . $fault->faultstring . "\n<br>");
            print("Fault code: " . $fault->detail->WebServiceException->code . "\n<br>");
        }
    }
}