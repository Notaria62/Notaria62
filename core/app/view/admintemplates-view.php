<?php
/**
 * admintemplates short summary.
 *
 * admintemplates description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */
Session::currentURL();

 $listTemplate = NumeroALetras::obtenerListadoDeArchivos("PHPWord/resources");
?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Administrador de plantillas</h4>
        <p class="card-category">Se listan las plantillas usadas para la creacion de minutas y/o reportes</p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg);?>
            <!-- End session comments-->
            <a href="./?view=uploadtemplate" class="btn btn-default">
                <i class="material-icons">cloud_upload</i> Cargar plantilla
            </a>
               <a href="./?view=newmenutemplate" class="btn btn-default">
                <i class="material-icons">menu</i> Agregar opción en menú
            </a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (count($listTemplate) > 0) : ?>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre de archivo</th>
                                <th class="disabled-sorting text-right">Opciones</th>
                            </tr>
                        </thead>
                        <?php foreach ($listTemplate as $value) : ?>
                        <tr data-background-color-approval="">
                            <td>
                                <?php echo  $value["Nombre"]; ?>
                            </td>
                            <td class="text-right">
                                <a href="/<?php echo $value['Nombre']; ?>" data-toggle="tooltip" title="Descargar"
                                    download class="btn btn-link btn-info btn-just-icon btn-sm ">
                                    <i class="material-icons">cloud_download</i>
                                </a>

                            </td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                </div>
                <?php
                else :
                    echo "<p class='alert alert-danger'>No hay archivos de plantillas.</p>";
                endif;
                ?>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        dom: 'lBfrtip',
        buttons: [{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },

            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ],
        language: {
            buttons: {
                print: 'Imprimir'
            },
            search: "_INPUT_",
            searchPlaceholder: "Buscar...",
        }
    });

    $('.card .material-datatables label').addClass('form-group');
});
</script>