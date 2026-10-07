<?php
session_start();
require_once __DIR__ . '/funciones.php';
if (!isset($_SESSION['cedula']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}
$datos = array_map('trim', $_POST);
$id = $datos['id_original'] ?? '';
if ($id === '' || empty($datos['cedula']) || empty($datos['nombres']) || empty($datos['apellidos']) || empty($datos['direccion']) || empty($datos['telefono'])) {
    header('Location: ../../pag/socios.php?error=datos');
    exit();
}
header('Location: ../../pag/socios.php?' . (actualizar_socio($datos, $id) ? 'mensaje=actualizado' : 'error=guardar'));
exit();
