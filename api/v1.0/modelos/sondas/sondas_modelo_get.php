<?php

$sql = "SELECT pu.id_parcela, s.id, p.lat, p.lng FROM `posiciones` p,`sondas` s, `parcelas_de_usuarios` pu WHERE p.id=s.id_posicion AND s.id_parcela=pu.id_parcela AND pu.id_usuario=" . $query_params['usuario'];
    
$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

while ($fila = mysqli_fetch_assoc($resultado)) {
    array_push($respuesta, $fila);
};
