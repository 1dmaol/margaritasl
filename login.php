<?php
    include_once("php/conexion.php");
    session_start();

	include("php/comprobacion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/favicon.png">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700"rel="stylesheet'>
    <link rel="stylesheet" href="css/login.css">
</head>

<body style="min-height:300px">
  <div class="formulario">

    <img src="images/logoGTI.svg" alt="LogoGTI" class="imagenLogo">

    <form action="#" method="post">

      <a href="index.html">
        <img src="images/back.svg" alt="back" class="back">
      </a>
      <h1 class="iniciarSesion"> Iniciar sesión </h1>

      <div class="div_formulario">
        <!--<label class="usuario" for="name">Usuario</label><br>-->
        <p />
        <input name="usuario" type="text" required placeholder="Introducir nombre de usuario">

        <!--<label class="contraseña" for="password">Contraseña</label><br>-->
        <p />
	<input name="clave" type="password" required placeholder="Introducir contraseña">
      </div>

	<p id="error">Usuario o contraseña incorrectos.</p>


      <div class="div_boton">
        <input type="submit" value="Iniciar sesión" class="boton">
      </div>
      <br>

    </form>
  </div>


<script src="js/login.js"> </script>
<?php
if (isset($_GET["msg"]) && $_GET["msg"] == 'failed'){
?>
<script> mostrarError() </script>
<?php }
?>
  </div>
</body>

</html>
