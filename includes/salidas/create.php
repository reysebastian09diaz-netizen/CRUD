<?php
session_start();
require_once __DIR__ . '/funciones.php';
if (!isset($_SESSION['cedula']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}
$datos = array_map('trim', $_POST);
if (empty($datos['Fecha']) || empty($datos['Hora']) || empty($datos['Destino']) || empty($datos['Barcos_Matricula'])) {
    header('Location: ../../form/modulo.php?tipo=salidas&error=datos');
    exit();
}
header('Location: ../../pag/salidas.php?' . (crear_salida($datos) ? 'mensaje=creado' : 'error=guardar'));
exit();
