<?php
    include_once("php/conexion.php");
    session_start();
    
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700"rel="stylesheet'>
    <link rel="stylesheet" href="css/perfil.css">



</head>

<body style="min-height:300px">
   <div class="container_principal">
    <div class="container">
        <img src="images/user.svg" alt="Perfil" >
        
        <div id="datosGuardados">
            <p id="pdatosGuardados">Datos cambiados correctamente</p>   
        </div>
        
        
        <p class="UsuarioyEmail"><strong>Usuario:</strong></p>
        <p class="sesiones"><?php echo $_SESSION['nombre'] ?></p>
        
        <p class="UsuarioyEmail"><strong>Email:</strong></p>
        <p class="sesiones"><?php echo $_SESSION['email'] ?></p>
          
         <div class="div_boton_recup">
                <input type="button" name="Cerrar sesión" value="Cancelar" class="boton_recup_cerrarS" onClick='location.href="parcelas.php"'>
                <input type="button" value="Editar" class="boton_recup_editar" onclick='location.href="editarPerfil.php"'>
         </div>
        
       
    </div>
   </div>
</body>

</html>