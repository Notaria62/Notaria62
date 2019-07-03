   <?php
//Session::currentURL();

?>



<style>
    .blueEvent {

        background-color: blue;
        height: 30px;
    }

    .greenEvent {
        background-color: rgb(76, 175, 80);
        ;
        height: 30px;
    }

    .redEvent {
        background-color: #FF0000;
        height: 30px;
    }
</style>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        fetch_data();
        function fetch_data() {
 
        //var eventsJson = < ? = json_encode($thejson); ? > ;

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next, today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            height: 650,
            defaultDate: '<?php echo date("Y-m-d"); ?>',
            editable: true,
            selectable: true,
            eventLimit: true,
            select: function(start, end, allDay) {
                endtime = $.fullCalendar.formatDate(end, 'h:mm');
                starttime = $.fullCalendar.formatDate(start, 'ddd, MMM d, h:mm');
                var mywhen = starttime + ' - ' + endtime;
                start = $.fullCalendar.formatDate(start, 'YYYY-MM-DD h:mm');
                end = $.fullCalendar.formatDate(end, 'YYYY-MM-DD h:mm');
                $('#addModal #apptStartTime').val(start);
                $('#addModal #apptEndTime').val(end);
                $('#addModal #when').text(mywhen);
                $('#addModal #apptAllDay').val("true");
                $('#addModal').modal('show');
            },
           // events: eventsJson,
           events: {
                url: "./?action=calendarcuadre&actions=sr",
                method: 'POST',
                failure: function() {
                    alert('there was an error while fetching events!');
                }
            },
            eventRender: function(event, element) {
                $(element).tooltip({
                    title: event.title
                });
            },
            eventClick: function(event) {
                when = $.fullCalendar.formatDate(event.start, 'YYYY-MM-DD h:mm');
                $('#updateModal #uptxttitle').val(event.title);
                $('#updateModal #id').val(event.id);
                $('#updateModal #uptxtbody').val(event.description);
                $('#updateModal #upapptStartTime').val(event.start);
                $('#updateModal #upapptEndTime').val(event.end);
                $('#updateModal #upwhen').text(when);
                $('#updateModal #upapptAllDay').val("true");
                $('#updateModal').modal('show');
            }
        });
    }


        $(document).on('click', '#insert', function() {
            var $url = "./?action=calendarcuadre";
            var class1 = $('#txtclass').val();
            var title1 = $('#txttitle').val();
            var body1 = $('#txtbody').val();
            var start1 = $('#apptStartTime').val();
            var returned1 = $('#apptEndTime').val();
            var allday1 = $('#apptAllDay').val();
            var actions1 = "add";
            //alert($url);
            if (txttitle != '') {
                $.ajax({
                    url: $url,
                    method: "GET",
                    data: {
                        txtclass: class1,
                        txttitle: title1,
                        txtbody: body1,
                        start_at: start1,
                        returned_at: returned1,
                        allday: allday1,
                        actions: actions1
                    },
                    success: function(data) {
                        $('#alert_message').html(
                            '<div class="alert alert-success">' +
                            data +
                            '</div>');
                    }

                });
                setInterval(function() {
                    $('#alert_message').html('');
                    $('#addModal #txttitle').val('');
                    $('#addModal #txtbody').val('');
                    $('#addModal #apptStartTime').val('');
                    $('#addModal #apptEndTime').val('');
                    $('#addModal #when').text('');
                    $('#addModal #apptAllDay').val('');
                    $("#addModal").modal('hide');
                       // $('#calendar').fullCalendar().destroy();
                        location.reload();
                    
                }, 5000);
            } else {
                alert("Both Fields is required");
            }
        });
        $(document).on('click', '#update', function() {
            var $url2 = "./?action=calendarcuadre";
            var class2 = $('#uptxtclass').val();
            var title2 = $('#uptxttitle').val();
            var body2 = $('#uptxtbody').val();
            var id = $('#id').val();
            var actions2 = "update";
            if (class2 != '') {
                $.ajax({
                    url: $url2,
                    method: "GET",
                    data: {
                        id:id,
                        uptxtclass: class2,
                        uptxttitle: title2,
                        uptxtbody: body2,
                        actions: actions2
                    },
                    success: function(data) {
                        $('#alert_message').html(
                            '<div class="alert alert-success">' +
                            data +
                            '</div>');
                           
               
                    }
                });
                setInterval(function() {
                    $('#alert_message').html('');
                    $('#updateModal #uptxttitle').val('');
                    $('#updateModal #uptxtbody').val('');
                    $('#updateModal #upapptStartTime').val('');
                    $('#updateModal #upapptEndTime').val('');
                    $('#updateModal #upwhen').text('');
                    $('#updateModal #upapptAllDay').val('');
                    $("#updateModal").modal('hide');
                     location.reload();
                }, 5000);
            } else {
                alert("Both Fields is required");
            }
        });
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            var $url = "./?action=calendarcuadre&actions=del";
            if (confirm("Seguro quiere eliminar?")) {
                $.ajax({
                    url: $url,
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#alert_message').html(
                            '<div class="alert alert-danger">' +
                            data +
                            '</div>');
                        //$('#user_data').DataTable().destroy();
                        // fetch_data();
                    }
                });
                setInterval(function() {
                    $('#alert_message').html('');
                }, 5000);
            }
        });
        


    });
