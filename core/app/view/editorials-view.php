<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Empresa</h4>
        <p class="card-category">Modulo de empresa</p>
    </div>
    <div class="card-body">
        <div class="card-title">
        <a href="index.php?view=newcategory" class="btn btn-default">
                    <i class='fa fa-th-list'></i>
                </a>

        </div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Editoriales</h4>
            </div>
            <div class="card-content table-responsive">
                <a href="index.php?view=neweditorial" class="btn btn-default">
                    <i class='fa fa-th-list'></i>
                </a>

                <h1></h1>
                <br /><?php
                      $users = EditorialData::getAll();
                      if(count($users)>0){
                          // si hay usuarios
                      ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>Nombre</th>
                        <th></th>
                    </thead><?php
                          foreach($users as $user){
                            ?>
                    <tr>
                        <td>
                            <?php echo $user->name; ?>
                        </td>
                        <td style="width:130px;" class="td-actions">
                            <a href="./?view=editeditorial&id=<?php echo $user->id;?>" data-toggle="tooltip" title="Editar" class="btn btn-simple btn-warning btn-xs">
                                <i class='fa fa-pencil'></i>
                            </a>
                            <a href="./?action=deleditorial&id=<?php echo $user->id;?>" data-toggle="tooltip" title="Eliminar" class=" btn-simple btn btn-danger btn-xs">
                                <i class='fa fa-remove'></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                          }?>
                </table><?php
                      }else{
                          echo "<p class='alert alert-danger'>No hay Editoriales</p>";
                      }
                        ?>

            </div>
        </div>
    </div>
</div>
