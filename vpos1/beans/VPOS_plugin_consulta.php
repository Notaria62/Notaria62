<?php

    class VPOS_plugin_consulta{

	function createXMLPHP5($arreglo){
            $camposValidos_envio = array(
            'acquirerId',
            'commerceId',
            'numOrder',
            'cipheredSessionKey',
            'cipheredXML',
            'cipheredSignature',
            'clearXML',
            'validSign',
            'authorizationCode',
            'errorCode',
            'errorMessage',
            'authorizationResult',
            'cardNumber',
	    'cardType',
	    'planCode',
	    'quotaCode',
            'xmlResponse',
            );

            $dom = new DOMDocument('1.0', 'iso-8859-1');
            $raiz = $dom->createElement('VPOSTransaction1.2');
            $dom->appendChild($raiz);

            foreach($arreglo as $key => $value){
                if(in_array($key,$camposValidos_envio)){
                        $arrayTemp[$key] = $value;
                }else{
                    die($key.' is not allowed in plugin ');
                }
            }

            foreach($arrayTemp as $key => $value){
                $elem = new DOMElement($key,$value);
                $raiz -> appendChild($elem);
            }

            return $dom->saveXML();
	}

	function VPOSSend($arrayIn,$arrayOut,$llavePublicaCifrado,$llavePrivadaFirma,$VI){
            $veractual = phpversion();
            $vpos=new VPOS_plugin_consulta();

            if(version_compare($veractual,"5.0")<0){
                die('PHP version is '.$veractual.'and should be >=5.0');
            }

            $xmlSalida = $vpos->createXMLPHP5($arrayIn);
            //Genera la firma Digital

            $contenidoLlavePrivada = $vpos->leer_fichero_completo($llavePrivadaFirma);
            $firmaDigital = $vpos->BASE64URL_digital_generate($xmlSalida,$contenidoLlavePrivada);

            //Ya se genero el XML y se genera la llave de sesion
            $llavesesion = $vpos->generateSessionKey();

            //Se cifra el XML con la llave generada
            $xmlCifrado = $vpos->BASE64URL_symmetric_cipher($xmlSalida,$llavesesion,$VI);

            if(!$xmlCifrado) return null;

            //Se cifra la llave de sesion con la llave publica dada
//            $contenidoLlavePublica = $vpos->leer_fichero_completo($llavePublicaCifrado);
            $contenidoLlavePublica = $vpos->leer_fichero_completo($llavePublicaCifrado);
            $llaveSesionCifrada = $vpos->BASE64URLRSA_encrypt($llavesesion,$contenidoLlavePublica);

            if(!$llaveSesionCifrada) return null;

            if(!$firmaDigital) return null;

            $arrayOut->acquirerId= $arrayIn->acquirerId;
            $arrayOut->commerceId= $arrayIn->commerceId;
            $arrayOut->sessionkey= $llaveSesionCifrada;
            $arrayOut->xml = $xmlCifrado;
            $arrayOut->signature= $firmaDigital;

            return true;
	}

 	function VPOSResponse($arrayIn,&$arrayOut,$llavePublicaFirma,$llavePrivadaCifrado,$VI){

            $vpos=new VPOS_plugin_consulta();

            $veractual = phpversion();

            if(version_compare($veractual,"5.0")<0){
                trigger_error('La version de PHP es menor a la 5.0', E_USER_ERROR);
                return false;
            }

            if($arrayIn->cipheredSessionKey==null
                    || $arrayIn->cipheredXML==null
                    || $arrayIn->cipheredSignature == null){
                            return false;
            }

            $contenidoLlavePrivada = $vpos->leer_fichero_completo($llavePrivadaCifrado);
            $llavesesion = $vpos->BASE64URLRSA_decrypt($arrayIn->cipheredSessionKey,$contenidoLlavePrivada);

            $xmlDecifrado = $vpos->BASE64URL_symmetric_decipher($arrayIn->cipheredXML,$llavesesion,$VI);

            $contenidoLlavePublica = $vpos->leer_fichero_completo($llavePublicaFirma);
            $validation = $vpos->BASE64URL_digital_verify($xmlDecifrado,$arrayIn->cipheredSignature,$contenidoLlavePublica);

            $arrayOut = $vpos->parseXMLPHP5($xmlDecifrado);
            return true;

 	}

        function leer_fichero_completo($nombre_fichero){
           //abrimos el archivo de texto y obtenemos el identificador
           $fichero_texto = fopen ($nombre_fichero, "r");
           //obtenemos de una sola vez todo el contenido del fichero
           //OJO! Debido a filesize(), sólo funcionará con archivos de texto
           $contenido_fichero = fread($fichero_texto, filesize($nombre_fichero));
           return $contenido_fichero;
        }

	function is_num($s) {
            for ($i=0; $i<strlen($s); $i++) {
                    if (($s[$i]<'0') or ($s[$i]>'9')) {return false;}
            }
            return true;
	}

 	function generateSessionKey(){
            srand((double)microtime()*1000000);
            return mcrypt_create_iv(16,MCRYPT_RAND);
 	}

	function BASE64URLRSA_encrypt ($valor,$publickey) {
            if (!($pubres = openssl_pkey_get_public($publickey))){
                    die("Public key is not valid encrypt");
            }
            $salida = "";
            $resp = openssl_public_encrypt($valor,$salida,$pubres,OPENSSL_PKCS1_PADDING);
            openssl_free_key($pubres);
            if($resp){
                    $base64 = base64_encode($salida);
                    $base64 = preg_replace('/(\\/)/','_',$base64);
                    $base64 = preg_replace('/(\+)/','-',$base64);
                    $base64 = preg_replace('/(=)/','.',$base64);

                    return $base64;
            }
            else{
                    die('RSA Ciphering could not be executed');
            }
	}

	function BASE64URLRSA_decrypt($valor,$privatekey){
            if (!($privres = openssl_pkey_get_private(array($privatekey,null)))){
                   die('Invalid private RSA key has been given');

            }

           $salida = "";

           $pas = preg_replace('/_/','/',$valor);
           $pas = preg_replace('/-/','+',$pas);
           $pas = preg_replace('/\./','=',$pas);

           $temp = base64_decode($pas);

           $resp = openssl_private_decrypt($temp,$salida,$privres,OPENSSL_PKCS1_PADDING);

           openssl_free_key($privres);

           if($resp){
                   return $salida;
           }else{
                   die('RSA deciphering was not succesful');

           }

	}

	function BASE64URL_symmetric_cipher($dato, $key, $vector){
            $tamVI = strlen($vector);

            if($tamVI != 16){
                    trigger_error('Initialization Vector must have 16 hexadecimal characters', E_USER_ERROR);

                    return null;
            }

            if(strlen($key) != 16){
                    trigger_error("Simetric Key doesn't have length of 16", E_USER_ERROR);

                    return null;
            }

            $binvi = pack("H*", $vector);

            if($binvi == null){
                    trigger_error("Initialization Vector is not valid, must contain only hexadecimal characters", E_USER_ERROR);
                    return null;

            }

            $key .= substr($key,0,8); // agrega los primeros 8 bytes al final

            $text = $dato;
            $block = mcrypt_get_block_size('tripledes', 'cbc');
            $len = strlen($text);
            $padding = $block - ($len % $block);
            $text .= str_repeat(chr($padding),$padding);

            $crypttext = mcrypt_encrypt(MCRYPT_3DES, $key, $text, MCRYPT_MODE_CBC, $binvi);

            $crypttext = base64_encode($crypttext);
            $crypttext = preg_replace('/(\\/)/','_',$crypttext);
            $crypttext = preg_replace('/(\+)/','-',$crypttext);
            $crypttext = preg_replace('/(=)/','.',$crypttext);

            return $crypttext;
	}

	//-------------------------------------------------------------------------------------
	// Esta funcion se encarga de desencriptar los datos recibidos del MPI
	// Recibe como parametro el dato a desencriptar
	//-------------------------------------------------------------------------------------
	function BASE64URL_symmetric_decipher($dato, $key, $vector)
	{
            $tamVI = strlen($vector);

            if($tamVI != 16){
                    trigger_error("Initialization Vector must have 16 hexadecimal characters", E_USER_ERROR);
                    return null;
            }
            if(strlen($key) != 16){
                    trigger_error("Simetric Key doesn't have length of 16", E_USER_ERROR);

                    return null;
            }

            $binvi = pack("H*", $vector);

            if($binvi == null){
                    trigger_error("Initialization Vector is not valid, must contain only hexadecimal characters", E_USER_ERROR);

                    return null;

            }
            $key .= substr($key,0,8); // agrega los primeros 8 bytes al final

            $pas = preg_replace('/_/','/',$dato);
            $pas = preg_replace('/-/','+',$pas);
            $pas = preg_replace('/\./','=',$pas);

            $crypttext = base64_decode($pas);

            $crypttext2 = mcrypt_decrypt(MCRYPT_3DES, $key, $crypttext, MCRYPT_MODE_CBC, $binvi);


            $block = mcrypt_get_block_size('tripledes', 'cbc');
            $packing = ord($crypttext2{strlen($crypttext2) - 1});
            if($packing and ($packing < $block))
            {
                    for($P = strlen($crypttext2) - 1; $P >= strlen($crypttext2) - $packing; $P--)
                    {
                            if(ord($crypttext2{$P}) != $packing)
                            {
                                    $packing = 0;
                            }
                    }
            }

            $crypttext2 = substr($crypttext2,0,strlen($crypttext2) - $packing);
            return $crypttext2;
	}

	//-------------------------------------------------------------------------------------
	// Esta funcion se encarga de generar una firma digital de $dato usando
	// la llave privada en $privatekey
	//-------------------------------------------------------------------------------------

 	function BASE64URL_digital_generate($dato, $privatekey)
 	{
            $privres = openssl_pkey_get_private(array($privatekey,null));

            if (!$privres)
             {
                    die("Private key is not valid");

             }

            $firma = "";

            $resp = openssl_sign($dato,$firma,$privres);

            openssl_free_key($privres);

            if($resp){

                    $base64 = base64_encode($firma);

                    $crypttext = preg_replace('/(\\/)/' ,'_',$base64);
                    $crypttext = preg_replace('/(\+)/','-',$crypttext);
                    $crypttext = preg_replace('/(=)/' ,'.',$crypttext);

                    //$urlencoded = urlencode($base64);
                    return $crypttext;
            }
            else{
            die("RSA Signature was unsuccesful");
            }

 	}

 	function BASE64URL_digital_verify($dato,$firma, $publickey){

            if (!($pubres = openssl_pkey_get_public($publickey))){
                    die("Public key is not valid");
            }

            $pas = preg_replace('/_/','/',$firma);
            $pas = preg_replace('/-/','+',$pas);
            $pas = preg_replace('/\./','=',$pas);


            //echo "<br> => ".$publickey;
            //echo "<br> => ".$pas;

            $temp = base64_decode($pas);

            $resp = openssl_verify($dato,$temp,$pubres);
            //echo "<br> => ".$dato;
            //echo "<br> => ".$temp;
            //echo "<br> => ".$pubres;
            //echo "<br> => ".$resp;
            openssl_free_key($pubres);

            return $resp;
 	}

	function parseXMLPHP5($xml){

            $arregloSalida = array();

            $dom = new DOMDocument();
            $dom->loadXML($xml);

            $raiz = $dom->getElementsByTagName('VPOSTransaction1.2')->item(0);

            $nodoHijo = null;
            if($raiz->hasChildNodes()){
                    $nodoHijo = $raiz->firstChild;
                    $arregloSalida[$nodoHijo->nodeName] = $nodoHijo->nodeValue;
            }

            while (($nodoHijo=$nodoHijo->nextSibling)!=null) {
                    $i = 1;
                    if(strcmp($nodoHijo->nodeName,'taxes')==0){
                            if($nodoHijo->hasChildNodes()){
                                    echo "<br> => ".$nodoHijo->nodeName;
                                    $nodoTax = $nodoHijo->firstChild;
                                    $arregloSalida['tax_'.$i.'_name'] = $nodoTax->getAttribute('name');
                                    $arregloSalida['tax_'.$i.'_amount'] = $nodoTax->getAttribute('amount');
                                    $i++;

                                    while (($nodoTax=$nodoTax->nextSibling)!=null) {
                                            $arregloSalida['tax_'.$i.'_name'] = $nodoTax->getAttribute('name');
                                            $arregloSalida['tax_'.$i.'_amount'] = $nodoTax->getAttribute('amount');
                                            $i++;
                                    }
                            }

                    }else if(strcmp($nodoHijo->nodeName,'product')==0){
                            if($nodoHijo->hasChildNodes()){
                                    $nodoProd = $nodoHijo->firstChild;
                                    $arregloSalida['prod_'.$i.'_item'] = $nodoProd->getAttribute('productItem');
                                    $arregloSalida['prod_'.$i.'_code'] = $nodoProd->getAttribute('productCode');
                                    $arregloSalida['prod_'.$i.'_amount'] = $nodoProd->getAttribute('productAmount');
                                    $arregloSalida['prod_'.$i.'_promotionCode'] = $nodoProd->getAttribute('productPromotionCode');
                                    $i++;

                                    while (($nodoProd=$nodoProd->nextSibling)!=null) {
                                            $arregloSalida['prod_'.$i.'_item'] = $nodoProd->getAttribute('productItem');
                                            $arregloSalida['prod_'.$i.'_code'] = $nodoProd->getAttribute('productCode');
                                            $arregloSalida['prod_'.$i.'_amount'] = $nodoProd->getAttribute('productAmount');
                                            $arregloSalida['prod_'.$i.'_promotionCode'] = $nodoProd->getAttribute('productPromotionCode');
                                            $i++;
                                    }
                            }

                    }else if(strcmp($nodoHijo->nodeName,'airport')==0){
                            if($nodoHijo->hasChildNodes()){
                                    $nodoAir = $nodoHijo->firstChild;
                                    $arregloSalida['air_'.$i.'_code'] = $nodoAir->getAttribute('airportCode');
                                    $arregloSalida['air_'.$i.'_city'] = $nodoAir->getAttribute('airportCity');
                                    $arregloSalida['air_'.$i.'_country'] = $nodoAir->getAttribute('airportCountry');
                                    $i++;

                                    while (($nodoAir=$nodoAir->nextSibling)!=null) {
                                            $arregloSalida['air_'.$i.'_code'] = $nodoAir->getAttribute('airportCode');
                                            $arregloSalida['air_'.$i.'_city'] = $nodoAir->getAttribute('airportCity');
                                            $arregloSalida['air_'.$i.'_country'] = $nodoAir->getAttribute('airportCountry');
                                            $i++;
                                    }
                            }

                    }else if(strcmp($nodoHijo->nodeName,'flight')==0){
                            if($nodoHijo->hasChildNodes()){
                                    $nodoFli = $nodoHijo->firstChild;
                                    $arregloSalida['fli_'.$i.'_airlineCode'] = $nodoFli->getAttribute('flightAirlineCode');
                                    $arregloSalida['fli_'.$i.'_departureAirport'] = $nodoFli->getAttribute('flightDepartureAirport');
                                    $arregloSalida['fli_'.$i.'_arriveAirport'] = $nodoFli->getAttribute('flightArriveAirport');
                                    $arregloSalida['fli_'.$i.'_departureDate'] = $nodoFli->getAttribute('flightDepartureDate');
                                    $arregloSalida['fli_'.$i.'_departureTime'] = $nodoFli->getAttribute('flightDepartureTime');
                                    $arregloSalida['fli_'.$i.'_arriveDate'] = $nodoFli->getAttribute('flightArriveDate');
                                    $arregloSalida['fli_'.$i.'_arriveTime'] = $nodoFli->getAttribute('flightArriveTime');
                                    $arregloSalida['fli_'.$i.'_reservation'] = $nodoFli->getAttribute('flightReservation');
                                    $arregloSalida['fli_'.$i.'_departureIata'] = $nodoFli->getAttribute('flightDepartureIata');
                                    $arregloSalida['fli_'.$i.'_arriveIata'] = $nodoFli->getAttribute('flightArriveIata');
                                    $i++;

                                    while (($nodoFli=$nodoFli->nextSibling)!=null) {
                                            $arregloSalida['fli_'.$i.'_airlineCode'] = $nodoFli->getAttribute('flightAirlineCode');
                                            $arregloSalida['fli_'.$i.'_departureAirport'] = $nodoFli->getAttribute('flightDepartureAirport');
                                            $arregloSalida['fli_'.$i.'_arriveAirport'] = $nodoFli->getAttribute('flightArriveAirport');
                                            $arregloSalida['fli_'.$i.'_departureDate'] = $nodoFli->getAttribute('flightDepartureDate');
                                            $arregloSalida['fli_'.$i.'_departureTime'] = $nodoFli->getAttribute('flightDepartureTime');
                                            $arregloSalida['fli_'.$i.'_arriveDate'] = $nodoFli->getAttribute('flightArriveDate');
                                            $arregloSalida['fli_'.$i.'_arriveTime'] = $nodoFli->getAttribute('flightArriveTime');
                                            $arregloSalida['fli_'.$i.'_reservation'] = $nodoFli->getAttribute('flightReservation');
                                            $arregloSalida['fli_'.$i.'_departureIata'] = $nodoFli->getAttribute('flightDepartureIata');
                                            $arregloSalida['fli_'.$i.'_arriveIata'] = $nodoFli->getAttribute('flightArriveIata');
                                            $i++;
                                    }

                            }

                    }else if(strcmp($nodoHijo->nodeName,'passenger')==0){
                            if($nodoHijo->hasChildNodes()){
                                    $nodoPass = $nodoHijo->firstChild;
                                    $arregloSalida['pass_'.$i.'_firstName'] = $nodoPass->getAttribute('passengerFirstName');
                                    $arregloSalida['pass_'.$i.'_lastName'] = $nodoPass->getAttribute('passengerLastName');
                                    $arregloSalida['pass_'.$i.'_documentType'] = $nodoPass->getAttribute('passengerDocumentType');
                                    $arregloSalida['pass_'.$i.'_documentNumber'] = $nodoPass->getAttribute('passengerDocumentNumber');
                                    $arregloSalida['pass_'.$i.'_agencyGoodCode'] = $nodoPass->getAttribute('passengerAgencyCode');
                                    $i++;

                                    while (($nodoPass=$nodoPass->nextSibling)!=null) {
                                            $arregloSalida['pass_'.$i.'_firstName'] = $nodoPass->getAttribute('passengerFirstName');
                                            $arregloSalida['pass_'.$i.'_lastName'] = $nodoPass->getAttribute('passengerLastName');
                                            $arregloSalida['pass_'.$i.'_documentType'] = $nodoPass->getAttribute('passengerDocumentType');
                                            $arregloSalida['pass_'.$i.'_documentNumber'] = $nodoPass->getAttribute('passengerDocumentNumber');
                                            $arregloSalida['pass_'.$i.'_agencyGoodCode'] = $nodoPass->getAttribute('passengerAgencyCode');
                                            $i++;
                                    }
                            }

                    }else if(strcmp($nodoHijo->nodeName,'good')==0){
                            if($nodoHijo->hasChildNodes()){
                                    $nodoGood = $nodoHijo->firstChild;
                                    $arregloSalida['good_'.$i.'_name'] = $nodoGood->getAttribute('goodName');
                                    $arregloSalida['good_'.$i.'_description'] = $nodoGood->getAttribute('goodDescription');
                                    $arregloSalida['good_'.$i.'_quantity'] = $nodoGood->getAttribute('goodQuantity');
                                    $arregloSalida['good_'.$i.'_unitprice'] = $nodoGood->getAttribute('goodUnitprice');
                                    $i++;

                                    while (($nodoGood=$nodoGood->nextSibling)!=null) {
                                            $arregloSalida['good_'.$i.'_name'] = $nodoGood->getAttribute('goodName');
                                            $arregloSalida['good_'.$i.'_description'] = $nodoGood->getAttribute('goodDescription');
                                            $arregloSalida['good_'.$i.'_quantity'] = $nodoGood->getAttribute('goodQuantity');
                                            $arregloSalida['good_'.$i.'_unitprice'] = $nodoGood->getAttribute('goodUnitprice');
                                            $i++;
                                    }
                            }

                    }else {
                            $arregloSalida[$nodoHijo->nodeName] = $nodoHijo->nodeValue;
                    }

            }



            return $arregloSalida;
	}
    }
?>