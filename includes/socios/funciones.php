<?php
require_once __DIR__ . '/../../db/conexion.php';
function obtener_socios()
{
    global $conexion;
    return $conexion->query('SELECT * FROM socio ORDER BY cedula DESC');
}
function obtener_socio_por_cedula($cedula)
{
    global $conexion;
    $stmt = $conexion->prepare('SELECT * FROM socio WHERE cedula = ?');
    $stmt->bind_param('s', $cedula);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
function crear_socio($datos)
{
    global $conexion;
    $stmt = $conexion->prepare('INSERT INTO socio (cedula, nombres, apellidos, direccion, telefono) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $datos['cedula'], $datos['nombres'], $datos['apellidos'], $datos['direccion'], $datos['telefono']);
    return $stmt->execute();
}
function actualizar_socio($datos, $cedulaOriginal)
{
    global $conexion;
    $stmt = $conexion->prepare('UPDATE socio SET cedula = ?, nombres = ?, apellidos = ?, direccion = ?, telefono = ? WHERE cedula = ?');
    $stmt->bind_param('ssssss', $datos['cedula'], $datos['nombres'], $datos['apellidos'], $datos['direccion'], $datos['telefono'], $cedulaOriginal);
    return $stmt->execute();
}
function eliminar_socio($cedula)
{
    global $conexion;
    $stmt = $conexion->prepare('DELETE FROM socio WHERE cedula = ?');
    $stmt->bind_param('s', $cedula);
    return $stmt->execute();
}
function opciones_socios($campo)
{
    return false;
}
