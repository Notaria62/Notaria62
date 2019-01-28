
<?php if (isset($_GET["paper_code"]) && $_GET["paper_code"] != ""): ?>
<?php
          $papers = SafetyPaperData::getLike($_GET["paper_code"]);
          if (count($papers) > 0) {
?>
<h3>Resultados de la Busqueda</h3>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>C&oacute;d. hoja</th>
            <th>EP</th>
            <th>Notaria</th>
            <th>Radicado SNR</th>
            <th>Fecha de reporte perdida</th>
            <th></th>
        </tr>
    </thead>
    <?php
              $products_in_cero = 0;
              foreach ($papers as $paper):
    ?>
    <tr>
        <td>
            <?php echo $paper->codsheet; ?>
        </td>
        <td>
            <?php echo $paper->ep; ?>
        </td>
        <td>
            <?php echo $paper->address; ?>
        </td>
        <td>
            <?php echo $paper->radicadosnr; ?>
        </td>
        <td>
            <?php echo $paper->reportdate; ?>
        </td>
        <td style="width:150px;" class="td-actions">
            <a href="./?view=editsafetypaper&id=<?php echo $paper->id;?>" data-toggle="tooltip" title="Editar" class="btn btn-simple btn-warning btn-xs">
                <i class='fa fa-pencil'></i>
            </a><?php
                  $u = UserData::getById(Session::getUID());
                  if ($u->is_admin):
                ?>
            <a href="./?action=delsafetypaper&id=<?php echo $paper->id;?>" data-toggle="tooltip" title="Eliminar" class=" btn-simple btn btn-danger btn-xs">
                <i class='fa fa-remove'></i>
            </a><?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
          }else {
              echo "<br><p class='alert alert-danger'>No se encontro la hoja</p>";
          }
?>
<hr />
<br />
<?php else:
?>
<?php endif; ?>