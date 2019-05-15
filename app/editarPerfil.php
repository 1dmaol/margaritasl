<?php
    require_once("php/conexion.php");
    session_start();

    $sql = "SELECT * FROM usuarios WHERE id=" . $_SESSION['id'] . " LIMIT 1";
    
    $resultado = mysqli_query($conexion, $sql);
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
        

    <?php
    
        if(mysqli_num_rows($resultado) > 0){
        
            $fila= mysqli_fetch_assoc($resultado);
            ?>
        
          <form action="guardarPerfil.php" method="post">
               <div id="datosGuardados">
                    <p id="pdatosGuardados">Datos cambiados correctamente</p>
                </div>
                <!--<label class="usuario" for="name">Usuario</label><br>-->
                <p class="UsuarioyEmail"><strong>Usuario:</strong></p>
                <input name="nombre" type="text" required placeholder="Introducir nuevo nombre de usuario" value="<?php echo $fila['nombre'];?>">

                <!--<label class="contraseña" for="password">Contraseña</label><br>-->
                <p class="UsuarioyEmail"><strong>Email:</strong></p>
                <input name="email" type="email" required placeholder="Introducir nuevo email" value="<?php echo $fila['email'];?>">
                <p />
           
                  
            <div class="div_boton_recup">
                <input type="button" name="cancelar" value="Cancelar" class="boton_recup_cancel" onClick='location.href="verPerfil.php"'>
                <input type="submit" value="Actualizar" class="boton_recup_enviar" name="update">
            </div>
                
            </form> 
         <?php
        }
    
        else{
            
            echo "No se encontró al usuario";
        }
    
    ?>
           
        </div> 
       
    </div>
   
   
</body>

</html>