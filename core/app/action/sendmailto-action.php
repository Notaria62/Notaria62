<?php
//echo "paso ".count($_GET). " y post : ". count($_POST);
if (count($_POST)>0) {
    $to = "app@notaria62bogota.com";
    $subject = $_POST["subjet"];

    $message = $_POST["message"] ." email enviado por: ". $_POST["emailFrom"];

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <sistemas@notaria62bogota.com>' . "\r\n";
    $headers .= 'Cc: notaria62bogota@hotmail.com' . "\r\n";

    //echo $_POST["subjet"];

    $bool = mail($to, $subject, $message, $headers);

    if ($bool) {
        Core::redir("./?view=emailsuccess");
    } else {
        Session::msg("s", "No enviado.");
        Core::redir("./?view=emailto");
    }
}
