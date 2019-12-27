<?php

require('soap-wsse.php');
require('WSASoap.php');

class MySoap extends SoapClient
{

    function __doRequest($request, $location, $saction, $version)
    {

        $doc = new DOMDocument('1.0');
        $doc->loadXML($request);

        $objWSA = new WSASoap($doc);
        $objWSA->addAction($saction);
        $objWSA->addTo($location);
        $objWSA->addMessageID();
        $objWSA->addReplyTo();

        $objWSSE = new WSSESoap($doc, FALSE);
        $objWSSE->signAllHeaders = FALSE;
        $objWSSE->addTimestamp();

        $respuestaVal = parent::__doRequest($objWSSE->saveXML(), $location, $saction, $version);

        $doc = new DOMDocument('1.0');
        $doc->loadXML($respuestaVal);

        return $doc->saveXML();
    }

    function procesarRespuestaConsulta($result)
    {
        $vposConsultaResponse = new VOPOSConsulta();
        $vposConsultaResponse->acquirerId = $result->acquirerId;
        $vposConsultaResponse->commerceId = $result->commerceId;

        $vposConsultaResponse->cipheredXML = $result->xmlRes;
        $vposConsultaResponse->cipheredSignature = $result->signature;
        $vposConsultaResponse->cipheredSessionKey = $result->sessionkey;
        print_r($vposConsultaResponse);
        return $vposConsultaResponse;
    }
}