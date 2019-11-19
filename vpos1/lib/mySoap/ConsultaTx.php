<?php

    /********** INCLUDE DE LIBRERIAS ***************/
    include 'MySoap.php';      
    /***********************************************/
class ConsultaTx{
    
    function consultaEstadoTx($acquirerId, $commerceId, $numOrder, $rutaLlavePubCifrado, $rutaLlavePrivFirma, $rutaLlavePubFirma, $rutaLlavePrivCifrado, $vi, $wsdl) {
        
        try {                         
            echo 'Inicio proceso....'."\n";            
            /********** CREACIÓN DE BEAN CON DATA ********************/
            echo 'Llenado datos comercio....'."\n";;
            $vposConsulta = new VOPOSConsulta();
            $vposConsulta->acquirerId=$acquirerId;
            $vposConsulta->commerceId=$commerceId;
            $vposConsulta->numOrder=$numOrder;

            /********** CIFRAR BEAN ********************/
            echo 'Cifrando datos comercio....'."\n";;
            $vpos = new VPOS_plugin_consulta();         
            $vposConsultaXML = new VPOSConsultaResp();        
            $vpos->VPOSSend($vposConsulta,$vposConsultaXML, $rutaLlavePubCifrado, $rutaLlavePrivFirma,$vi);               

            /********** INVOCACIÓN A WS Y PROCESO DE REPUESTA ********************/
            echo 'Conectando a WS....'."\n";
            $sClient = new MySoap($wsdl);
            $sClient->__setLocation($wsdl);
            $result = $sClient->search($vposConsultaXML); 
            $vposConsultaResponse = $sClient->procesarRespuestaConsulta($result);      

            /********** DECIFRAR RESPUESTA ********************/
            echo 'Decifrando Respuesta....'."\n";
            $vpos->VPOSResponse($vposConsultaResponse,$vposConsulta, $rutaLlavePubFirma, $rutaLlavePrivCifrado,$vi); 
            echo "Fin proceso...."."\n";
            
            return $vposConsulta;

        } catch (SoapFault $fault) {
            print("Fault: " . $fault->faultstring . "\n");
            print("Fault code: " . $fault->detail->WebServiceException->code . "\n");            
        }
        
    }     
    
}    
?>
