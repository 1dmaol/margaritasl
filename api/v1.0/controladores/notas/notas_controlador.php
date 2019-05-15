<?php

require('modelos/notas/notas_modelo_'.$metodo.'.php');

if (($metodo == "post" || $metodo == "put") && isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

if ($metodo != "delete") require('vistas/vista_json.php');