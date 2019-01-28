<?php
$thejson = array();
//$events = EventosData::getAll();
//foreach ($events as $event) {
	//$item = ItemData::getById($event->item_id);
	//$book = $item->getBook();
	//$user = ClientData::getById($event->client_id);

    //$thejson[] = array("id" => $event->id, "title" => $event->title, "url" => "", "description" => $event->body, "start" => $event->start_at, "end" => $event->returned_at);
//echo $event->id . " ";
//}

 //print_r(json_encode($thejson) ."sss");





//  // Get the string from the URL
//  $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452');
//
//  // Decode the JSON string into an object
//  $obj = json_decode($json);
// echo $obj;
//  // In the case of this input, do key and array lookups to get the values
//  var_dump($obj->results[0]->formatted_address);
//
$str_obj_json = file_get_contents('https://adc.notaria62bogota.com/template/eventos.txt');
//echo $str_obj_json;

// $str_obj_json = '{"estado":1,"mensaje":
// [{
// "id":1,
// "title":"Anderson Damaso Lugo Jacome (N.E). Resolucion : 10222 Desde : Todo el d\u00eda",
// "start":"2017-11-10 00:00:00",
// "end":"2017-11-10 23:59:59",
// "allDay":true,
// "className":"ColorEventPermiso",
// "licencia":1,
// "resolucion":"10222",
// "id_usuario":303,
// "nota":"Prueba"},
// {"id":4,
// "title":"Anderson Damaso Lugo Jacome (N.E). Resolucion : 10000011 Desde : Todo el d\u00eda",
// "start":"2017-11-16 00:00:00",
// "end":"2017-11-16 23:59:00",
// "allDay":true,
// "className":"ColorEventLicencia",
// "licencia":2,
// "resolucion":"10000011",
// "id_usuario":303,
// "nota":"todoo el dia."}]
// }';
$obj_php = json_decode($str_obj_json);
//echo "Una propiedad cualquiera:" . $obj_php->mensaje;

//$thejson[] =$obj_php->mensaje;
echo json_encode($obj_php);

//echo json_encode($obj_php->mensaje);
?>





<script type="application/javascript">


	$(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'year,month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '<?php echo date("Y-m-d"); ?>',
      editable: false,
      height: 550,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: <?php echo json_encode($obj_php); ?>//,
    //         eventMouseover: function(calEvent, jsEvent) {
    // var tooltip = '<div class="tooltipevent" style="width:300px;border:1px solid #bbbbbb;border-radius:5px;background:whitesmoke;position:absolute;z-index:10001;padding:5px;color:#3c78b5;">' + calEvent.description + '</div>';
    // var $tooltip = $(tooltip).appendTo('body');
		//
    // $(this).mouseover(function(e) {
    //     $(this).css('z-index', 10000);
    //     $tooltip.fadeIn('500');
    //     $tooltip.fadeTo('10', 1.9);
    // }).mousemove(function(e) {
    //     $tooltip.css('top', e.pageY + 10);
    //     $tooltip.css('left', e.pageX + 20);
    // });
    // },
    // displayEventTime : false,
    // eventMouseout: function(calEvent, jsEvent) {
    // $(this).css('z-index', 8);
    // $('.tooltipevent').remove();
    // },
    });

    });

</script>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Calendario de eventos en la notaria 62</h4>
            </div>
            <div class="card-content table-responsive">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    .fc-day-grid-event .fc-content { white-space:normal;}
</style>
