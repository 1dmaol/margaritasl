<?php

require_once("php/conexion.php");
session_start();
if($_SESSION['id'] != 0){

$sql= 'UPDATE `usuarios` SET 
`nombre`= "'.$_POST['nombre'].'",
`email`= "'.$_POST['email'].'"
WHERE id= '.$_SESSION['id'];
    
    } 


$resultado= mysqli_query($conexion,$sql);

$id= $_SESSION['id']; //asigno a la variable id, la id recogida del post

if($id == 0) $id = mysqli_insert_id($conexion);

if($resultado){
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['nombre'] = $_POST['nombre'];
    header('Location: verPerfil.php');
}


?>