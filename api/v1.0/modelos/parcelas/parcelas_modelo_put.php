<?php

$sql = 'UPDATE `parcelas` SET `nombre`= "'.$body_params['nombre'].'",`color`="'.$body_params['color'].'" WHERE `id`='.$body_params['id'];

$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

if($resultado === true) {
    $respuesta['exito'] = true;
};