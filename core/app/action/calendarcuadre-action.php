<?php
$actions = $_GET["actions"];
if (count($_GET) > 0 && $actions == "add") {
    $b = new CalendariocuadresData();
    $b->classname = $_GET["txtclass"];
    $b->title = $_GET["txttitle"];
    $b->body = $_GET["txtbody"];
    $b->start_at = $_GET["start_at"];
    $b->end_at = $_GET["returned_at"];
    $b->allday = $_GET["allday"];
    $b->user_id = Session::getUID();
    $b->add();
    Session::msg("s", "Agregado correctamente.");
    //Core::redir("./?view=beneficencia");
}
else{
    if (count($_GET) > 0 && $actions == "update") {
    $b = CalendariocuadresData::getById($_GET["id"]);
    $b->classname = $_GET["uptxtclass"];
    $b->title = $_GET["uptxttitle"];
    $b->body = $_GET["uptxtbody"];
    $b->user_id = Session::getUID();
    $b->update();
    Session::msg("s", "Actualizado correctamente.");
    //Core::redir("./?view=beneficencia");
}else {
    if (count($_GET) > 0 && $actions == "sr") {
        $thejson = array();
$events = CalendariocuadresData::getAll();
foreach ($events as $event) {
    $thejson[] = array("id"=>$event->id,"title" => $event->title,"description" => $event->body,  "start" => $event->start_at, "end" => $event->end_at, "className" => $event->classname, "allDay" => true);
}

echo json_encode($thejson);
    }
}
}