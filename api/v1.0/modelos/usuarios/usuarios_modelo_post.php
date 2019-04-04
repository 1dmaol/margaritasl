<?php

$sql = "SELECT * FROM usuarios WHERE nombre='" . $form_params['usuario'] . "' AND clave='". $form_params['clave'] ."' LIMIT 1";

$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

if (mysqli_num_rows($resultado) != 0 ) {
    $usuario = mysqli_fetch_assoc($resultado);
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['email'] = $usuario['email'];
}
//if($resultado === true) { //operador de comparador estricto
//    $respuesta['id'] = mysqli_insert_id($conexion);
//};    