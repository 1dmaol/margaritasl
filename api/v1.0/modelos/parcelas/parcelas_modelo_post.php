<?php

$sql = 'INSERT INTO `parcelas`(`nombre`,`color`) VALUES ("'.$form_params['nombre'].'","'.$form_params['color'].'")';

$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

if($resultado === true) { //operador de comparador estricto
    $respuesta['id'] = mysqli_insert_id($conexion);
};