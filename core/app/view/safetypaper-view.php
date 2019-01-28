
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
                <h4 class="title">Pepel de seguridad extraviado en notarias</h4>
            </div>
            <div class="card-content table-responsive">
                <a href="index.php?view=newsafetypaper" class="btn btn-default">
                    <i class='fa fa-paperclip'></i>Nuevo papel de seguridad
                </a>
                <?php
                $record_per_page = 5;
                $result = SafetyPaperData::getAllNumRow();
                //echo " sdsdfsdfs ". $result."---";
                $total_records = count($result);
                $total_pages = ceil($total_records / $record_per_page);
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                $this_page_first_result = ($page - 1) * $record_per_page;
                $papers = SafetyPaperData::getAllLimitRow($this_page_first_result, $record_per_page);
                if (count($papers) > 0) {
                    ?>

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
                    <?php foreach ($papers as $paper) {
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
                            <a href="./?view=editsafetypaper&id=<?php echo $paper->id; ?>" data-toggle="tooltip" title="Editar" class="btn btn-simple btn-warning btn-xs">
                                <i class='fa fa-pencil'></i>
                            </a><?php
                              $u = UserData::getById(Session::getUID());
                        if ($u->is_admin):
                                ?>
                            <a href="./?action=delsafetypaper&id=<?php echo $paper->id; ?>" data-toggle="tooltip" title="Eliminar" class=" btn-simple btn btn-danger btn-xs">
                                <i class='fa fa-remove'></i>
                            </a><?php endif; ?>
                        </td>
                    </tr>
                    <?php
                    } ?>
                </table>
                <div align="center">
                    <br />
                    <?php
                    $start_loop = $page;
                    $difference = $total_pages - $page;
                    if ($difference <= 5) {
                        $start_loop = $total_pages - 5;
                    }
                    $end_loop = $start_loop + 5;
                    if ($page == 1) {
                        echo '<ul class="pagination"><li class="disabled"><a href="./?view='.$_GET['view'].'&page=1"><<</a></li>';
                        echo '<li class="disabled"><a href="./?view='.$_GET['view'].'&page='.$page.'"><</a></li>';
                    } else {
                        echo '<ul class="pagination"><li><a href="./?view='.$_GET['view'].'&page=1"><<</a></li>';
                        echo '<li><a href="./?view='.$_GET['view'].'&page='.($page-1).'"><</a></li>';
                    }
                    for ($i=$start_loop; $i<=$end_loop; $i++) {
                        $active ="";
                        
                        if ($i == $_GET['page']) {
                            $active = "active";
                        }
                        
                        echo '<li class="'.$active.'"><a href="./?view='.$_GET['view'].'&page='.$i.'">'.$i.'</a><li>';
                    }
                    // Setting up the Next & Last Button
                    if ($page == $total_pages) {
                        echo'<li class="disabled"><a href="./?view='.$_GET['view'].'&page='.($page-1).'">></a></li>';
                        echo '<li class="disabled"><a href="./?view='.$_GET['view'].'&page='.$number_of_pages.'">>></a></li></ul>';
                    } else {
                        echo'<li><a href="./?view='.$_GET['view'].'&page='.($_GET['page']+1).'">></a></li>';
                        echo '<li><a href="./?view='.$_GET['view'].'&page='.$total_pages.'">>></a></li>';
                    }
                    echo'</ul>'; ?>
                </div>
                <div class="form-group">
                    Total registros: <?php echo $total_records?>
                </div>
                <br />
                <br />
                <?php
                } else {
                    echo "<p class='alert alert-danger'>No hay papel reportado.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
