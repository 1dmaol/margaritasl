<?php
    $sql = "SELECT p.* FROM `parcelas` p, `usuarios` u, `parcelas_de_usuarios` pu WHERE p.id=pu.id_parcela AND pu.id_usuario=u.id AND u.id=".$_SESSION['id'] ;
    $result = mysqli_query($conexion, $sql);

    $json_array = array();

    while($row = mysqli_fetch_assoc($result)){
        $json_array[] = $row;
    }

    $parcelas = json_encode($json_array);    

    
    $sql = "SELECT v.id_parcela, p.lat, p.lng FROM `posiciones` p,`vertices` v, `parcelas_de_usuarios` pu WHERE p.id=v.id_posicion AND v.id_parcela=pu.id_parcela AND pu.id_usuario=" . $_SESSION['id'];

    $result = mysqli_query($conexion, $sql);
    $json_array = array();
    while($row = mysqli_fetch_assoc($result)){
        $json_array[] = $row;
    }

    $vertices = json_encode($json_array);    
    
    
    $sql = "SELECT pu.id_parcela, p.lat, p.lng FROM `posiciones` p,`sondas` s, `parcelas_de_usuarios` pu WHERE p.id=s.id_posicion AND s.id_parcela=pu.id_parcela AND pu.id_usuario=" . $_SESSION['id'];

    $result = mysqli_query($conexion, $sql);
    
    $json_array = array();
    while($row = mysqli_fetch_assoc($result)){
        $json_array[] = $row;
    }

    $sondas = json_encode($json_array);    
?>