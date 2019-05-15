<?php

/**
 * searchescrituras_action short summary.
 *
 * searchescrituras_action description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */



$result = ProtocoloDevolucionesData::getById($_GET['id']);
$resultep = ProtocoloDevolucionesData::getLikeBy($result->escritura_anho);

//email variables
$to = $result->email;

$acumActa = "";
$acumSaldo = 0;
$acumTipoDeposito = "";
$acumValorActa = 0;



foreach ($resultep as $key => $value) {
    # code...
    $acumActa .= $value->acta . " - ";
    //$acumValorActa += $value->valor_acta;
    $acumSaldo += $value->saldo;
    //$acumTipoDeposito .= $value->tipo_deposito . ", ";
}
$acumActa = substr($acumActa, 0, -2);
$subject = 'Devolución al usuario de acata(s): ' . $acumActa;


try {
    sendEmailDevoluciones($to, $subject, $result->depositante, $acumActa, $acumSaldo, $result->escritura_anho);
} catch (Exception $exception) {
    Core::alert("Actualizado exitosamente!, no envia email. " . $exception);
    print "<script>window.location='./?view=protocolodevoluciones';</script>";
}

function sendEmailDevoluciones($to, $subject, $depositante, $acumActa, $acumSaldo, $escritura_anho)
{
    //$newpassmd5 = md5($pass);
    $bool = false;
    $path = 'template/protocolo-devoluciones.html';
    //echo file_get_contents($path);
    if (file_exists($path)) {
        $tpl = file_get_contents($path);
    }
    $body = str_replace('{{depositante}}', strtoupper($depositante), $tpl);
    $body = str_replace('{{acumSaldo}}', Util::toDot($acumSaldo), $body);
    $body = str_replace('{{escritura_anho}}', $escritura_anho, $body);

    $body = str_replace('{{acumActa}}', $acumActa, $body);
    //$to = $to;
    $header = "From: Info Notaria 62 del circulo de Bogotá <info@notaria62bogota.com> \r\n";
    $header .= "Bcc: notaria62bogota@hotmail.com \r\n";
    //$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
    $header .= "Mime-Version: 1.0 \r\n";
    $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $bool = mail($to, $subject, $body, $header);
    // echo $bool;
    if ($bool) {
        Core::alert("Actualizado exitosamente!, email enviado: " . $bool);
        print "<script>window.location='./?view=protocolodevoluciones';</script>";
    } else {
        Core::alert("Actualizado exitosamente!, pero email no enviado, por favor notificar.");
        print "<script>window.location='./?view=protocolodevoluciones';</script>";
    }

    //if (mail($email, "Alguien solicit� una nueva contrase�a para tu cuenta de Dolphy", $body, $header)) {
    //    mysql_query("UPDATE pw_user SET password ='$newpassmd5' WHERE user = '$email'");
    //}
}