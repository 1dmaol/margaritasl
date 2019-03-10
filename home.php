<?php
    include_once("php/conexion.php");
    session_start();    
	
	include("php/bienvenida.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700"rel="stylesheet'>
</head>

<body style="min-height:300px">
 <h1><?php echo "Hola " . $nombre . ", eres un " . $rol; ?></h1>

    <a href="./home.php?salir">Salir</a>
</body>

</html>
