<?php

$sql = 'DELETE FROM `parcelas` WHERE `id`='.$uri_params['id'];

$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

if($resultado === true) {
    $respuesta['exito'] = true;
};