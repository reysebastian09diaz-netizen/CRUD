<?php
session_start();
require_once __DIR__ . '/funciones.php';
if (!isset($_SESSION['cedula']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}
$datos = array_map('trim', $_POST);
if (empty($datos['matricula']) || empty($datos['nombre']) || empty($datos['amarre']) || $datos['cuota_amarre'] === '' || empty($datos['socio_cedula'])) {
    header('Location: ../../form/modulo.php?tipo=barcos&error=datos');
    exit();
}
header('Location: ../../pag/barcos.php?' . (crear_barco($datos) ? 'mensaje=creado' : 'error=guardar'));
exit();