</script>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Calendario de cuadres</h4>
        <p class="card-category">Se lleva un registro de los cuadres entregados</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <h2></h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="alert_message"></div>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group bmd-form-group is-filled">
                            <label for="txtclass" class="bmd-label-floating">Color</label>
                            <select id="txtclass" name="txtclass" class="custom-select" required>
                                <option value="greenEvent" selected="selected">Verde</option>
                                <option value="redEvent">Rojo</option>
                                <option value="blueEvent">Azul</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txttitle" class="bmd-label-floating">Titulo</label>
                            <input type="text" class="form-control" id="txttitle" name="txttitle" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txtbody" class="bmd-label-floating">Observación</label>
                            <input type="text" class="form-control" id="txtbody" name="txtbody" required />
                        </div>
                    </div>
                    <input type="hidden" id="apptStartTime" />
                    <input type="hidden" id="apptEndTime" />
                    <input type="hidden" id="apptAllDay" />
                    <div class="control-group">
                        <label class="control-label" for="when">When:</label>
                        <div class="controls controls-row" id="when" style="margin-top:5px;">
                        </div>
                    </div>


                </div>
            </div>
            <div class=" modal-footer">
                <button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Agregar</button></td>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="updateModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Actualiza cuadre</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group bmd-form-group is-filled">
                            <label for="uptxtclass" class="bmd-label-floating">Color</label>
                            <select id="uptxtclass" name="uptxtclass" class="custom-select" required>
                                <option value="" selected="selected">-- SELECT --</option>
                                <option value="greenEvent" >Verde</option>
                                <option value="redEvent">Rojo</option>
                                <option value="blueEvent">Azul</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group bmd-form-group is-filled">
                            <label for="uptxttitle" class="bmd-label-floating">Titulo</label>
                            <input type="text" class="form-control" id="uptxttitle" name="uptxttitle" required value=" " />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group bmd-form-group is-filled">
                            <label for="uptxtbody" class="bmd-label-floating">Observación</label>
                            <input type="text" class="form-control" id="uptxtbody" name="uptxtbody" required />
                        </div>
                    </div>
                    <input type="hidden" id="upapptStartTime" />
                    <input type="hidden" id="upapptEndTime" />
                    <input type="hidden" id="upapptAllDay" />
                    <input type="hidden" id="id" />
                    <div class="control-group">
                        <label class="control-label" for="upwhen">Día:</label>
                        <div class="controls controls-row" id="upwhen" style="margin:5px;">
                        </div>
                    </div>


                </div>
            </div>
            <div class=" modal-footer">
                <button type="button" name="update" id="update" class="btn btn-success btn-xs">Actualizar</button></td>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

<style type="text/css">
    .fc-day-grid-event .fc-content {
        white-space: normal;
    }
</style>