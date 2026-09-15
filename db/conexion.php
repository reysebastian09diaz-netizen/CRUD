<?php

$servidor = "localhost";
$usuario = "root";
$contraseña = "1234";
$base_datos = "biblioteca";

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");

?>