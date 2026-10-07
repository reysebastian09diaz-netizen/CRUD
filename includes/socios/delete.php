<?php
session_start();
require_once __DIR__ . '/funciones.php';
if (!isset($_SESSION['cedula']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}
$id = trim($_POST['id'] ?? '');
header('Location: ../../pag/socios.php?' . ($id !== '' && eliminar_socio($id) ? 'mensaje=eliminado' : 'error=eliminar'));
exit();
