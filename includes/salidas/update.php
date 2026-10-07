<?php
session_start();
require_once __DIR__ . '/funciones.php';
if (!isset($_SESSION['cedula']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}
$datos = array_map('trim', $_POST);
$id = $datos['id_original'] ?? '';
if ($id === '' || empty($datos['Fecha']) || empty($datos['Hora']) || empty($datos['Destino']) || empty($datos['Barcos_Matricula'])) {
    header('Location: ../../pag/salidas.php?error=datos');
    exit();
}
header('Location: ../../pag/salidas.php?' . (actualizar_salida($datos, $id) ? 'mensaje=actualizado' : 'error=guardar'));
exit();
