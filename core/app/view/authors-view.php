<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Autor</h4>
        <p class="card-category"></p>
      
  </div>
    <div class="card-body">
        <div class="card-title">
        <a href="index.php?view=newcategory" class="btn btn-default">
                    <i class='fa fa-th-list'></i>Nueva Categoria
                </a>

        </div>
       
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Creadores</h4>
                
           
                <div class="card-content table-responsive">
            
            <a href="./?view=newauthor" class="btn btn-default">
                    <i class='fa fa-th-list'></i> Nuevo Autor
                </a>   
                <?php
                $users = AuthorData::getAll();
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
                        <td><?php echo $user->name." ".$user->lastname; ?>
                        </td>
                        <td style="width:130px;">
                            <a href="./?view=editauthor&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs.">Editar</a>
                            <a href="./?action=delauthor&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs.">Eliminar</a>
                        </td> 

                    </tr><?php
                    }
                         ?>
                </table>
                <?php
                }else{
                    echo "<p class='alert alert-danger'>No hay Autores</p>";
                }
                ?>

            </div>
                </div>
        </div>