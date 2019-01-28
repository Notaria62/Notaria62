<?php $procedure = ProcedureData::getById($_GET["id"]);?>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Editar procesos notariales</h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-horizontal" method="post" id="updateprocedure" action="index.php?action=updateprocedure" role="form">

                    <div class="form-group">
                        <label for="inputRadicado" class="bmd-label-floating">Radicado*</label>
                        <div class="col-md-6">
                            <input type="text" name="radicado" value="<?php echo $procedure->radicado;?>" required class="form-control" id="radicado" placeholder="Radicado">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputEscritura" class="bmd-label-floating">Escritura*</label>
                        <div class="col-md-6">
                            <input type="text" name="escritura" value="<?php echo $procedure->escritura;?>" required class="form-control" id="escritura" placeholder="Escritura">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="bmd-label-floating">Email*</label>
                        <div class="col-md-6">
                            <input type="text" name="email" value="<?php echo $procedure->email;?>" required class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAnho" class="bmd-label-floating">Año</label>
                        <div class="col-md-6">

                            <select class="form-control" id="anho" name="anho">
                                <option <?php if($procedure->anho == '2005') echo"selected"; ?> value="2005">2005</option>
                                <option <?php if($procedure->anho == '2006') echo"selected"; ?> value="2006">2006</option>
                                <option <?php if($procedure->anho == '2007') echo"selected"; ?> value="2007">2007</option>
                                <option <?php if($procedure->anho == '2008') echo"selected"; ?> value="2009">2009</option>
                                <option <?php if($procedure->anho == '2010') echo"selected"; ?> value="2010">2010</option>
                                <option <?php if($procedure->anho == '2011') echo"selected"; ?> value="2011">2011</option>
                                <option <?php if($procedure->anho == '2012') echo"selected"; ?> value="2012">2012</option>
                                <option <?php if($procedure->anho == '2013') echo"selected"; ?> value="2013">2013</option>
                                <option <?php if($procedure->anho == '2014') echo"selected"; ?> value="2014">2014</option>
                                <option <?php if($procedure->anho == '2015') echo"selected"; ?> value="2015">2015</option>
                                <option <?php if($procedure->anho == '2016') echo"selected"; ?> value="2016">2016</option>
                                <option <?php if($procedure->anho == '2017') echo"selected"; ?> value="2017">2017</option>
                                <option <?php if($procedure->anho == '2018') echo"selected"; ?> value="2018">2018</option>
                                <option <?php if($procedure->anho == '2019') echo"selected"; ?> value="2019">2019</option>
                                <option <?php if($procedure->anho == '2020') echo"selected"; ?> value="2020">2020</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCI" class="bmd-label-floating">Cedula de identidad*</label>
                        <div class="col-md-6">
                            <input type="text" name="ci" value="<?php echo $procedure->ci;?>" required class="form-control" id="ci" placeholder="Cedula de identidad">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEstatus" class="bmd-label-floating">Estatus*</label>
                        <div class="col-md-6">
                            <select name="estatus" id="estatus" required class="form-control">
                                <option value="">-- SELECCIONE --</option><?php foreach(StatusData::getAll() as $p):?>
                                <option <?php if($procedure->estatus == $p->id) echo"selected"; ?> value="<?php echo $p->id; ?>"><?php echo utf8_encode($p->name).": ".utf8_encode($p->description); ?></option><?php endforeach; ?>
                            </select>
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
                            <input type="hidden" name="id" value="<?php echo $procedure->id;?>">
                            <button type="submit" class="btn btn-success">Actualizar Proceso</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
