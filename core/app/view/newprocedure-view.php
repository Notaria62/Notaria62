


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">
                    Nuevo proceso notarial
                </h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-horizontal" method="post" id="addprocedure" action="./?action=addprocedure" role="form">
                    <div class="form-group">
                        <label for="inputRadicado" class="col-lg-2 control-label">Radicado*</label>
                        <div class="col-md-6">
                            <input type="text" name="radicado" required class="form-control" id="radicado" placeholder="Radicado">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEscritura" class="col-lg-2 control-label">Escritura*</label>
                        <div class="col-md-6">
                            <input type="text" name="escritura" required class="form-control" id="escritura" placeholder="Escritura">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Email*</label>
                        <div class="col-md-6">
                            <input type="text" name="email" required class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAnho" class="col-lg-2 control-label">Año</label>
                        <div class="col-md-6">

                            <select class="form-control" id="anho" name="anho">
                                <option>2005</option>
                                <option>2006</option>
                                <option>2007</option>
                                <option>2009</option>
                                <option>2010</option>
                                <option>2011</option>
                                <option>2012</option>
                                <option>2013</option>
                                <option>2014</option>
                                <option>2015</option>
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCI" class="col-lg-2 control-label">Cedula de identidad*</label>
                        <div class="col-md-6">
                            <input type="text" name="ci" class="form-control" id="ci" placeholder="Cedula de identidad">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEstatus" class="col-lg-2 control-label">Estatus*</label>
                        <div class="col-md-6">
                            <select name="estatus" id="estatus" required class="form-control">
                                <option value="">-- SELECCIONE --</option><?php foreach(StatusData::getAll() as $p):?>
                                <option value="<?php echo $p->id; ?>"><?php echo utf8_encode($p->name).": ".utf8_encode($p->description); ?></option><?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <p class="alert alert-info">* Campos obligatorios</p>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-primary">Agregar Proceso notarial / Envair email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
