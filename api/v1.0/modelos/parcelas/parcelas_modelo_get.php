<?php

  $sql = "SELECT p.* FROM `parcelas` p, `usuarios` u, `parcelas_de_usuarios` pu WHERE p.id=pu.id_parcela AND pu.id_usuario=u.id AND u.id=".$query_params['id'];
    
$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

while ($fila = mysqli_fetch_assoc($resultado)) {
    array_push($respuesta, $fila);
};
