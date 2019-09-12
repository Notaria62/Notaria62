<?php
if (count($_POST)>0) {
    $c = new VigenciasData();
    $c->consecutivo = $_POST["consecutivo"]!="" ? $_POST["consecutivo"] : "0";
    $c->nroescriturapublica = $_POST["nroescriturapublica"];
    $c->dateescritura = $_POST["dateescritura"];
    $c->otorgotipo = $_POST["otorgotipo"];
    if ($_POST["otorgotipo"] == "Salida del pais") {
        $c->otorgoobservation = $_POST["otorgoobservation"];
    } else {
        $c->otorgoobservation = "";
    }
    
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
        try {
            $clientp->add();
        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            $ids_p = ClientesignoData::getByIndentification($_POST['poderdanteidentification'][$i]);
            $poderdante_ids .=$ids_p->id."-";
        }
    }
    $apoderado_ids = "";
    if (isset($_POST['apoderadotypeidentification'])) {
        # code...
        for ($j = 0; $j < count($_POST['apoderadotypeidentification']); $j++) {
            $clientap = new ClientesignoData();
            $clientap->typeindentification = $_POST['apoderadotypeidentification'][$j];
            $clientap->identification = $_POST['apoderadoidentification'][$j];
            $clientap->identificationexpedida = $_POST['apoderadoidentificationexpedida'][$j];
            $clientap->name = $_POST['apoderadoname'][$j];
            $clientap->lastname = $_POST['apoderadolastname'][$j];
            $clientap->email = "";
            $clientap->status = "1";
            try {
                $clientap->add();
            } catch (\Throwable $th) {
                $apoderado_ids .=$ids->id."-";
            } finally {
                $ids_ap = ClientesignoData::getByIndentification($_POST['apoderadoidentification'][$j]);
                $apoderado_ids .=$ids_ap->id."-";
            }
        }
    }
    $poderdante_ids = substr_replace($poderdante_ids, "", -1);
    $apoderado_ids = substr_replace($apoderado_ids, "", -1);
    $c->apoderado_ids = ($apoderado_ids!="") ? $apoderado_ids : "1";
    $c->poderdante_ids = ($poderdante_ids!="") ? $poderdante_ids : "1";
    $c->solicitante = $_POST["solicitante"];
    $c->observation = $_POST["observation"];
    $c->notario_id =  $_POST["notario_id"];
    $c->resolucionnotario =  $_POST["resolucionnotario"];
    $c->dateresolucionnotario =  $_POST["dateresolucionnotario"];
    $c->user_id = Session::getUID();
    $c->add();
    Session::msg("s", "Agregado correctamente. La vigencia de la E.P.: ".$_POST["nroescriturapublica"]);
    Core::redir("./?view=protocolovigencias");
} else {
    Core::redir("./?view=protocolovigencias");
}