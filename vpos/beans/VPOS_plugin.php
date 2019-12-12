<?php

class VPOS_plugin
{
	function createXMLPHP5($arreglo)
	{
		$camposValidos_envio = array(
			'acquirerId',
			'commerceId',
			'purchaseCurrencyCode',
			'purchaseAmount',
			'purchaseOperationNumber',
			'billingAddress',
			'billingCity',
			'billingCountry',
			'billingPhoneNumber',
			'billingEmail',
			'billingFirstName',
			'billingLastName',
			'purchaseLanguage',
			'purchaseIpAddress',
			'purchaseTerminalCode',
			'purchasePlanId',
			'purchaseQuotaId',
			'HTTPSessionId',
			'reserved1',
			'reserved2',
			'reserved3',
			'reserved4',
			'reserved5',
			'reserved6',
			'reserved7',
			'reserved8',
			'reserved9',
			'reserved10',
			'reserved11',
			'reserved12',
			'reserved13',
			'reserved14',
			'reserved15',
			'reserved16',
			'reserved17',
			'reserved18',
			'reserved19',
			'reserved20',
			'reserved21',
			'reserved22',
			'reserved23',
			'reserved24',
			'reserved25',
			'reserved26',
			'reserved27',
			'reserved28',
			'reserved29',
			'reserved30',
			'reserved31',
			'reserved32',
			'reserved33',
			'reserved34',
			'reserved35',
			'reserved36',
			'reserved37',
			'reserved38',
			'reserved39',
			'reserved40',
			'purchaseShippingCharges',
			'purchaseShipperCode',
			'purchaseIva',
			'purchaseIvaReturn',
			'billingCelPhoneNumber',
			'billingGender',
			'billingBirthday',
			'billingOutIdentifierCity',
			'billingDateIdentifierDate',
			'billingNationality',
			'fingerPrint',
			'transactionTrace',
			'shippingReceptionMethod',
			'shippingReceiverName',
			'shippingReceiverLastName',
			'shippingReceiverIdentifier',
			'shippingCountry',
			'shippingCity',
			'shippingState',
			'shippingPostalCode',
			'shippingAddress',
			'additionalObservations',
			'cardNumber',
			'cardType',
			'planCode',
			'quotaCode',
			'xmlResponse',
			'xmlSend',
			'billingState',
			'billingPostalCode'
		);



		$arrayTemp = array();
		$taxesName = array();
		$taxesAmount = array();

		$productItem = array();
		$productCode = array();
		$productAmount = array();
		$productPromotionCode = array();


		$flightAirlineCode = array();
		$flightDepartureAirport = array();
		$flightArriveAirport = array();
		$flightDepartureDate = array();
		$flightDepartureTime = array();
		$flightArriveDate = array();
		$flightArriveTime = array();
		$flightReservation = array();
		$flightDepartureIata = array();
		$flightArriveIata = array();

		$passengerFirstName = array();
		$passengerLastName = array();
		$passengerDocumentType = array();
		$passengerDocumentNumber = array();
		$passengerAgencyGoodCode = array();

		$airportCode = array();
		$airportCity = array();
		$airportCountry = array();

		$goodName = array();
		$goodDescription = array();
		$goodQuantity = array();
		$goodUnitprice = array();

		$dom = new DOMDocument('1.0', 'iso-8859-1');

		$raiz = $dom->createElement('VPOSTransaction1.2');
		$dom->appendChild($raiz);

		foreach ($arreglo as $key => $value) {
			if (in_array($key, $camposValidos_envio)) {
				$arrayTemp[$key] = $value;
			} else if (preg_match('/tax_([0-9]{1}|[0-9]{2})_name/', $key)) {
				$keyam = preg_replace('/(^tax_)|(_name$)/', '', $key);
				$taxesName[$keyam] = $value;
				//array_push($taxesName,array($keyam => $value));
			} else if (preg_match('/tax_([0-9]{1}|[0-9]{2})_amount/', $key)) {
				$keyam = preg_replace('/(^tax_)|(_amount$)/', '', $key);
				$taxesAmount[$keyam] = $value;
				//array_push($taxesAmount,array($keyam => $value));
			} else if (preg_match('/prod_([0-9]{1}|[0-9]{2})_item/', $key)) {
				$keyam = preg_replace('/(^prod_)|(_item$)/', '', $key);
				$productItem[$keyam] = $value;
			} else if (preg_match('/prod_([0-9]{1}|[0-9]{2})_code/', $key)) {
				$keyam = preg_replace('/(^prod_)|(_code$)/', '', $key);
				$productCode[$keyam] = $value;
			} else if (preg_match('/prod_([0-9]{1}|[0-9]{2})_amount/', $key)) {
				$keyam = preg_replace('/(^prod_)|(_amount$)/', '', $key);
				$productAmount[$keyam] = $value;
			} else if (preg_match('/prod_([0-9]{1}|[0-9]{2})_promotionCode/', $key)) {
				$keyam = preg_replace('/(^prod_)|(_promotionCode$)/', '', $key);
				$productPromotionCode[$keyam] = $value;
			} else if (preg_match('/fli_([0-9]{1}|[0-9]{2})_airlineCode/', $key)) {
				$keyam = preg_replace('/(^fli_)|(_airlineCode$)/', '', $key);
				$flightAirlineCode[$keyam] = $value;
			} else if (preg_match('/fli_([0-9]{1}|[0-9]{2})_departureAirport/', $key)) {
				$keyam = preg_replace('/(^fli_)|(_departureAirport$)/', '', $key);
				$flightDepartureAirport[$keyam] = $value;
			} else if (preg_match('/fli_([0-9]{1}|[0-9]{2})_arriveAirport/', $key)) {
				$keyam = preg_replace('/(^fli_)|(_arriveAirport$)/', '', $key);
				$flightArriveAirport[$keyam] = $value;
			} else if (preg_match('/fli_([0-9]{1}|[0-9]{2})_departureDate/', $key)) {
				$keyam = preg_replace('/(^fli_)|(_departureDate$)/', '', $key);
				$flightDepartureDate[$keyam] = $value;
			} else if (preg_match('/fli_([0-9]{1}|[0-9]{2})_departureTime/', $key)) {
				$keyam = preg_replace('/(^fli_)|(_departureTime$)/', '', $key);
				$flightDepartureTime[$keyam] = $value;
			} else if (preg_match('/fli_([0-9]{1}|[0-9]{2})_arriveDate/', $key)) {
				$keyam = preg_replace('/(^fli_)|(_arriveDate$)/', '', $key);
				$flightArriveDate[$keyam] = $value;
			} else if (preg_match('/fli_([0-9]{1}|[0-9]{2})_arriveTime/', $key)) {
				$keyam = preg_replace('/(^fli_)|(_arriveTime$)/', '', $key);
				$flightArriveTime[$keyam] = $value;
			} else if (preg_match('/fli_([0-9]{1}|[0-9]{2})_reservation/', $key)) {
				$keyam = preg_replace('/(^fli_)|(_reservation$)/', '', $key);
				$flightReservation[$keyam] = $value;
			} else if (preg_match('/fli_([0-9]{1}|[0-9]{2})_departureIata/', $key)) {
				$keyam = preg_replace('/(^fli_)|(_departureIata$)/', '', $key);
				$flightDepartureIata[$keyam] = $value;
			} else if (preg_match('/fli_([0-9]{1}|[0-9]{2})_arriveIata/', $key)) {
				$keyam = preg_replace('/(^fli_)|(_arriveIata$)/', '', $key);
				$flightArriveIata[$keyam] = $value;
			} else if (preg_match('/pass_([0-9]{1}|[0-9]{2})_firstName/', $key)) {
				$keyam = preg_replace('/(^pass_)|(_firstName$)/', '', $key);
				$passengerFirstName[$keyam] = $value;
			} else if (preg_match('/pass_([0-9]{1}|[0-9]{2})_lastName/', $key)) {
				$keyam = preg_replace('/(^pass_)|(_lastName$)/', '', $key);
				$passengerLastName[$keyam] = $value;
			} else if (preg_match('/pass_([0-9]{1}|[0-9]{2})_documentType/', $key)) {
				$keyam = preg_replace('/(^pass_)|(_documentType$)/', '', $key);
				$passengerDocumentType[$keyam] = $value;
			} else if (preg_match('/pass_([0-9]{1}|[0-9]{2})_documentNumber/', $key)) {
				$keyam = preg_replace('/(^pass_)|(_documentNumber$)/', '', $key);
				$passengerDocumentNumber[$keyam] = $value;
			} else if (preg_match('/pass_([0-9]{1}|[0-9]{2})_agencyGoodCode/', $key)) {
				$keyam = preg_replace('/(^pass_)|(_agencyGoodCode$)/', '', $key);
				$passengerAgencyGoodCode[$keyam] = $value;
			} else if (preg_match('/good_([0-9]{1}|[0-9]{2})_name/', $key)) {
				$keyam = preg_replace('/(^good_)|(_name$)/', '', $key);
				$goodName[$keyam] = $value;
			} else if (preg_match('/good_([0-9]{1}|[0-9]{2})_description/', $key)) {
				$keyam = preg_replace('/(^good_)|(_description$)/', '', $key);
				$goodDescription[$keyam] = $value;
			} else if (preg_match('/good_([0-9]{1}|[0-9]{2})_quantity/', $key)) {
				$keyam = preg_replace('/(^good_)|(_quantity$)/', '', $key);
				$goodQuantity[$keyam] = $value;
			} else if (preg_match('/good_([0-9]{1}|[0-9]{2})_unitprice/', $key)) {
				$keyam = preg_replace('/(^good_)|(_unitprice$)/', '', $key);
				$goodUnitprice[$keyam] = $value;
			} else if (preg_match('/air_([0-9]{1}|[0-9]{2})_code/', $key)) {
				$keyam = preg_replace('/(^air_)|(_code$)/', '', $key);
				$airportCode[$keyam] = $value;
			} else if (preg_match('/air_([0-9]{1}|[0-9]{2})_city/', $key)) {
				$keyam = preg_replace('/(^air_)|(_city$)/', '', $key);
				$airportCity[$keyam] = $value;
			} else if (preg_match('/air_([0-9]{1}|[0-9]{2})_country/', $key)) {
				$keyam = preg_replace('/(^air_)|(_country$)/', '', $key);
				$airportCountry[$keyam] = $value;
			} else {
				die($key . ' is not allowed in plugin ');
			}
		}


		// foreach ($arrayTemp as $key => $value) {
		// 	$elem = new DOMElement($key, $value,'utf-8');
		// 	$raiz->appendChild($elem);
		// }

		// if (count($taxesName) > 0) {
		// 	$elem = $raiz->appendChild(new DOMElement('taxes',));
		// 	foreach ($taxesName as $key => $value) {
		// 		$tax = $elem->appendChild(new DOMElement('Tax'));
		// 		$tax->setAttributeNode(new DOMAttr('name', $value));
		// 		$tax->setAttributeNode(new DOMAttr('amount', $taxesAmount[$key]));
		// 	}
		// }


		// if (count($productItem) > 0) {
		// 	$elem = $raiz->appendChild(new DOMElement('product'));
		// 	foreach ($productItem  as $key => $value) {
		// 		$prod = $elem->appendChild(new DOMElement('Product'));
		// 		$prod->setAttributeNode(new DOMAttr('productItem', $value));
		// 		$prod->setAttributeNode(new DOMAttr('productCode', $productCode[$key]));
		// 		$prod->setAttributeNode(new DOMAttr('productAmount', $productAmount[$key]));
		// 		$prod->setAttributeNode(new DOMAttr('productPromotionCode', $productPromotionCode[$key]));
		// 	}
		// }

		// if (count($flightAirlineCode) > 0) {
		// 	$elem = $raiz->appendChild(new DOMElement('flight'));
		// 	foreach ($flightAirlineCode  as $key => $value) {
		// 		$fli = $elem->appendChild(new DOMElement('Flight'));
		// 		$fli->setAttributeNode(new DOMAttr('flightAirlineCode', $value));
		// 		$fli->setAttributeNode(new DOMAttr('flightDepartureAirport', $flightDepartureAirport[$key]));
		// 		$fli->setAttributeNode(new DOMAttr('flightArriveAirport', $flightArriveAirport[$key]));
		// 		$fli->setAttributeNode(new DOMAttr('flightDepartureDate', $flightDepartureDate[$key]));
		// 		$fli->setAttributeNode(new DOMAttr('flightDepartureTime', $flightDepartureTime[$key]));
		// 		$fli->setAttributeNode(new DOMAttr('flightArriveDate', $flightArriveDate[$key]));
		// 		$fli->setAttributeNode(new DOMAttr('flightArriveTime', $flightArriveTime[$key]));
		// 		$fli->setAttributeNode(new DOMAttr('flightReservation', $flightReservation[$key]));
		// 		$fli->setAttributeNode(new DOMAttr('flightDepartureIata', $flightDepartureIata[$key]));
		// 		$fli->setAttributeNode(new DOMAttr('flightArriveIata', $flightArriveIata[$key]));
		// 	}
		// }


		// if (count($passengerFirstName) > 0) {
		// 	$elem = $raiz->appendChild(new DOMElement('passenger'));
		// 	foreach ($passengerFirstName  as $key => $value) {
		// 		$pass = $elem->appendChild(new DOMElement('Passenger'));
		// 		$pass->setAttributeNode(new DOMAttr('passengerFirstName', $value));
		// 		$pass->setAttributeNode(new DOMAttr('passengerLastName', $passengerLastName[$key]));
		// 		$pass->setAttributeNode(new DOMAttr('passengerDocumentType', $passengerDocumentType[$key]));
		// 		$pass->setAttributeNode(new DOMAttr('passengerDocumentNumber', $passengerDocumentNumber[$key]));
		// 		$pass->setAttributeNode(new DOMAttr('passengerAgencyCode', $passengerAgencyGoodCode[$key]));
		// 	}
		// }

		// if (count($goodName) > 0) {
		// 	$elem = $raiz->appendChild(new DOMElement('good'));
		// 	foreach ($goodName  as $key => $value) {
		// 		$good = $elem->appendChild(new DOMElement('Good'));
		// 		$good->setAttributeNode(new DOMAttr('goodName', $value));
		// 		$good->setAttributeNode(new DOMAttr('goodDescription', $goodDescription[$key]));
		// 		$good->setAttributeNode(new DOMAttr('goodQuantity', $goodQuantity[$key]));
		// 		$good->setAttributeNode(new DOMAttr('goodUnitprice', $goodUnitprice[$key]));
		// 	}
		// }

		// if (count($airportCode) > 0) {
		// 	$elem = $raiz->appendChild(new DOMElement('airport'));
		// 	foreach ($airportCode  as $key => $value) {
		// 		$air = $elem->appendChild(new DOMElement('Airport'));
		// 		$air->setAttributeNode(new DOMAttr('airportCode', $value));
		// 		$air->setAttributeNode(new DOMAttr('airportCity', $airportCity[$key]));
		// 		$air->setAttributeNode(new DOMAttr('airportCountry', $airportCountry[$key]));
		// 	}
		// }
		//print_r($dom->saveXML());
		return $dom->saveXML();
	}

