<?php

if( $_POST["submit"] ){
    echo "asdfsadf";
    foreach($_POST as $campo => $valor) {
        $_SESSION['registro'][$campo] = $valor;
    }
}
// var_dump($_SESSION['registro']);



?>

<p>--<?php echo $_SESSION['registro']['nombre'];?><?php echo $_SESSION['registro']['email'];?><?php echo $_SESSION['registro']['clave'];?></p>