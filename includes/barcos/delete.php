<?php
session_start();
require_once __DIR__ . '/funciones.php';
if (!isset($_SESSION['cedula']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}
$id = trim($_POST['id'] ?? '');
header('Location: ../../pag/barcos.php?' . ($id !== '' && eliminar_barco($id) ? 'mensaje=eliminado' : 'error=eliminar'));
exit();