	function VPOSSend($arrayIn, &$arrayOut, $llavePublicaCifrado, $llavePrivadaFirma, $VI)
	{
		echo "Entro VPOSSend...<br>";
		$veractual = phpversion();
		$vpos = new VPOS_plugin();

		if (version_compare($veractual, "5.0") < 0) {
			die('PHP version is ' . $veractual . 'and should be >=5.0');
		}
		//print_r($arrayIn);

		$xmlSalida = $vpos->createXMLPHP5($arrayIn);

		//print_r($xmlSalida);

		//Genera la firma Digital
		$contenidoLlavePrivada = $vpos->leer_fichero_completo($llavePrivadaFirma);
		$firmaDigital = $vpos->BASE64URL_digital_generate($xmlSalida, $contenidoLlavePrivada);



		//Ya se genero el XML y se genera la llave de sesion
		$llavesesion = $vpos->generateSessionKey();



		//Se cifra el XML con la llave generada
		$xmlCifrado = $vpos->BASE64URL_symmetric_cipher($xmlSalida, $llavesesion, $VI);

		if (!$xmlCifrado) return null;

		//Se cifra la llave de sesion con la llave publica dada
		$contenidoLlavePublica = $vpos->leer_fichero_completo($llavePublicaCifrado);
		$llaveSesionCifrada = $vpos->BASE64URLRSA_encrypt($llavesesion, $contenidoLlavePublica);

		if (!$llaveSesionCifrada) return null;


		if (!$firmaDigital) return null;

		$arrayOut['SESSIONKEY'] = $llaveSesionCifrada;
		$arrayOut['XMLREQ'] = $xmlCifrado;
		$arrayOut['DIGITALSIGN'] = $firmaDigital;

		return true;
	}
	function leer_fichero_completo($nombre_fichero)
	{
		//abrimos el archivo de texto y obtenemos el identificador
		$fichero_texto = fopen($nombre_fichero, "r");
		//obtenemos de una sola vez todo el contenido del fichero
		//OJO! Debido a filesize(), sólo funcionará con archivos de texto
		$contenido_fichero = fread($fichero_texto, filesize($nombre_fichero));
		return $contenido_fichero;
	}

