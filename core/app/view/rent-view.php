<?php
//unset($_SESSION["cart"]);
?>


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Pr&eacute;stamo</h4>
        <p class="card-category">M&oacute;dulo de pr&eacute;stamo</p>
    </div>
    <div class="card-body">
        <div class="card-title">

            <a href="index.php?view=clients" class="btn btn-default"><i class='fa fa-male'></i> Nuevo empleado</a>
            <form id="searchp">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="view" value="sell">
                        <select id="product_code" name="product" required class="custom-select">
                            <option value="">-- SELECCIONE --</option><?php foreach (BookData::getAll() as $p):?>
                            <option value="<?php echo $p->isbn; ?>"><?php echo $p->title." ".$p->subtitle; ?>
                            </option><?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-block"><i class="material-icons">search</i>
                            Buscar</button>
                    </div>
                </div>
            </form>
            <div id="show_search_results"></div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#searchp").on("submit", function(e) {
                        e.preventDefault();
                        $.get("./?action=searchbook", $("#searchp").serialize(), function(data) {
                            $("#show_search_results").html(data);
                        });
                        $("#product_code").val("");

                    });
                });
            </script>

        </div>
        <!--- Carrito de compras :) -->
        <?php if (isset($_SESSION["cart"])):
              $total = 0; ?>
        <div class="row">
            <div class="col-md-12">
                <h2>Lista de productos</h2>
                <form class="form-horizontal" role="form" method="post" action="./?action=process">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="client_id" required class="custom-select">
                                    <option value="">-- SELECCIONE --</option><?php foreach (ClientData::getAll() as $p):?>
                                    <option value="<?php echo $p->id; ?>"><?php echo $p->name." ".$p->lastname; ?>
                                    </option><?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group bmd-form-group has-success">
                                <label for="start_at" class="bmd-label-floating">
                                    Fecha inicio</label>
                                <input type="text" name="start_at" id="start_at" class="form-control datepicker-here"
                                    data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii"
                                    placeholder="" value="<?=Util::getDatetimeNow();?>">
                                <span class="form-control-feedback">
                                    <i class="material-icons">calendar_today</i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group bmd-form-group has-success">
                                <label for="finish_at" class="bmd-label-floating">
                                    Fecha fin</label>
                                <input type="text" name="finish_at" id="finish_at" class="form-control datepicker-here"
                                    data-timepicker="true" data-date-format="yyyy-mm-dd" data-time-format="hh:ii"
                                    placeholder="" value="">
                                <span class="form-control-feedback">
                                    <i class="material-icons">calendar_today</i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" value="Procesar" class="btn btn-primary btn-block" placeholder="Procesar">
                        </div>
                        <div class="col-md-1">
                            <a href="./?action=clearcart" class="btn btn-danger btn-block"><i class="material-icons">close</i></a>
                        </div>
                    </div>
            </div>
        </div>
        </form>
        <table class="table table-bordered table-hover">
            <thead>
                <th style="width:40px;">Codigo</th>
                <th style="width:40px;">Ejemplar</th>
                <th>Titulo</th>
                <th></th>
            </thead>
            <?php foreach ($_SESSION["cart"] as $p):
                $book = BookData::getById($p["book_id"]);
                $item = ItemData::getById($p["item_id"]);
                    ?>
            <tr>
                <td><?=$book->isbn; ?>
                </td>
                <td><?=$item->code; ?>
                </td>
                <td><?=$book->title; ?>
                </td>
                <td style="width:30px;">
                    <a href="index.php?view=clearcart&product_id=<?= $book->id; ?>"
                        class="btn btn-xs btn-danger"><i class="material-icons">close</i> Cancelar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <br><br>
        <?php endif; ?>


    </div>
</div>
<script>
    $(document).ready(function() {});
</script>