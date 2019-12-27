<?php
class VOPOSConsulta {
  public $acquirerId; // string
  public $commerceId; // string
  public $numOrder; // string

  public $cipheredSessionKey; // string
  public $cipheredXML; // string
  public $cipheredSignature; // string
  public $clearXML; // string
  public $validSign; // boolean

  public $authorizationCode; // string
  public $errorCode; // string
  public $errorMessage; // string
  public $authorizationResult; // string 

  public $cardNumber; //string  

  public $cardType; //string 
  public $planCode; //string 
  public $quotaCode; //string 
  public $xmlResponse; //string 
}
?>
