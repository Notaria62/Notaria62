<?php

/**
 * searchescrituras_action short summary.
 *
 * searchescrituras_action description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */

//require("Mail.php");
require("/Mail/mime.php");
$result = ProtocoloDevolucionesData::getById($_GET['id']);
$resultep = ProtocoloDevolucionesData::getLikeBy($result->escritura_anho);
$user = Util::current_user();
//email variables # A Quién va el correo
$to = $result->email;

$acumActa = "";
$acumSaldo = 0;
$acumTipoDeposito = "";
$beginTable = "";
$tdTable = "";
$endTable = "";
$acumValorActa = 0;
$beginTable = '<table border="1"><thead>
				<th>N° Acta</th>
				<th>Concepto</th>
				<th>Valor(s)</th>
			</thead>';

foreach ($resultep as $key => $value) {
    # code...
    $acumActa .= $value->acta . " - ";
    $acumValorActa += $value->valor_acta;
    $acumSaldo += $value->saldo;
    $tdTable .= '<tr><td>' . $value->acta . '</td><td>' . $value->tipo_deposito . '<td>' . Util::toDot($value->valor_acta) . '</td> </tr>';
}
$endTable = '<tfoot><tr><td></td><td>Total, Depositos Realizados por el usuario</td><td>' . $acumValorActa . '</td></tr>
<tr><td></td><td>Saldo a Favor del usuario</td><td>' . Util::toDot($acumSaldo) . '</td></tr></tfoot></table>';
$acumActa = substr($acumActa, 0, -2);
# El asunto / título del mensaje
$subject = 'Devolucion al usuario de acata(s): ' . $acumActa;
$content = $beginTable . $tdTable . $endTable;
$contact = $user->name . " " . $user->lastname;

try {
    sendEmailDevoluciones($to, $subject, $result->depositante, $acumActa, $acumSaldo, $content, $contact, $result->escritura_anho);
} catch (Exception $exception) {
    Core::alert("Actualizado exitosamente!, no envia email. " . $exception);
    print "<script>
    window.location = './?view=protocolodevoluciones';
    </script>";
}

function sendEmailDevoluciones($to, $subject, $depositante, $acumActa, $acumSaldo, $content, $contact, $escritura_anho)
{



    $nombre_origen    = "Carlos Arturo Serrato Galeano";
    $email_origen     = "notaria62bogota@hotmail.com";
    $email_copia      = "info@notaria62bogota.com";
    $email_ocultos    = "notaria62bogota@hotmail.com";
    $email_errorsTo    = "notaria62bogota@hotmail.com";
    $email_destino    = $to;
    $formato          = "html";

    //*****************************************************************//

    # Los headers del correo
    $headers = array();
    $headers['From'] = $nombre_origen; # Quien lo manda
    $headers['To'] = $email_destino; # Aca va el correo que definimos mas arriba
    $headers['cc'] = $email_copia; # CC
    $headers['Subject'] = $subject; # El asunto
    $headers['X-Mailer'] = "X-Mailer: Mi Mailer en PHP"; # Si quieren identificar de donde sale
    $headers['X-Priority'] = 3; # La prioridad del correo (1 es importante)
    $headers['Errors-To'] = $email_errorsTo; # A donde va el correo si sale algo mal
    $headers['Return-Path'] = $email_origen;


    // $headers  = "From:  <$email_origen> " . "\r\n";
    // $headers .= "Return-Path: <$email_origen> " . "\r\n";
    // $headers .= "Reply-To: $email_origen " . "\r\n";
    // // $headers .= "Cc: $email_copia " . "\r\n";
    // $headers .= "Bcc: $email_ocultos " . "\r\n";
    // $headers .= "X-Sender: $email_origen " . "\r\n";
    // $headers .= "X-Mailer: [Notaria 62 del circulo de bogota v.1.0] " . "\r\n";
    // $headers .= "X-Priority: 3 " . "\r\n";
    // $headers .= "MIME-Version: 1.0 " . "\r\n";
    // $headers .= "Content-Transfer-Encoding: 7bit " . "\r\n";
    // $headers .= "Disposition-Notification-To: \"$nombre_origen\" <$email_origen> \r\n";
    //*****************************************************************//

    // if ($formato == "html") {
    //     $headers .= "Content-Type: text/html; charset==UTF-8 " . "\r\n";
    // } else {
    //     $headers .= "Content-Type: text/plain; charset==UTF-8 " . " \r\n ";
    // }
    $bool = false;
    $path = 'template/protocolo-devoluciones.html';
    //echo file_get_contents($path);
    if (file_exists($path)) {
        $tpl = file_get_contents($path);
    }
    $body = str_replace('{{depositante}}', strtoupper($depositante), $tpl);
    $body = str_replace('{{acumSaldo}}', Util::toDot($acumSaldo), $body);
    $body = str_replace('{{escritura_anho}}', $escritura_anho, $body);
    $body = str_replace('{{content}}', $content, $body);
    $body = str_replace('{{contact}}', $contact, $body);

    $body = str_replace('{{acumActa}}', $acumActa, $body);




    # El mensaje con formato en HTML
    //     $mensajeHTML = "

    // Hola, este es un ejemplo de correos con PEAR::Mail

    // ";



    # Empieza el baile

    $message = new Mail_mime();
    //$message->setTXTBody($messageTEXT);
    $message->setHTMLBody($body);

    # Aca definimos el encoding (esta es la parte de Mail::Mime)

    $mimeparams = array();
    $mimeparams['text_encoding'] = "7bit";
    $mimeparams['text_charset'] = "UTF-8";
    $mimeparams['html_charset'] = "UTF-8";

    # Metemos todo en el body, Pear se encarga de armarlo
    $body = $message->get($mimeparams);

    # Cargamos los headers, Pear se encarga del resto...
    $headers = $message->headers($headers);

    # Enviamos
    $smtp = Mail::factory('smtp', array('host' => "mail.notaria62bogota.com", 'port' => 25, 'auth' => true, 'info@notaria62bogota.com' => "no-reply@notaria62bogota.com", 'password' => "$$in2018"));
    $mail = $smtp->send($to, $headers, $body);

    #Controlamos de que no haya problemas
    if (PEAR::isError($mail)) {
        print "Error";
    } else {
        print "Correo enviado";
    }



    //$bool = mail($to, $subject, $body, $headers);
    // if ($bool) {
    //     Core::alert("Actualizado exitosamente!, email enviado: " . $bool);
    //     print "<script>
    //     window.location = './?view=protocolodevoluciones';
    //     </script>";
    // } else {
    //     Core::alert("Actualizado exitosamente!, pero email no enviado, por favor notificar.");
    //     print "<script>
    //     window.location = './?view=protocolodevoluciones';
    //     </script>";
    // }

    //if (mail($email, "Alguien solicit� una nueva contrase�a para tu cuenta de Dolphy", $body, $header)) {
    // mysql_query("UPDATE pw_user SET password ='$newpassmd5' WHERE user = '$email'");
    //}
}








# El mensaje o body en texto
$mensajeTexto = "Su cliente de correo electrónico es viejísimo! Actualice para poder ver esto!!!";