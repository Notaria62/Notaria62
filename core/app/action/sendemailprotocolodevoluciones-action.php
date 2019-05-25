<?php

/**
 * searchescrituras_action short summary.
 *
 * searchescrituras_action description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
$beginTable = '<table border="1" align="center" valign="top" style="width: 100%;"><thead>
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
$subject = 'Devolucion al usuario de acta(s): ' . $acumActa;
$content = $beginTable . $tdTable . $endTable;
$contact = $user->name . " " . $user->lastname;


sendEmailDevoluciones($to, $subject, $result->depositante, $acumActa, $acumSaldo, $content, $contact, $result->escritura_anho);

function sendEmailDevoluciones($to, $subject, $depositante, $acumActa, $acumSaldo, $content, $contact, $escritura_anho)
{
    //*****************************************************************//

    $bool = false;
    $path = 'template/protocolo-devoluciones.html';
    if (file_exists($path)) {
        $tpl = file_get_contents($path);
    }
    $body = str_replace('{{depositante}}', strtoupper($depositante), $tpl);
    $body = str_replace('{{acumSaldo}}', Util::toDot($acumSaldo), $body);
    $body = str_replace('{{escritura_anho}}', $escritura_anho, $body);
    $body = str_replace('{{content}}', $content, $body);
    $body = str_replace('{{contact}}', $contact, $body);

    $body = str_replace('{{acumActa}}', $acumActa, $body);

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 1;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'mail.notaria62bogota.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'info@notaria62bogota.com';                     // SMTP username
        $mail->Password   = '$$in2018';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('info@notaria62bogota.com', 'Informacion Notaria 62 del circulo de Bogota');
        $mail->addAddress($to);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('notaria62bogota@hotmail.com', 'Carlos Arturo Serrato Galeano');
        //$mail->addCC('cc@example.com');
        $mail->addBCC('notaria62bogota@hotmail.com');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $result = ProtocoloDevolucionesData::getById($_GET['id']);
        $result->status = 1;
        $result->update_status();


        Session::msg("s", "El correo electronico se envío exitosamente para la(s) acta(s): [$acumActa]");
        Core::redir("./?view=protocolodevoluciones");
    } catch (Exception $e) {
        Session::msg("d", "El correo electronico no se envío, por favor llame al administrador del sistema. {$mail->ErrorInfo}, $e->message");
        Core::redir("./?view=protocolodevoluciones");
        //echo "Message could not be sent. Mailer Error: ";
    }
}