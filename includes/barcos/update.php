<?php
session_start();
require_once __DIR__ . '/funciones.php';
if (!isset($_SESSION['cedula']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}
$datos = array_map('trim', $_POST);
$id = $datos['id_original'] ?? '';
if ($id === '' || empty($datos['matricula']) || empty($datos['nombre']) || empty($datos['amarre']) || $datos['cuota_amarre'] === '' || empty($datos['socio_cedula'])) {
    header('Location: ../../pag/barcos.php?error=datos');
    exit();
}
header('Location: ../../pag/barcos.php?' . (actualizar_barco($datos, $id) ? 'mensaje=actualizado' : 'error=guardar'));
exit();
