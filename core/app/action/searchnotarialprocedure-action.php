

<?php
//Variable de b�squeda
$consultaBusqueda = $_POST['valorBusqueda'];
//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vac�a (para evitar los E_NOTICE)
$message = "";


//Comprueba si $consultaBusqueda est� seteado
if (isset($consultaBusqueda)) {

	//Selecciona todo de la tabla mmv001
	//donde el nombre sea igual a $consultaBusqueda,
	//o el apellido sea igual a $consultaBusqueda,
	//o $consultaBusqueda sea igual a nombre + (espacio) + apellido


    //$consulta = mysqli_query($conexion, "SELECT * FROM mmv001
    //WHERE nombre COLLATE UTF8_SPANISH_CI LIKE '%$consultaBusqueda%'
    //OR apellido COLLATE UTF8_SPANISH_CI LIKE '%$consultaBusqueda%'
    //OR CONCAT(nombre,' ',apellido) COLLATE UTF8_SPANISH_CI LIKE '%$consultaBusqueda%'
    //");

    $procedures = ProcedureData::getLikeBy($consultaBusqueda);

	//Obtiene la cantidad de filas que hay en la consulta
	$filas = count($procedures);

	//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
	if ($filas === 0) {
		$message = "<p>No hay ning�n usuario con ese nombre y/o apellido</p>";
	} else {
		//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
		//echo 'Resultados para <strong>'.$consultaBusqueda.'</strong>';

?>
<h3>Resultado de b�squeda</h3>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Radicado</th>
            <th>Escritura</th>
            <th>Email</th>
            <th>A�o</th>
            <th>Cedula de identidad</th>
            <th>Estatus</th>
            <th>Usuario ultima actualizaci�n</th>
            <th></th>
        </tr>
    </thead>
    <?php
        foreach($procedures as $procedure){
    ?>
    <tr>
        <td>
            <?php echo $procedure->radicado; ?>
        </td>
        <td>
            <?php echo $procedure->escritura; ?>
        </td>
        <td>
            <?php echo $procedure->email; ?>
        </td>
        <td>
            <?php echo $procedure->anho; ?>
        </td>
        <td>
            <?php echo $procedure->CI; ?>
        </td>
        <td>
            <?php echo $procedure->estatus; ?>
        </td>
        <td>
            <?php
            if($procedure->user_id!=""){
                $u = UserData::getById($procedure->user_id);
                $user = $u->name." ".$u->lastname;
                echo $user;
            }?>
        </td>

        <td style="width:130px;" class="td-actions">
            <a href="./?view=editprocedure&id=<?php echo $procedure->id;?>" data-toggle="tooltip" title="Editar" class="btn btn-simple btn-warning btn-xs">
                <i class="material-icons">edit</i>
            </a>
            <a href="./?action=delprocedure&id=<?php echo $procedure->id;?>" data-toggle="tooltip" title="Eliminar" class=" btn-simple btn btn-danger btn-xs">
                <i class="material-icons">delete</i>
            </a>
        </td>

    </tr>
    <?php
        }
    ?>
</table>
<br /><br />
<?php
	}; //Fin else $filas
};//Fin isset $consultaBusqueda
//Devolvemos el mensaje que tomar jQuery
//echo $message;
?>