	// function VPOSResponse($arrayIn, &$arrayOut, $llavePublicaFirma, $llavePrivadaCifrado, $VI)
	// {

	// 	$veractual = phpversion();
	// 	$vpos = new Vpos_plugin();
	// 	if (version_compare($veractual, "5.0") < 0) {

	// 		trigger_error('La version de PHP es menor a la 5.0', E_USER_ERROR);
	// 		return false;
	// 	}

	// 	if (
	// 		$arrayIn['SESSIONKEY'] == null
	// 		|| $arrayIn['XMLRES'] == null
	// 		|| $arrayIn['DIGITALSIGN'] == null
	// 	) {
	// 		return false;
	// 	}

	// 	$llavesesion = $vpos->BASE64URLRSA_decrypt($arrayIn['SESSIONKEY'], $llavePrivadaCifrado);

	// 	$xmlDecifrado = BASE64URL_symmetric_decipher($arrayIn['XMLRES'], $llavesesion, $VI);

	// 	$validation = BASE64URL_digital_verify($xmlDecifrado, $arrayIn['DIGITALSIGN'], $llavePublicaFirma);

	// 	//if($validation){
	// 	$arrayOut = parseXMLPHP5($xmlDecifrado);
	// 	return true;
	// 	//}
	// 	//else{
	// 	//return false;
	// 	//}
	// }

