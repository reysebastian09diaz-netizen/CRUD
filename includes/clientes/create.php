<?php
session_start();
require_once __DIR__ . '/funciones.php';
if (!isset($_SESSION['cedula']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}
$datos = array_map('trim', $_POST);
if (empty($datos['cedula']) || empty($datos['nombres']) || empty($datos['apellidos']) || empty($datos['direccion']) || empty($datos['telefono'])) {
    header('Location: ../../form/modulo.php?tipo=clientes&error=datos');
    exit();
}
header('Location: ../../pag/clientes.php?' . (crear_cliente($datos) ? 'mensaje=creado' : 'error=guardar'));
exit();
