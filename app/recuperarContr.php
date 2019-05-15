<?php
    include_once("php/conexion.php");
    session_start();

	include("php/comprobacionEmail.php");
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700"rel="stylesheet'>
    <link rel="stylesheet" href="css/recuperacionContr.css">



</head>

<body style="min-height:300px">
    <div class="formulario">

        <img src="images/logoGTI.svg" alt="LogoGTI" class="imagenLogo">

        <form id="form_recup" action="#" method="post">

            <a href="index.php">
                <img src="images/back.svg" alt="back" class="back">
            </a>
            <h1 class="iniciarSesion"> Recuperar contraseña </h1>

            <div class="div_formulario">
                <!--<label class="usuario" for="name">Usuario</label><br>-->
                <p />
                <input name="email" type="text" required placeholder="Introducir correo electrónico">
                <div id="error">
                <p id="perror">Correo no registrado.</p>
                </div>
                <hr>
                <p />
                <input name="password" id="password" type="password" required placeholder="Introducir nueva contraseña">
                <p />
                <input name="cpassword" id="cpassword" type="password" required placeholder="Confirmar nueva contraseña">
                <p />
            </div>
            
            <p id="normasContr">* La contraseña debe tener al menos 6 carácteres, una mayúscula y un número</p>
            <div id="errorContr">
            <p id="perrorContr">Las contraseñas no coinciden</p>
            </div>
            
            <div id="confContr">
            <h2 id="pconfContr">Se ha cambiado correctamente</h2>
            <input type="button" value="Inicio de Sesión" onclick='location.href="login.php"'>
            </div>
            

            <div class="div_boton_recup">
                <input type="button" name="cancelar" value="Cancelar" class="boton_recup_cancel" onClick='location.href="login.php"'>
                <input type="submit" value="Enviar" class="boton_recup_enviar">
            </div>
        </form>
    </div>


<script src="js/recuperarContr.js"></script>
<?php
if (isset($_GET["msg"]) && $_GET["msg"] == 'failed'){
?>
<script> mostrarError() </script>
<?php } 
?>

<?php
if (isset($_GET["msg"]) && $_GET["msg"] == 'failedContr'){
?>
<script> mostrarErrorContr() </script>
<?php } 
?>
    
<?php
if (isset($_GET["msg"]) && $_GET["msg"] == 'confContr'){
?>
<script> mostrarConfContr() </script>
<?php } 
?>

    
</body>

</html>