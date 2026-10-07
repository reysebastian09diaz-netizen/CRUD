<?php
require_once __DIR__ . '/../../db/conexion.php';
function obtener_clientes()
{
    global $conexion;
    return $conexion->query('SELECT * FROM socio ORDER BY cedula DESC');
}
function obtener_cliente_por_cedula($cedula)
{
    global $conexion;
    $stmt = $conexion->prepare('SELECT * FROM socio WHERE cedula = ?');
    $stmt->bind_param('s', $cedula);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
function crear_cliente($datos)
{
    global $conexion;
    $stmt = $conexion->prepare('INSERT INTO socio (cedula, nombres, apellidos, direccion, telefono) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $datos['cedula'], $datos['nombres'], $datos['apellidos'], $datos['direccion'], $datos['telefono']);
    return $stmt->execute();
}
function actualizar_cliente($datos, $cedulaOriginal)
{
    global $conexion;
    $stmt = $conexion->prepare('UPDATE socio SET cedula = ?, nombres = ?, apellidos = ?, direccion = ?, telefono = ? WHERE cedula = ?');
    $stmt->bind_param('ssssss', $datos['cedula'], $datos['nombres'], $datos['apellidos'], $datos['direccion'], $datos['telefono'], $cedulaOriginal);
    return $stmt->execute();
}
function eliminar_cliente($cedula)
{
    global $conexion;
    $stmt = $conexion->prepare('DELETE FROM socio WHERE cedula = ?');
    $stmt->bind_param('s', $cedula);
    return $stmt->execute();
}
function opciones_clientes($campo)
{
    global $conexion;
    return $campo === 'socio_cedula' ? $conexion->query('SELECT cedula AS valor, CONCAT(nombres, " ", apellidos, " (", cedula, ")") AS etiqueta FROM socio ORDER BY nombres') : false;
}
