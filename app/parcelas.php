<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location: index.html');
}
include_once("php/conexion.php");
include_once("php/query.php");
if(isset($_GET['salir'])){
    unset($_SESSION['id']);
    unset($_SESSION['nombre']);
    unset($_SESSION['email']);
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Parcelas</title>
        <link rel="icon" href="images/favicon.png">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700"rel="stylesheet'>
        <link rel="stylesheet" href="css/parcelas.css">
        <!-- CSS BOOTSTRAP -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- FIN BOOTSTRAP-->
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">

                <div class="logoImg">
                    <img src="images/logoGTI.svg" class="logo" alt="logoGTI">
                </div>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Parcelas
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="verPerfil.php">Ver perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?salir">Cerrar sesión</a>
                        </li>
                    </ul>
                    <div class="shadow p-3 bg-light rounded" style="height:100px;">
                        <div class="form-inline my-2 my-lg-0">
                            <p>
                                Nombre:
                                <?php echo $_SESSION['nombre']; ?></p>
                        </div>
                        <div class="form-inline my-2 my-lg-0">
                            <p>
                                Email:
                                <?php echo $_SESSION['email']; ?></p>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div id="map">
            <script src="js/map.js"></script>
            <script
                src="https://maps.googleapis.com/maps/api/js?callback=initMap"
                async="async"
                defer="defer"></script>

        </div>

        <div id="listaParcelas">
            <select name="parcelas[]" id="parcelas" onchange="parcelaChangeSelector()">
                <option value="" disabled selected>Selecciona la parcela</option>
            </select>
            <button class="boton" onclick="dibujarParcelas()">Mostrar todas las parcelas</button>
        </div>
        <script src="js/parcelas.js"></script>
        <script>
            crearListaParcelas(<?php echo $parcelas ?>, <?php echo $_SESSION['id']; ?>);
            window.addEventListener("load", function () {
                dibujarParcelas();
            })
            function dibujarParcelas(){
                vaciarMapa();
                dibujarParcela(<?php echo $vertices ?>);
            }
            function parcelaChangeSelector() {
                seleccionarParcelaSelector(<?php echo $vertices; ?>, <?php echo $sondas; ?>);
            }
            function parcelaChange(parcela){
                seleccionarParcela(<?php echo $vertices; ?>, <?php echo $sondas; ?>, parcela);
            }
        </script>

        <!-- carga archivos JS -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>

</html>
