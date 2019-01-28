<?php
$pacients = PacientData::getAll();
$medics = MedicData::getAll();

$statuses = StatusData::getAll();
$payments = PaymentData::getAll();

?>

<div class="row">
<div class="col-md-10">
<h1>Nueva Cita</h1>
<form class="form-horizontal" role="form" method="post" action="./?action=addreservation">
  <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Asunto</label>
    <div class="col-lg-10">
      <input type="text" name="title" required class="form-control" id="inputEmail1" placeholder="Asunto">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Paciente</label>
    <div class="col-lg-10">
<select name="pacient_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($pacients as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Medico</label>
    <div class="col-lg-10">
<select name="medic_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Fecha/Hora</label>
    <div class="col-lg-5">
      <input type="date" name="date_at" required class="form-control" id="inputEmail1" placeholder="Fecha">
    </div>
    <div class="col-lg-5">
      <input type="time" name="time_at" required class="form-control" id="inputEmail1" placeholder="Hora">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Nota</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="note" placeholder="Nota"></textarea>
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Enfermedad</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="sick" placeholder="Enfermedad"></textarea>
    </div>
  </div>
      <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Sintomas</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="symtoms" placeholder="Sintomas"></textarea>
    </div>
  </div>
        <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Medicamentos</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="medicaments" placeholder="Medicamentos"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Estado de la cita</label>
    <div class="col-lg-10">
<select name="status_id" class="form-control" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Estado del pago</label>
    <div class="col-lg-10">
<select name="payment_id" class="form-control" required>
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>

    <div class="form-group">
    <label for="inputEmail1" class="bmd-label-floating">Costo</label>
    <div class="col-lg-10">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" name="price" placeholder="Costo">
</div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Agregar Cita</button>
    </div>
  </div>
</form>

</div>
</div>