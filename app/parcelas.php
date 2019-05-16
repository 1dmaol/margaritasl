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
                                <img src="images/edit.svg" alt="editar" class="editar">
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal3Label">Borrar nota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          Estas seguro que deseas borrar la nota?
      </div>
      <div class="modal-footer">
        <button type="button" class="boton-secundario" data-dismiss="modal">Cancelar</button>
        <button type="button" class="boton" onclick="eliminarNota()">Borrar</button>
      </div>
    </div>
  </div>
</div>
    <!--
    <div id="controlPantalla" class="grow" style="text-align:center;">
        <button onclick="controlContenedorGrafica()" class="boton" style="background-color:#FFFFFF;">
            <img id="miniatura" src="images/chart.svg" alt="Grafica" height="25px" width="25px">
        </button>
        <span id="text">Mostrar gráfica</span> 
        <p id="qSondas"></p>
    </div>
-->
    <div class="contenedor">
        <div id="herramientas-responsive">
            <div id="listaParcelas-responsive" style="margin-top:5px;">
                <a type="button" class="boton" data-toggle="popover" data-container="body" data-html="true" href="javascript: crearListaParcelas()" 
                title="Lista de parcelas" data-content="<div id='parcelas-responsive'></div>" data-placement="bottom">Lista de parcelas</a>                
            </div>

            <div id="contenedor-tiempo-responsive">
                <button class="boton" id="js_w_temp-responsive" type="button" data-toggle="collapse"
                    data-target="#prox-tiempo-responsive" aria-expanded="false"
                    aria-controls="prox-tiempo-responsive"></button>
                <div id="prox-tiempo-responsive" class="collapse">
                    <div class="dias" id="js_w_mmDia1-responsive"></div>
                    <div class="dias" id="js_w_mmDia2-responsive"></div>
                    <div class="dias" id="js_w_mmDia3-responsive"></div>
                </div>
            </div>
            <div style="margin-top:5px;">
                <a type="button" class="boton" data-toggle="popover" data-container="body" data-html="true" href="javascript: llenarNotas()" 
                title="<span id='tituloNota'>Notas</span> <a id='añadirNota'><img src='images/plus.svg' alt='Añadir' height='17px' width='17px'></a> <a id='editarNota'><img src='images/edit.svg' alt='Editar' height='17px' width='17px'></a><a id='borrarNota'><img src='images/trash.svg' alt='Borrar' height='17px' width='17px'></a>" data-content="<div id='notas-responsive'></div>" data-placement="bottom">Notas</a>
                </div>
            </div>

        <div id="herramientas">
            <div id="listaParcelas">
                <div>
                    <input id="buscador" type="text" placeholder="Buscar..." onkeydown="buscarParcela()">
                    <div id="parcelas"></div>
                </div>
            </div>
            <hr>
            <div id="listaSondas">
                <div>
                    <h5>Sondas: </h5>
                    <div id="sondas"></div>
                </div>
            </div>
            <hr>

            <div id="contenedor-tiempo">
                <button class="boton" id="js_w_temp" type="button" data-toggle="collapse" data-target="#prox-tiempo"
                    aria-expanded="false" aria-controls="prox-tiempo"></button>
                <div id="prox-tiempo" class="collapse">
                    <div class="dias" id="js_w_mmDia1"></div>
                    <div class="dias" id="js_w_mmDia2"></div>
                    <div class="dias" id="js_w_mmDia3"></div>
                </div>
            </div>
        </div>
        <div id="contenedor-notas">
            <!--<button class="boton">Notas</button>-->
        </div>

        <div id="map">
        </div>
        <div id="contenedor-grafica" class="collapse">
            <a class="pantallaCompleta" href="#" style="text-decoration:none;color:black;">
                <div class="form-inline my-2 my-lg-0" style="float:right;font-size:13px;">
                    <img src="images/fullscreen.svg" alt="fullscreen" class="editar">
                </div>
            </a>
            <div id="nografica">
                <h5 style="color:rgb(130,0,83)">No hay ninguna sonda seleccionada</h5>
                <p>Para seleccionarla, pulse sobre "Seleccionar sonda" de la sonda disponible.</p>
            </div>
            <div id="grafica" class="grafica">
                <!--Nos permite dibujar en un "lienzo"-->
                <h5 style="color:rgb(130,0,83)"><strong>Gráfico de las mediciones</strong></h5>
                <canvas id="myChart"></canvas>
                <div class="d-flex justify-content-center">
                    <button id="toPDF" onclick="toPDF()" class="boton" style="margin-right:2.5px;">Exportar a
                        PDF</button>
                    <button class="boton" onclick="borrarGrafica()" style="margin-left:2.5px;">Vaciar gráfica</button>
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="flecha-bajar text-center" id="bajar">
        <a href="#contenedor-grafica"> <img src="images/down.svg" alt="Bajar" width="30px" height="30px"></a>
    </div>
    -->
    <div id="desplegableGrafica" class="position-bottom">
        <button class="boton" type="button" data-toggle="collapse" data-target="#contenedor-grafica-responsive"
            aria-expanded="false" aria-controls="contenedor-grafica-responsive">
            <img id="flecha" src="images/down.svg" alt="Subir" width="15px" height="15px"
                style="transform: rotate(180deg);">
            Gráfica
        </button>
    </div>
    <div id="contenedor-grafica-responsive" class="collapse">
        <button class="pantallaCompleta" onclick="fullscreen()">
            <div class="form-inline my-2 my-lg-0" style="float:right;font-size:13px;">
                <img src="images/fullscreen.svg" alt="fullscreen" class="editar">
            </div>
        </button>
        <div id="nografica-responsive">
            <h5 style="color:rgb(130,0,83)">No hay ninguna sonda seleccionada</h5>
            <p>Para seleccionarla, pulse sobre "Seleccionar sonda" de la sonda disponible.</p>
        </div>
        <div id="grafica-responsive" class="grafica">
            <!--Nos permite dibujar en un "lienzo"-->
            <h5 style="color:rgb(130,0,83)"><strong>Gráfico de las mediciones</strong></h5>
            <canvas id="myChartR"></canvas>
            <div id="fsBox">
            <img src="images/mapaClima.png" class="img-fluid" alt="Responsive image">
            </div>
            <div class="d-flex justify-content-center">
                <button id="toPDF-responsive" onclick="toPDF()" class="boton" style="margin-right:2.5px;">Exportar a
                    PDF</button>
                <button class="boton" onclick="quitarGrafica()" style="margin-left:2.5px;">Vaciar gráfica</button>
            </div>
        </div>
        </div>
    </div>
    <script src="js/parcelas.js"></script>
    <script src="js/map.js"></script>
    <script>
        var id = <?php echo $_SESSION['id'] ?> ;
        var charged = true;
        getVertices(id);
        getParcelas(id);
        getSondas(id);
        getMediciones(id);
        getNotas(id);
        window.addEventListener("load", function () {
            dibujarParcelas();
        })
    </script>
    <!-- carga archivos JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/pdf.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script src="js/html2canvas.min.js"></script>
    <script src="js/tiempo.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async="async" defer="defer"></script>
