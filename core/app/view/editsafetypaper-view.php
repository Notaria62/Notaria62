<?php $paper = SafetyPaperData::getById($_GET["id"]);?>




<div class="row">
    <div class="col-md-12">
        <div class="btn-group pull-right">
            <!--<div class="btn-group pull-right">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-download"></i> Descargar <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
              </ul>
            </div>
            -->
        </div>
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Editar pepel de seguridad extraviado en notarias</h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-horizontal" method="post" id="addsafetypaper" action="index.php?action=updatesafetypaper" role="form">

                    <div class="form-group">
                        <label for="codsheet" class="bmd-label-floating">C&oacute;digo de hoja *</label>
                        <div class="col-md-6">
                            <input type="text" name="codsheet" required class="form-control" id="codsheet" placeholder="C&oacute;digo de hoja" value="<?php echo $paper->codsheet;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ep" class="bmd-label-floating">EP *</label>
                        <div class="col-md-6">
                            <input type="text" name="ep" required class="form-control" id="ep" placeholder="EP" value="<?php echo $paper->ep;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notaria" class="bmd-label-floating">Notaria *</label>
                        <div class="col-md-6">
                            <input type="text" name="address" required class="form-control" id="address" placeholder="notaria" value="<?php echo $paper->address;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="radicadosnr" class="bmd-label-floating">Radicado SNR *</label>
                        <div class="col-md-6">
                            <input type="text" name="radicadosnr" required class="form-control" id="radicadosnr" placeholder="Radicado SNR" value="<?php echo $paper->radicadosnr;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reportdate" class="bmd-label-floating">Fecha de reporte *</label>
                        <div class="col-md-6">
                            <div class='input-group date' id='start_at_div'>
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" name="reportdate" id="reportdate" class="form-control" required value="<?php echo $paper->reportdate;?>" placeholder="Fecha de reporte" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="bmd-label-floating"></label>
                        <div class="col-md-6">
                            <p class="text-info">* Campos obligatorios</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <input type="hidden" name="id" value="<?php echo $paper->id;?>" />
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#start_at_div').datetimepicker({
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
