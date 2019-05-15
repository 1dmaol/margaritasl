<?php

  $sql = "SELECT n.* FROM `notas` n WHERE n.id_usuario = 0 OR n.id_usuario = ".$query_params['id'];
    
$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

while ($fila = mysqli_fetch_assoc($resultado)) {
    array_push($respuesta, $fila);
};