</body>

</html>
<!-- function mostrar_noMostrar(medicion) {
    var contador = 0;
    for (var i = 0; i <= myChart.data.labels.length - 1; i++) {
        if (myChart.data.labels[i] == medicion) {
            var posicion = i;
            contador++;
        }
    }
    if (contador > 0) {
        myChart.data.labels.splice(posicion, 1);
        for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
            myChart.data.datasets[i].data.splice(posicion, 1);
        }
    } else if (contador == 0) {
        if (medicion == "Temperatura") {
            myChart.data.labels.splice(0, 0, medicion);
            for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
                myChart.data.datasets[i].data.splice(0, 0, 40 /*Dato*/ );
            }
        }

        if (medicion == "Humedad") {
            if (myChart.data.labels[0] == "Temperatura") {
                myChart.data.labels.splice(1, 0, medicion);
                for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
                    myChart.data.datasets[i].data.splice(1, 0, 20 /*Dato*/ );
                }
            } else {
                myChart.data.labels.splice(0, 0, medicion);
                for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
                    myChart.data.datasets[i].data.splice(0, 0, 20 /*Dato*/ );
                }
            }
        }

        if (medicion == "Salinidad") {
            if (myChart.data.labels[0] == "Temperatura" && myChart.data.labels[1] == "Humedad") {
                myChart.data.labels.splice(2, 0, medicion)
                for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
                    myChart.data.datasets[i].data.splice(2, 0, 80 /*Dato*/ );
                }
            } else if (myChart.data.labels[0] == "Temperatura" && myChart.data.labels[1] != "Humedad") {
                myChart.data.labels.splice(1, 0, medicion)
                for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
                    myChart.data.datasets[i].data.splice(1, 0, 80 /*Dato*/ );
                }
            } else if (myChart.data.labels[0] == "Humedad") {
                myChart.data.labels.splice(1, 0, medicion)
                for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
                    myChart.data.datasets[i].data.splice(1, 0, 80 /*Dato*/ );
                }
            } else {
                myChart.data.labels.splice(0, 0, medicion)
                for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
                    myChart.data.datasets[i].data.splice(0, 0, 80 /*Dato*/ );
                }
            }

        }

        if (medicion == "Iluminación") {
            if (myChart.data.labels[myChart.data.labels.length - 1] == "Presión") {
                var a = myChart.data.labels.length - 1;
                myChart.data.labels.splice(a, 0, medicion);
                for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
                    myChart.data.datasets[i].data.splice(a, 0, 60 /*Dato*/ );
                }
            } else {
                myChart.data.labels.push(medicion);
                for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
                    myChart.data.datasets[i].data.push(60 /*Dato*/ );
                }
            }
        }

        if (medicion == "Presión") {
            myChart.data.labels.push(medicion);
            for (let i = 0; i <= myChart.data.datasets.length - 1; i++) {
                myChart.data.datasets[i].data.push(50 /*Dato*/ );
            }
            console.log(myChart.data);
        }
    }

    //console.log(myChart.data.labels)
    myChart.update();

} -->