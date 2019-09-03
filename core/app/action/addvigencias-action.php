<?php
if (count($_POST)>0) {
    $c = new VigenciasData();
    $c->consecutivo = $_POST["consecutivo"]!="" ? $_POST["consecutivo"] : "0";
    $c->nroescriturapublica = $_POST["nroescriturapublica"];
    $c->dateescritura = $_POST["dateescritura"];
    $c->otorgotipo = $_POST["otorgotipo"];

    $poderdante_ids ="";
    for ($i = 0; $i < count($_POST['poderdantetypeidentification']); $i++) {
        $clientp = new ClientesignoData();
        $clientp->typeindentification = $_POST['poderdantetypeidentification'][$i];
        $clientp->identification = $_POST['poderdanteidentification'][$i];
        $clientp->identificationexpedida = $_POST['poderdanteidentificationexpedida'][$i];
        $clientp->name = $_POST['poderdantename'][$i];
        $clientp->lastname = $_POST['poderdantelastname'][$i];
        $clientp->email = "";
        $clientp->status = "1";
        $clientp->add();
    }
    $apoderado_ids = "";
    for ($i = 0; $i < count($_POST['apoderadotypeidentification']); $i++) {
        $clientap = new ClientesignoData();
        $clientap->typeindentification = $_POST['apoderadotypeidentification'][$i];
        $clientap->identification = $_POST['apoderadoidentification'][$i];
        $clientap->identificationexpedida = $_POST['apoderadoidentificationexpedida'][$i];
        $clientap->name = $_POST['apoderadoname'][$i];
        $clientap->lastname = $_POST['apoderadolastname'][$i];
        $clientap->email = "";
        $clientap->status = "1";
        $ids = ClientesignoData::getByIndentification($_POST['apoderadoidentification'][$i]);

        if (empty($ids)) {
            # code...
            $clientap->add();
        } else {
            $apoderado_ids .="$ids->id-";
        }
        
       
        
        echo "paso: $i<br>";
    }
    echo "los ID de los Apoderados son: $apoderado_ids";
    $c->apoderado_ids = $apoderado_ids;
    $c->poderdante_ids = $poderdante_ids;
    $c->solicitante = $_POST["solicitante"];
    $c->notario_id =  $_POST["notario_id"];
    $c->user_id = Session::getUID();
    // $c->add();
    Session::msg("s", "Agregado correctamente. La vigencia de la E.P.: ".$_POST["nroescriturapublica"]);
// Core::redir("./?view=protocolovigencias");
} else {
    Core::redir("./?view=protocolovigencias");
}