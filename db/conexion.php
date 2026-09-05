<?php

$hostname = "localhost";
$username = "root";
$password = "1234";
$database = "biblioteca";

$conex = mysqli_connect($hostname, $username, $password, $database);

if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}
// echo '<pre>';
// var_dump($conex);
// echo '</pre>';

// if ($conex){
//     echo "conexion exitosa";
// }


// if (!$conex){
//     echo "hubo un error";
//     exit;
// }