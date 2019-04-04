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
        <form id="form" action="../api/v1.0/usuarios" method="post">
            <a href="../index.php">
                <img src="images/back.svg" alt="back" class="back">
            </a>
            <h1 class="iniciarSesion"> Iniciar sesión </h1>
            <div class="div_formulario">
                <p>
                    <input name="usuario" type="text" required placeholder="Introducir nombre de usuario">
                    <p>
                        <input name="clave" type="password" required placeholder="Introducir contraseña">
                        <div id="error">
                            <p id="perror">El usuario o la contraseña son incorrectos</p>
                        </div>
                        <div class="div_boton">
                            <input type="submit" value="Iniciar sesión" class="boton">
                        </div>
                        <br>
                        <a class="registrar" href="recuperarContr.php">Recuperar Contraseña</a>
                        <p>
        </form>
    </div>

    </div>


    <script src="js/login.js"> </script>
    <script>
        if (window.location.search.substr(1) == "failed") {
            mostrarError()
        }
    </script>
</body>

</html>