	function VPOSResponse($arrayIn, &$arrayOut, $llavePublicaFirma, $llavePrivadaCifrado, $VI)
	{

		$vpos = new VPOS_plugin();

		$veractual = phpversion();
		if (version_compare($veractual, "5.0") < 0) {
			trigger_error('La version de PHP es menor a la 5.0', E_USER_ERROR);
			return false;
		}

		if (
			$arrayIn->cipheredSessionKey == null
			|| $arrayIn->cipheredXML == null
			|| $arrayIn->cipheredSignature == null
		) {
			return false;
		}

		$contenidoLlavePrivada = $vpos->leer_fichero_completo($llavePrivadaCifrado);
		$llavesesion = $vpos->BASE64URLRSA_decrypt($arrayIn->cipheredSessionKey, $contenidoLlavePrivada);

		$xmlDecifrado = $vpos->BASE64URL_symmetric_decipher($arrayIn->cipheredXML, $llavesesion, $VI);

		$contenidoLlavePublica = $vpos->leer_fichero_completo($llavePublicaFirma);
		$validation = $vpos->BASE64URL_digital_verify($xmlDecifrado, $arrayIn->cipheredSignature, $contenidoLlavePublica);

		$arrayOut = $vpos->parseXMLPHP5($xmlDecifrado);

		return true;
	}

