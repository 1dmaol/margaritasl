<?php

$sql = 'DELETE FROM `notas` WHERE `id`='.$query_params['id'];

$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

if($resultado === true) {
    $respuesta['exito'] = true;
};