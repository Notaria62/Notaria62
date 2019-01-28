<?php
/**
 * uploadtemplate short summary.
 *
 * uploadtemplate description.
 *
 * @version 1.0
 * @author DigitalesWeb
 */


?>



<div class="card">
	<div class="card-header card-header-primary">
		<h4 class="card-title">Cargar plantillas</h4>
		<p class="card-category"></p>
	</div>
	<div class="card-body">
		<div class="card-title">
		</div>
		<!-- El tipo de codificación de datos, enctype, DEBE especificarse como sigue -->
		<form enctype="multipart/form-data" action="./?action=uploadtemplate" method="POST">
			<div class="row">
				<div class="col-md-12">
					<!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
					<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
					<!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
					Subir archivo: <input name="fileToUpload" type="file" />
					<br />
					<br />
					<br />
					<button type="submit" class="btn btn-success">Cargar plantilla</button>
				</div>
			</div>
		</form>

	</div>
</div>