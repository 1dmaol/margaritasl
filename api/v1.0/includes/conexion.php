<?php
// FIXME: configurar BBDD
$bbdd_server = 'localhost';
$bbdd_user = 'root';
$bbdd_password = '';
$bbdd = 'pw_grupo06';

$conexion = mysqli_connect($bbdd_server,$bbdd_user,$bbdd_password,$bbdd);
mysqli_query($conexion, 'SET NAMES utf8');
