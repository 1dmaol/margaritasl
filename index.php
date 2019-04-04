<?php 
    if(isset($_SESSION['id'])){
        header('Location: app/parcelas.php');
    }
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Margarita S.L.</title>
        <link rel="icon" href="images/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="app/">
        <link
            rel='stylesheet'
            href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
        <link
            rel='stylesheet'
            href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link
            rel='stylesheet'
            href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700"rel="stylesheet'>
        
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <header>
            <div class="header_top" id="navbar">
                <div class="logoImg">
                    <img src="images/logoGTI.svg" class="logo" alt="logoGTI">
                </div>
                <!-- menu que aparece arriba a la derecha-->
                <nav class="top-nav hidden-md-down">
                    <ul>
                        <li>
                            <a href="login.php">
                                <strong>Iniciar sesión</strong>
                            </a>
                        </li>
                    </ul>
                </nav>
                <nav class="header_top-responsive hidden-lg-up">
                    <!-- icono de menu desplegable-->
                    <a class="login" href="login.php">
                        <img src="images/user.svg" alt="Perfil">
                    </a>
                </nav>
            </div>
            <div class="container">

                <div class="header_content">
                    <h2>Margarita S.L.</h2>
                    <hr>
                    <p>Controla los parametros de tu cultivo.</p>
                </div>
                <a class="nextpage scroll" href="#servicios"><img src="images/down.svg" alt="Bajar"></a>
            </div>
        </header>

        <section id="servicios">
            <div class="container">
                <h2>Nuestros servicios</h2>
                <hr>
                <p>
                    <span class="bold">Margarita S.L.
                    </span>
                    <strong>es una empresa pionera</strong>
                    e
                    <strong>innovadora
                    </strong>en el sector agrícola.</p>
                <!-- seccion video margarita sl youtube-->
                <video width="320" height="240" poster="images/poster.png" controls="controls">
                    <source src="media/feed.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="shadow p-3 mb-5 bg-light rounded">
                    <article>
                        Con nuestra aplicación, podrás visualizar los parámetros de tus cultivos, ver su
                        posicion, representarlos graficamente y compartir los resultados en cualquier
                        lugar y a cualquier hora.
                    </article>
                </div>
            </div>
            <a class="nextpage scroll" href="#contacto"><img src="images/down.svg" alt="Bajar"></a>
        </section>
        <a class="btn scroll" id="myBtn" href="#navbar">Subir</a>
        <footer id="contacto">

            <h3>¿Tienes alguna duda?
                <span class="text-strong">¡Consultanos!</span></h3>
            <form action="">
                <ul class="flex-outer">
                    <li>
                        <label for="Nombre">Nombre:
                        </label><input
                            type="text"
                            class="formularioFooter"
                            name="Nombre"
                            placeholder="Introduce su nombre"></li>
                    <li>
                        <label for="Email">Correo:
                        </label><input
                            type="email"
                            class="formularioFooter"
                            name="Email"
                            placeholder="Introduce su correo"></li>
                    <li>
                        <label for="Asunto">Asunto:
                        </label><input
                            type="text"
                            class="formularioFooter"
                            name="Asunto"
                            placeholder="Introduce el asunto"></li>
                    <li>
                        <label for="Descripcion">Descripción:
                        </label>
                        <textarea
                            name="comentario"
                            class="formularioFooter"
                            form="contacto"
                            placeholder="Introduce la información"></textarea>
                    </li>
                    <li>
                        <div id="boton"><input type="submit" class="btn"/></div>
                    </li>
                </ul>
            </form>
            <div class="other">
                <section id="empresa">

                    <article class="responsivefooter">
                        <p>Telefono: 66 600 01 22</p>
                        <p>C/ Vera, 21 –Centro de innovación
                            <br>
                            Universitat Politectnica de valencia</p>
                        <p>¡No te olvides de visitar nuestras redes sociales!</p>
                    </article>

                    <article class="localizacion">
                        <p >Telefono: 66 600 01 22</p>
                        <p >C/ Vera, 21 –Centro de innovación
                            <br>
                            Universitat Politectnica de valencia</p>
                    </article>

                    <article class="redes-sociales">
                        <p>En Margarita S.L. nos preocupamos por estar lo más actualizados posible, ¡no
                            te olvides de visitar nuestras redes sociales!</p>
                        <p>Podrás encontrar diariamente información de interés de la mano directa de
                            Margarita S.L.</p>
                    </article>

                    <ul>
                        <li>
                            <a href="https://www.facebook.com/margarita.quintero.315213"><img src="images/icons/facebook-letter-logo.svg" alt="Facebook"></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/MargaritaSL1"><img src="images/icons/twitter.svg" alt="Twitter"></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UC8rqd7k7zql9L82EqsuAxvA"><img src="images/icons/youtube-logo.svg" alt="Youtube"></a>
                        </li>
                    </ul>
                </section>
            </div>

        </footer>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

        <script src='https://unpkg.com/scrollreveal/dist/scrollreveal.min.js'></script>

        <script src="js/index.js"></script>

        <script>
            // When the user scrolls the page, execute myFunction When the user scrolls down
            // 20px from the top of the document, show the button
            window.onscroll = function () {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document
                        .getElementById("myBtn")
                        .style
                        .display = "block";

                } else {
                    document
                        .getElementById("myBtn")
                        .style
                        .display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }
        </script>
    </body>
