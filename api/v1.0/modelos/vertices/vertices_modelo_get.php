<?php

$sql = "SELECT v.id_parcela, p.lat, p.lng FROM `posiciones` p,`vertices` v, `parcelas_de_usuarios` pu WHERE p.id=v.id_posicion AND v.id_parcela=pu.id_parcela AND pu.id_usuario=" . $query_params['id'];
    
$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

while ($fila = mysqli_fetch_assoc($resultado)) {
    array_push($respuesta, $fila);
};
