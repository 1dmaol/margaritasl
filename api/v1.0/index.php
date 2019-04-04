<?php

require_once('includes/conexion.php');
session_start();

// Recuperar el método de la petición
$metodo = strtolower($_SERVER['REQUEST_METHOD']);

// Recuperar el recurso solicitado
$uri = explode('v1.0/',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[1];
$uri_array = explode('/',$uri);

$recurso = array_shift($uri_array);

// Recuperar parámetros de la query
$query_params = $_GET;

// TODO: Recuperar parámetros de la query
$uri_params = array();
for($i =0; $i < count($uri_array); $i++){
    if($uri_array[$i]!= "") $uri_params[$uri_array[$i]] = $uri_array[++$i]; 
};

// TODO: Recuperar parámetros del body
$body_params = (array) json_decode(file_get_contents('php://input'));

// TODO: Recuperar parámetros de Form Data
$form_params = $_POST;

$output = array();

$output['metodo'] = $metodo;
$output['recurso'] = $recurso;
$output['uri_params'] = $uri_params;
//$output['datos'] = $respuesta;

// Realizar la operación
require('controladores/'. $recurso . '/' .$recurso.'_controlador.php');