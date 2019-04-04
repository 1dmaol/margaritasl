<?php

$sql = "SELECT p.nombre, m.* FROM `parcelas_de_usuarios` pu,`parcelas` p, `sondas` s, `medidas` m WHERE s.id_parcela=p.id AND s.id=m.id AND pu.id_parcela=p.id AND pu.id_usuario=" . $query_params['id'] . " ORDER BY m.tiempo desc";
$resultado = mysqli_query($conexion, $sql);

$respuesta = array();

while ($fila = mysqli_fetch_assoc($resultado)) {
    array_push($respuesta, $fila);
};
