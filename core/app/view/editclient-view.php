<?php 
$employee = ClientData::getById($_GET["id"]);?>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">
                    Editar empleado
                </h4>
            </div>
            <div class="card-content table-responsive">

                <form class="form-horizontal" method="post" id="addproduct" action="./?action=updateclient" role="form">

                    <div class="form-group">
                        <label for="inputEmail1" class="bmd-label-floating">Nombre*</label>
                        <div class="col-md-6">
                            <input type="text" name="name" value="<?php echo $employee->name;?>" class="form-control"
                                id="name" placeholder="Nombre" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="bmd-label-floating">Apellido*</label>
                        <div class="col-md-6">
                            <input type="text" name="lastname" value="<?php echo $employee->lastname;?>" required
                                class="form-control" id="lastname" placeholder="Apellido" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputcc" class="bmd-label-floating">C.C.*</label>
                        <div class="col-md-6">
                            <input type="text" name="cc" value="<?php echo $employee->cc;?>" required
                                class="form-control" id="cc" placeholder="C.C." />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="bmd-label-floating">Email*</label>
                        <div class="col-md-6">
                            <input type="text" name="email" value="<?php echo $employee->email;?>" class="form-control"
                                id="email" placeholder="Email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputaddress" class="bmd-label-floating">Direccion*</label>
                        <div class="col-md-6">
                            <input type="text" name="address" value="<?php echo $employee->address;?>"
                                class="form-control" required id="address" placeholder="Direccion" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputphone" class="bmd-label-floating">Telefono</label>
                        <div class="col-md-6">
                            <input type="text" name="phone" value="<?php echo $employee->phone;?>" class="form-control"
                                id="phone" placeholder="Telefono" />
                        </div>
                    </div>

                    <p class="alert alert-info">* Campos obligatorios</p>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <input type="hidden" name="id" value="<?php echo $employee->id;?>" />
                            <button type="submit" class="btn btn-primary">Actualizar empleado</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>