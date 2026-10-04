<?php

session_start();
require_once(__DIR__ . '/funciones.php');

if (!isset($_SESSION['cedula'])) {
    header('Location: ../../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../form/formUsuarios.php');
    exit();
}

$nombre = trim($_POST['nombre'] ?? '');
$documento = trim($_POST['documento'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$email = trim($_POST['email'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';
$confirmacion = $_POST['confirmar_contrasena'] ?? '';

if ($nombre === '' || $documento === '' || $telefono === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $contrasena === '' || $contrasena !== $confirmacion) {
    header('Location: ../../form/formUsuarios.php?error=datos');
    exit();
}

if (crear_usuario($nombre, $documento, $telefono, $email, $direccion, $contrasena)) {
    header('Location: ../../pag/users.php?mensaje=creado');
} else {
    header('Location: ../../form/formUsuarios.php?error=crear');
}
exit();
