<?php

require_once(__DIR__ . '/../../db/conexion.php');

function obtener_usuarios()
{
    global $conexion;

    $sql = "SELECT * FROM usuario";

    $resultado = mysqli_query($conexion, $sql);

    return $resultado;
}

function crear_usuario($nombre, $documento, $telefono, $email, $direccion, $contrasena)
{
    global $conexion;

    $sql = "INSERT INTO usuario (nombre, documento, telefono, email, direccion, contraseña) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $documento, $telefono, $email, $direccion, $contrasena);

    return mysqli_stmt_execute($stmt);
}

function obtener_usuario_por_id($id)
{
    global $conexion;

    $sql = "SELECT * FROM usuario WHERE id_usuario = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function eliminar_usuario($id)
{
    global $conexion;

    $sql = "DELETE FROM usuario WHERE id_usuario = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    return mysqli_stmt_execute($stmt);
}

function actualizar_usuario($id, $nombre, $documento, $telefono, $email, $direccion, $contrasena)
{
    global $conexion;

    $sql = "UPDATE usuario SET nombre = ?, documento = ?, telefono = ?, email = ?, direccion = ?, contraseña = ? WHERE id_usuario = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", $nombre, $documento, $telefono, $email, $direccion, $contrasena, $id);

    return mysqli_stmt_execute($stmt);
}

?>