	function is_num($s)
	{
		for ($i = 0; $i < strlen($s); $i++) {
			if (($s[$i] < '0') or ($s[$i] > '9')) {
				return false;
			}
		}
		return true;
	}
	function generateSessionKey()
	{
		srand((float) microtime() * 1000000);
		return mcrypt_create_iv(16, MCRYPT_RAND);
	}

	function BASE64URLRSA_encrypt($valor, $publickey)
	{
		if (!($pubres = openssl_pkey_get_public($publickey))) {
			die("Public key is not valid encrypt");
		}
		$salida = "";
		$resp = openssl_public_encrypt($valor, $salida, $pubres, OPENSSL_PKCS1_PADDING);
		openssl_free_key($pubres);
		if ($resp) {
			$base64 = base64_encode($salida);
			$base64 = preg_replace('/(\\/)/', '_', $base64);
			$base64 = preg_replace('/(\+)/', '-', $base64);
			$base64 = preg_replace('/(=)/', '.', $base64);

			return $base64;
		} else {
			die('RSA Ciphering could not be executed');
		}
	}

	function BASE64URLRSA_decrypt($valor, $privatekey)
	{
		if (!($privres = openssl_pkey_get_private(array($privatekey, null)))) {
			die('Invalid private RSA key has been given');
		}

		$salida = "";

		$pas = preg_replace('/_/', '/', $valor);
		$pas = preg_replace('/-/', '+', $pas);
		$pas = preg_replace('/\./', '=', $pas);

		$temp = base64_decode($pas);

		$resp = openssl_private_decrypt($temp, $salida, $privres, OPENSSL_PKCS1_PADDING);

		openssl_free_key($privres);

		if ($resp) {
			return $salida;
		} else {
			die('RSA deciphering was not succesful');
		}
	}

