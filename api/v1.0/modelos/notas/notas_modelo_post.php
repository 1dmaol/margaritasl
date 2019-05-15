<?php

$sql = 'INSERT INTO `notas`(`id_usuario`,`fecha`,`asunto`,`descripcion`) VALUES ('. $form_params['id'] .',"' . $form_params['fecha'] . '", "'.$form_params['asunto'].'", "'.$form_params['contenido'].'")';

$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

if($resultado === true) { //operador de comparador estricto
    $respuesta['id'] = mysqli_insert_id($conexion);
};