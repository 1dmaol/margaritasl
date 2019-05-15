<?php

$sql = 'UPDATE `notas` SET `asunto`= "'.$form_params['asunto'].'",`descripcion`="'.$form_params['contenido'].'" WHERE `id`='.$form_params['id'];

$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

if($resultado === true) {
    $respuesta['exito'] = true;
};