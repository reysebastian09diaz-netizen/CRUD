<?php

session_start();
require_once(__DIR__ . '/funciones.php');

if (!isset($_SESSION['cedula']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

$id = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
$nombre = trim($_POST['nombre'] ?? '');
$documento = trim($_POST['documento'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$email = trim($_POST['email'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';
$confirmacion = $_POST['confirmar_contrasena'] ?? '';

if (!$id || $nombre === '' || $documento === '' || $telefono === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $contrasena === '' || $contrasena !== $confirmacion) {
    header("Location: ../../pag/actualizar.php?id={$id}&error=datos");
    exit();
}

if (actualizar_usuario($id, $nombre, $documento, $telefono, $email, $direccion, $contrasena)) {
    header('Location: ../../pag/users.php?mensaje=actualizado');
} else {
    header("Location: ../../pag/actualizar.php?id={$id}&error=actualizar");
}
exit();
