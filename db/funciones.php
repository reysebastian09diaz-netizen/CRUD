<?php

require_once("conexion.php");


function obtener_usuarios()
{
    global $conexion;

    $sql = "SELECT * FROM usuario";
    $resultado = $conexion->query($sql);

    $usuarios = [];

    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
    }

    return $usuarios;
}


function obtener_usuario($documento)
{
    global $conexion;

    $sql = "SELECT * FROM usuario WHERE documento = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $documento);
    $stmt->execute();

    $resultado = $stmt->get_result();

    return $resultado->fetch_assoc();
}


function insertar_usuario($nombre, $documento, $telefono, $email, $direccion, $contraseña)
{
    global $conexion;

    $sql = "INSERT INTO usuario 
            (nombre, documento, telefono, email, direccion, contraseña)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param(
        "ssssss",
        $nombre,
        $documento,
        $telefono,
        $email,
        $direccion,
        $contraseña
    );

    return $stmt->execute();
}


function eliminar_usuario($id)
{
    global $conexion;

    $sql = "DELETE FROM usuario WHERE id_usuario = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    return $stmt->execute();
}

?>