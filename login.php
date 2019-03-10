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

	<a class="registrar" href="mailto:margaritasl@gmail.com">¿Olvidaste tu contraseña? ¡Contactanos!</a>
<p/>
      <div class="div_registrar">
        <a href="#" onclick="saberMas()" class="registrar">¿No tienes cuenta?</a>
        <div class="saberMas-popup" id="popup">
          <span class="registrar">Obtén una cuenta</span>
          <img src="images/close.svg" alt="close" class="cross-popup" onclick="saberMas()">
          <br>
          <p class="info">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia nostrum porro, quos deleniti odit, ratione sequi magnam sit tenetur voluptates repudiandae similique iusto veritatis delectus ab est nesciunt ad nemo.</p>
          <a href="#">Saber más</a>
        </div>
      </div>

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
