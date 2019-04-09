<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
}
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Parcelas
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?salir">Cerrar sesión</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <a class="perfil" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Perfil
                    </a>
                    <div class="shadow p-3 bg-light rounded dropdown-menu dropdown-menu-right"
                        style="height:auto; width: 300px;" aria-labelledby="dropdownMenu1">
                        <a id="editarPerfil" href="verPerfil.php" style="text-decoration:none;color:black;">
                            <div class="form-inline my-2 my-lg-0" style="float:right;font-size:13px;">
                                Editar
                                <img src="images/pencil-alt-solid.svg" alt="editar" class="editar">
                            </div>
                        </a>
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
            </div>
        </nav>
    </header>

    <div id="controlPantalla" class="grow" style="text-align:center;">
        <button onclick="controlContenedorGrafica()" class="boton" style="background-color:#FFFFFF;">
            <img id="miniatura" src="images/chart.svg" alt="Grafica" height="25px" width="25px">
        </button>
        <span id="text">Mostrar gráfica</span> 
        <p id="qSondas"></p>
    </div>

    <div class="contenedor">
        <div id="herramientas-responsive" class="btn-group dropup">
        <button type="button" class="boton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Herramientas
        </button>
            <div id="listaParcelas" class="dropdown-menu">
                <div>
                    <input id="buscador" type="text" placeholder="Buscar..." onkeydown="buscarParcela()">
                    <div id="parcelas-responsive"></div>
                </div>
            </div>
            <div id="extra">
            </div>
        </div>

        <div id="herramientas">
            <div id="listaParcelas">
                <div>
                    <input id="buscador" type="text" placeholder="Buscar..." onkeydown="buscarParcela()">
                    <div id="parcelas"></div>
                </div>
            </div>
            <div id="extra">

            </div>
        </div>

        <div id="map">
            <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async="async" defer="defer"></script>
        </div>
        <div id="contenedor-grafica">
            <div id="nografica">
                <h3 style="color:rgb(130,0,83)">No hay ninguna sonda seleccionada</h3>
                <p>Para seleccionarla, pulse sobre "Seleccionar sonda" de la sonda disponible.</p>
            </div>
            <div id="grafica" class="grafica">
                <!--Nos permite dibujar en un "lienzo"-->
                <h3 style="color:rgb(130,0,83)"><strong>Gráfico de las mediciones</strong></h3>
                <canvas id="myChart"></canvas>
                <button class="boton" onclick="borrarGrafica()">Vaciar gráfica</button>
            </div>
        </div>

    </div>
            <div class="flecha-bajar text-center" id="bajar"> 
                <a href="#contenedor-grafica"> <img src="images/down.svg" alt="Bajar" width="30px" height="30px"></a>
            </div>
    <script src="js/parcelas.js"></script>
    <script src="js/map.js"></script>
    <script>
        var charged = true;
        getVertices(<?php echo $_SESSION['id']; ?>);
        getParcelas(<?php echo $_SESSION['id']; ?>);
        getSondas(<?php echo $_SESSION['id']; ?>);
        getMediciones(<?php echo $_SESSION['id']; ?>);
        window.addEventListener("load", function () {
            dibujarParcelas();
        })
    </script>

    <!-- carga archivos JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.js"></script>
</body>

</html>