	function BASE64URL_symmetric_cipher($dato, $key, $vector)
	{
		$tamVI = strlen($vector);

		if ($tamVI != 16) {
			trigger_error('Initialization Vector must have 16 hexadecimal characters', E_USER_ERROR);

			return null;
		}

		if (strlen($key) != 16) {
			trigger_error("Simetric Key doesn't have length of 16", E_USER_ERROR);

			return null;
		}

		$binvi = pack("H*", $vector);

		if ($binvi == null) {
			trigger_error("Initialization Vector is not valid, must contain only hexadecimal characters", E_USER_ERROR);
			return null;
		}

		$key .= substr($key, 0, 8); // agrega los primeros 8 bytes al final



		$text = $dato;
		$block = mcrypt_get_block_size('tripledes', 'cbc');
		$len = strlen($text);
		$padding = $block - ($len % $block);
		$text .= str_repeat(chr($padding), $padding);

		$crypttext = mcrypt_encrypt(MCRYPT_3DES, $key, $text, MCRYPT_MODE_CBC, $binvi);

		$crypttext = base64_encode($crypttext);
		$crypttext = preg_replace('/(\\/)/', '_', $crypttext);
		$crypttext = preg_replace('/(\+)/', '-', $crypttext);
		$crypttext = preg_replace('/(=)/', '.', $crypttext);

		return $crypttext;
	}

	//-------------------------------------------------------------------------------------
	// Esta funcion se encarga de desencriptar los datos recibidos del MPI
	// Recibe como parametro el dato a desencriptar
	//-------------------------------------------------------------------------------------
	function BASE64URL_symmetric_decipher($dato, $key, $vector)
	{

		$tamVI = strlen($vector);

		if ($tamVI != 16) {
			trigger_error("Initialization Vector must have 16 hexadecimal characters", E_USER_ERROR);
			return null;
		}
		if (strlen($key) != 16) {
			trigger_error("Simetric Key doesn't have length of 16", E_USER_ERROR);

			return null;
		}

		$binvi = pack("H*", $vector);

		if ($binvi == null) {
			trigger_error("Initialization Vector is not valid, must contain only hexadecimal characters", E_USER_ERROR);

			return null;
		}
		$key .= substr($key, 0, 8); // agrega los primeros 8 bytes al final


		$pas = preg_replace('/_/', '/', $dato);
		$pas = preg_replace('/-/', '+', $pas);
		$pas = preg_replace('/\./', '=', $pas);

		$crypttext = base64_decode($pas);

		$crypttext2 = mcrypt_decrypt(MCRYPT_3DES, $key, $crypttext, MCRYPT_MODE_CBC, $binvi);


		$block = mcrypt_get_block_size('tripledes', 'cbc');
		$packing = ord($crypttext2{
			strlen($crypttext2) - 1});
		if ($packing and ($packing < $block)) {
			for ($P = strlen($crypttext2) - 1; $P >= strlen($crypttext2) - $packing; $P--) {
				if (ord($crypttext2{
					$P}) != $packing) {
					$packing = 0;
				}
			}
		}

		$crypttext2 = substr($crypttext2, 0, strlen($crypttext2) - $packing);
		return $crypttext2;
	}

	//-------------------------------------------------------------------------------------
	// Esta funcion se encarga de generar una firma digital de $dato usando
	// la llave privada en $privatekey
	//-------------------------------------------------------------------------------------

	function BASE64URL_digital_generate($dato, $privatekey)
	{

		$privres = openssl_pkey_get_private(array($privatekey, null));

		if (!$privres) {
			die("Private key is not valid");
		}
		$firma = "";
		$resp = openssl_sign($dato, $firma, $privres);
		openssl_free_key($privres);

		if ($resp) {
			$base64 = base64_encode($firma);
			$crypttext = preg_replace('/(\\/)/', '_', $base64);
			$crypttext = preg_replace('/(\+)/', '-', $crypttext);
			$crypttext = preg_replace('/(=)/', '.', $crypttext);

			// $urlencoded = urlencode($base64);
			// echo ("<br>");
			// print_r($urlencoded);
			// echo ("<br>");
			return $crypttext;
		} else {
			die("RSA Signature was unsuccesful");
		}
	}

	function BASE64URL_digital_verify($dato, $firma, $publickey)
	{

		if (!($pubres = openssl_pkey_get_public($publickey))) {
			die("Public key is not valid");
		}

		$pas = preg_replace('/_/', '/', $firma);
		$pas = preg_replace('/-/', '+', $pas);
		$pas = preg_replace('/\./', '=', $pas);


		//echo "<br> => ".$publickey;
		//echo "<br> => ".$pas;


		$temp = base64_decode($pas);

		$resp = openssl_verify($dato, $temp, $pubres);
		//echo "<br> => ".$dato;
		//echo "<br> => ".$temp;
		//echo "<br> => ".$pubres;
		//echo "<br> => ".$resp;
		openssl_free_key($pubres);

		return $resp;
	}


	//

