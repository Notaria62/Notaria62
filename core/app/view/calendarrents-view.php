<?php
Session::currentURL();

$thejson = array();
$events = OperationData::getEvery();
foreach ($events as $event) {
    $item = ItemData::getById($event->item_id);
    $book = $item->getBook();
    $user = ClientData::getById($event->client_id);
    $thejson[] = array("title" => $item->code . " - " . $book->title . " - Prestado a: " . $user->name, "url" => "", "start" => $event->start_at, "end" => $event->finish_at);
}
?>
<script type="application/javascript">
$(document).ready(function() {
    var eventsJson = <?=json_encode($thejson); ?> ;
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        height: 550,
        // defaultDate: '<?php echo date("Y-m-d"); ?>',
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: eventsJson,
        displayEventTime: false
    });

});
</script>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Calendario de prestamo</h4>
        <p class="card-category">Se lleva un registro de los productos prestados</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <h2></h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
.fc-day-grid-event .fc-content {
    white-space: normal;
}
</style>