<?php
$thejson = array();
$events = EventosData::getAll();
//echo EventosData::getAll();
foreach ($events as $event) {
    $thejson[] = array("id" => $event->id, "title" => $event->title, "url" => "", "description" => $event->body, "start" => $event->start_at, "end" => $event->returned_at);
}
//print_r(json_encode($thejson));
?>

<script type="application/javascript">
    $(document).ready(function () {
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
            events: <?php echo json_encode($thejson); ?>,
            eventMouseover: function (calEvent, jsEvent) {
                var tooltip = '<div class="tooltipevent" style="width:300px;border:1px solid #bbbbbb;border-radius:5px;background:whitesmoke;position:absolute;z-index:10001;padding:5px;color:#3c78b5;">' + calEvent.description + '</div>';
                var $tooltip = $(tooltip).appendTo('body');

                $(this).mouseover(function (e) {
                    $(this).css('z-index', 10000);
                    $tooltip.fadeIn('500');
                    $tooltip.fadeTo('10', 1.9);
                }).mousemove(function (e) {
                    $tooltip.css('top', e.pageY + 10);
                    $tooltip.css('left', e.pageX + 20);
                });
            },

            displayEventTime: false,

            eventMouseout: function (calEvent, jsEvent) {
                $(this).css('z-index', 8);
                $('.tooltipevent').remove();
            }
<?php $u = null; $u = UserData::getById(Session::getUID());?>
<?php if ($u->is_admin): ?>,
                eventRender: function (calEvent, element) {
                    element.prepend("<div class='ibox-tools'><a style='background-color: transparent; margin-right: 10px' class='pull-right'><i class='fa fa-times closeon'></i></a></div>");
                    //element.append( "<span class='closeon'>X</span>" );
                    console.log(element.find('closeon'));
                    element.find(".closeon").click(function () {
                        //$('#calendar').fullCalendar('removeEvents',calEvent.id);

                        $('#id').val(calEvent.id);
                        $('span#title').html(calEvent.title);

                        $('span#description').html(calEvent.description);
                        $('#del_evento').modal('show');
                        //window.location.href = "./?action=delevents&id="+calEvent.id;
                    });
                },
<?php endif; ?>
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
              <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>A&ntilde;adir Evento</button>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Agregar nuevo evento</h4>
            </div>
            <form class="form-horizontal" role="form" method="post" action="./?action=addevents" id="addbook">
                <div class="modal-body">

                  <div class="form-group">
                      <label for="" class="bmd-label-floating">Fecha inicio</label>
                      <input type="text" class="form-control" name="start_at" id="start_at" required value="date" />
                  </div>
                  <div class="form-group">
                      <label for="" class="bmd-label-floating">Fecha final</label>
                      <input type="text" class="form-control" name="returned_at" id="returned_at" required value="date" />
                  </div>
                  <div class="form-group">
                      <label for="" class="bmd-label-floating">Tipo de evento</label>
                      <select id="tipo" name="tipo" class="form-control" required>
                        <option value="event-info">Informaci&oacute;n</option>
                        <option value="event-success">Exito</option>
                        <option value="event-important">Importantante</option>
                        <option value="event-warning">Advertencia</option>
                        <option value="event-special">Especial</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="" class="bmd-label-floating">T&iacute;tulo</label>
                      <input type="text" class="form-control" id="title" name="title" required />
                  </div>


                  <div class="form-group">
                      <label for="" class="bmd-label-floating">descripcion</label>

                      <textarea id="body" name="body" required class="form-control" rows="3"></textarea>
                  </div>

                    <script type="text/javascript">
                        $(function () {
                          $('#start_at').datetimepicker({
                              format: 'YYYY/MM/DD HH:mm:ss',
                              icons: {
                                  time: 'fa fa-clock-o',
                                  date: 'fa fa-calendar',
                                  up: ' fa fa-angle-up',
                                  down: 'fa fa-angle-down',
                                  previous: 'fa fa-angle-left',
                                  next: 'fa fa-angle-right',
                                  today: 'fa fa-crosshairs',
                                  clear: 'fa fa-trash',
                                  close: 'fa fa-times'
                              },
                              sideBySide: true
                          });
                            $('#returned_at').datetimepicker({
                                format: 'YYYY/MM/DD HH:mm:ss',
                                icons: {
                                    time: 'fa fa-clock-o',
                                    date: 'fa fa-calendar',
                                    up: ' fa fa-angle-up',
                                    down: 'fa fa-angle-down',
                                    previous: 'fa fa-angle-left',
                                    next: 'fa fa-angle-right',
                                    today: 'fa fa-crosshairs',
                                    clear: 'fa fa-trash',
                                    close: 'fa fa-times'
                                },
                                sideBySide: true
                            });

                        });
                    </script>
                    <link href="themes/notaria62web/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
                    <!-- jQuery UI -->
                    <script src="themes/notaria62web/js/jquery-ui.min.js"></script>
                    <script type="text/javascript" src='themes/notaria62web/js/moment.min.js'></script>
                    <script src="themes/notaria62web/js/es.js"></script>
                    <script src="themes/notaria62web/js/bootstrap-datetimepicker.js"></script>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>

                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="del_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabeldel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminar evento</h4>
            </div>
            <form class="form-horizontal" role="form" method="post" action="./?action=delevents" id="delevents">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <label for="title">Desea eliminar el evento</label>
                    <p><span id="title"></span></p>
                    <p><span id="description"></span></p>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Borrar</button>

                </div>
            </form>
        </div>
    </div>
</div>
<style type="text/css">
    .fc-day-grid-event .fc-content { white-space:normal;}
</style>