	function parseXMLPHP5($xml)
	{

		$arregloSalida = array();

		$dom = new DOMDocument();
		$dom->loadXML($xml);

		$raiz = $dom->getElementsByTagName('VPOSTransaction1.2')->item(0);

		$nodoHijo = null;
		if ($raiz->hasChildNodes()) {
			$nodoHijo = $raiz->firstChild;
			$arregloSalida[$nodoHijo->nodeName] = $nodoHijo->nodeValue;
		}

		while (($nodoHijo = $nodoHijo->nextSibling) != null) {
			$i = 1;
			if (strcmp($nodoHijo->nodeName, 'taxes') == 0) {
				if ($nodoHijo->hasChildNodes()) {
					echo "<br> => " . $nodoHijo->nodeName;
					$nodoTax = $nodoHijo->firstChild;
					$arregloSalida['tax_' . $i . '_name'] = $nodoTax->getAttribute('name');
					$arregloSalida['tax_' . $i . '_amount'] = $nodoTax->getAttribute('amount');
					$i++;

					while (($nodoTax = $nodoTax->nextSibling) != null) {
						$arregloSalida['tax_' . $i . '_name'] = $nodoTax->getAttribute('name');
						$arregloSalida['tax_' . $i . '_amount'] = $nodoTax->getAttribute('amount');
						$i++;
					}
				}
			} else if (strcmp($nodoHijo->nodeName, 'product') == 0) {
				if ($nodoHijo->hasChildNodes()) {
					$nodoProd = $nodoHijo->firstChild;
					$arregloSalida['prod_' . $i . '_item'] = $nodoProd->getAttribute('productItem');
					$arregloSalida['prod_' . $i . '_code'] = $nodoProd->getAttribute('productCode');
					$arregloSalida['prod_' . $i . '_amount'] = $nodoProd->getAttribute('productAmount');
					$arregloSalida['prod_' . $i . '_promotionCode'] = $nodoProd->getAttribute('productPromotionCode');
					$i++;

					while (($nodoProd = $nodoProd->nextSibling) != null) {
						$arregloSalida['prod_' . $i . '_item'] = $nodoProd->getAttribute('productItem');
						$arregloSalida['prod_' . $i . '_code'] = $nodoProd->getAttribute('productCode');
						$arregloSalida['prod_' . $i . '_amount'] = $nodoProd->getAttribute('productAmount');
						$arregloSalida['prod_' . $i . '_promotionCode'] = $nodoProd->getAttribute('productPromotionCode');
						$i++;
					}
				}
			} else if (strcmp($nodoHijo->nodeName, 'airport') == 0) {
				if ($nodoHijo->hasChildNodes()) {
					$nodoAir = $nodoHijo->firstChild;
					$arregloSalida['air_' . $i . '_code'] = $nodoAir->getAttribute('airportCode');
					$arregloSalida['air_' . $i . '_city'] = $nodoAir->getAttribute('airportCity');
					$arregloSalida['air_' . $i . '_country'] = $nodoAir->getAttribute('airportCountry');
					$i++;

					while (($nodoAir = $nodoAir->nextSibling) != null) {
						$arregloSalida['air_' . $i . '_code'] = $nodoAir->getAttribute('airportCode');
						$arregloSalida['air_' . $i . '_city'] = $nodoAir->getAttribute('airportCity');
						$arregloSalida['air_' . $i . '_country'] = $nodoAir->getAttribute('airportCountry');
						$i++;
					}
				}
			} else if (strcmp($nodoHijo->nodeName, 'flight') == 0) {
				if ($nodoHijo->hasChildNodes()) {
					$nodoFli = $nodoHijo->firstChild;
					$arregloSalida['fli_' . $i . '_airlineCode'] = $nodoFli->getAttribute('flightAirlineCode');
					$arregloSalida['fli_' . $i . '_departureAirport'] = $nodoFli->getAttribute('flightDepartureAirport');
					$arregloSalida['fli_' . $i . '_arriveAirport'] = $nodoFli->getAttribute('flightArriveAirport');
					$arregloSalida['fli_' . $i . '_departureDate'] = $nodoFli->getAttribute('flightDepartureDate');
					$arregloSalida['fli_' . $i . '_departureTime'] = $nodoFli->getAttribute('flightDepartureTime');
					$arregloSalida['fli_' . $i . '_arriveDate'] = $nodoFli->getAttribute('flightArriveDate');
					$arregloSalida['fli_' . $i . '_arriveTime'] = $nodoFli->getAttribute('flightArriveTime');
					$arregloSalida['fli_' . $i . '_reservation'] = $nodoFli->getAttribute('flightReservation');
					$arregloSalida['fli_' . $i . '_departureIata'] = $nodoFli->getAttribute('flightDepartureIata');
					$arregloSalida['fli_' . $i . '_arriveIata'] = $nodoFli->getAttribute('flightArriveIata');
					$i++;

					while (($nodoFli = $nodoFli->nextSibling) != null) {
						$arregloSalida['fli_' . $i . '_airlineCode'] = $nodoFli->getAttribute('flightAirlineCode');
						$arregloSalida['fli_' . $i . '_departureAirport'] = $nodoFli->getAttribute('flightDepartureAirport');
						$arregloSalida['fli_' . $i . '_arriveAirport'] = $nodoFli->getAttribute('flightArriveAirport');
						$arregloSalida['fli_' . $i . '_departureDate'] = $nodoFli->getAttribute('flightDepartureDate');
						$arregloSalida['fli_' . $i . '_departureTime'] = $nodoFli->getAttribute('flightDepartureTime');
						$arregloSalida['fli_' . $i . '_arriveDate'] = $nodoFli->getAttribute('flightArriveDate');
						$arregloSalida['fli_' . $i . '_arriveTime'] = $nodoFli->getAttribute('flightArriveTime');
						$arregloSalida['fli_' . $i . '_reservation'] = $nodoFli->getAttribute('flightReservation');
						$arregloSalida['fli_' . $i . '_departureIata'] = $nodoFli->getAttribute('flightDepartureIata');
						$arregloSalida['fli_' . $i . '_arriveIata'] = $nodoFli->getAttribute('flightArriveIata');
						$i++;
					}
				}
			} else if (strcmp($nodoHijo->nodeName, 'passenger') == 0) {
				if ($nodoHijo->hasChildNodes()) {
					$nodoPass = $nodoHijo->firstChild;
					$arregloSalida['pass_' . $i . '_firstName'] = $nodoPass->getAttribute('passengerFirstName');
					$arregloSalida['pass_' . $i . '_lastName'] = $nodoPass->getAttribute('passengerLastName');
					$arregloSalida['pass_' . $i . '_documentType'] = $nodoPass->getAttribute('passengerDocumentType');
					$arregloSalida['pass_' . $i . '_documentNumber'] = $nodoPass->getAttribute('passengerDocumentNumber');
					$arregloSalida['pass_' . $i . '_agencyGoodCode'] = $nodoPass->getAttribute('passengerAgencyCode');
					$i++;

					while (($nodoPass = $nodoPass->nextSibling) != null) {
						$arregloSalida['pass_' . $i . '_firstName'] = $nodoPass->getAttribute('passengerFirstName');
						$arregloSalida['pass_' . $i . '_lastName'] = $nodoPass->getAttribute('passengerLastName');
						$arregloSalida['pass_' . $i . '_documentType'] = $nodoPass->getAttribute('passengerDocumentType');
						$arregloSalida['pass_' . $i . '_documentNumber'] = $nodoPass->getAttribute('passengerDocumentNumber');
						$arregloSalida['pass_' . $i . '_agencyGoodCode'] = $nodoPass->getAttribute('passengerAgencyCode');
						$i++;
					}
				}
			} else if (strcmp($nodoHijo->nodeName, 'good') == 0) {
				if ($nodoHijo->hasChildNodes()) {
					$nodoGood = $nodoHijo->firstChild;
					$arregloSalida['good_' . $i . '_name'] = $nodoGood->getAttribute('goodName');
					$arregloSalida['good_' . $i . '_description'] = $nodoGood->getAttribute('goodDescription');
					$arregloSalida['good_' . $i . '_quantity'] = $nodoGood->getAttribute('goodQuantity');
					$arregloSalida['good_' . $i . '_unitprice'] = $nodoGood->getAttribute('goodUnitprice');
					$i++;

					while (($nodoGood = $nodoGood->nextSibling) != null) {
						$arregloSalida['good_' . $i . '_name'] = $nodoGood->getAttribute('goodName');
						$arregloSalida['good_' . $i . '_description'] = $nodoGood->getAttribute('goodDescription');
						$arregloSalida['good_' . $i . '_quantity'] = $nodoGood->getAttribute('goodQuantity');
						$arregloSalida['good_' . $i . '_unitprice'] = $nodoGood->getAttribute('goodUnitprice');
						$i++;
					}
				}
			} else {
				$arregloSalida[$nodoHijo->nodeName] = $nodoHijo->nodeValue;
			}
		}

		return $arregloSalida;
	}
}