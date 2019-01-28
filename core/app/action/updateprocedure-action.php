<?php

if(count($_POST)>0){
	$procedure = ProcedureData::getById($_POST["id"]);
	$procedure->radicado = $_POST["radicado"];
	$procedure->escritura = $_POST["escritura"];
	$procedure->CI = $_POST["ci"];
	$procedure->email = $_POST["email"];
	$procedure->anho = $_POST["anho"];
	$procedure->estatus = $_POST["estatus"];
	$procedure->user_id=$_SESSION["user_id"];
	$procedure->update();
    $statusDB = StatusData::getById($_POST["estatus"]);
    try
    {
        sendEmailStatus($_POST["email"],"Cambio de estatus de su radicado: ".$_POST["radicado"],$_POST["radicado"], $_POST["ci"]," Su radicado N�: ". $_POST["radicado"] ." tiene estatus de: ". utf8_encode($statusDB->name). ", Descripcion: ". utf8_encode($statusDB->description),$_POST["email"],$procedure->created_at);

    }
    catch (Exception $exception)
    {
        Core::alert("Actualizado exitosamente!, no envia email. ".$exception);
        print "<script>window.location='index.php?view=notarialprocedure';</script>";

    }
}

function sendEmailStatus($to,$subject,$radicado, $ci, $message,$email,$created_at){
    //$newpassmd5 = md5($pass);
    $bool=false;
    $path = 'template/update-procedure.html';
    //echo file_get_contents($path);
    if(file_exists($path)){
        $tpl = file_get_contents($path);
    }
    $body = str_replace('{{radicado}}', strtoupper($radicado), $tpl);
    $body = str_replace('{{ci}}', $ci, $body);
    $body = str_replace('{{email}}', $email, $body);
    $body = str_replace('{{created_at}}', $created_at, $body);
    $body = str_replace('{{content}}', $message, $body);
    //$to = $to;
    $header = "From: Info <info@notaria62bogota.com> \r\n";
    $header .= "Bcc: app@notaria62bogota.com \r\n";
    //$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
    $header .= "Mime-Version: 1.0 \r\n";
    $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $bool = mail($to,$subject,$body,$header);
    // echo $bool;
    if($bool){
        Core::alert("Actualizado exitosamente!, email enviado: ".$bool);
        print "<script>window.location='index.php?view=notarialprocedure';</script>";
    }else{
        Core::alert("Actualizado exitosamente!, pero email no enviado, por favor notificar.");
        print "<script>window.location='index.php?view=notarialprocedure';</script>";
    }

    //if (mail($email, "Alguien solicit� una nueva contrase�a para tu cuenta de Dolphy", $body, $header)) {
    //    mysql_query("UPDATE pw_user SET password ='$newpassmd5' WHERE user = '$email'");
    //}
}
