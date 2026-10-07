<?php
require_once __DIR__ . '/../../db/conexion.php';
function obtener_barcos()
{
    global $conexion;
    return $conexion->query('SELECT * FROM barco ORDER BY matricula DESC');
}
function obtener_barco_por_matricula($matricula)
{
    global $conexion;
    $stmt = $conexion->prepare('SELECT * FROM barco WHERE matricula = ?');
    $stmt->bind_param('s', $matricula);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
function crear_barco($datos)
{
    global $conexion;
    $stmt = $conexion->prepare('INSERT INTO barco (matricula, nombre, amarre, cuota_amarre, socio_cedula) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssds', $datos['matricula'], $datos['nombre'], $datos['amarre'], $datos['cuota_amarre'], $datos['socio_cedula']);
    return $stmt->execute();
}
function actualizar_barco($datos, $matriculaOriginal)
{
    global $conexion;
    $stmt = $conexion->prepare('UPDATE barco SET matricula = ?, nombre = ?, amarre = ?, cuota_amarre = ?, socio_cedula = ? WHERE matricula = ?');
    $stmt->bind_param('sssdss', $datos['matricula'], $datos['nombre'], $datos['amarre'], $datos['cuota_amarre'], $datos['socio_cedula'], $matriculaOriginal);
    return $stmt->execute();
}
function eliminar_barco($matricula)
{
    global $conexion;
    $stmt = $conexion->prepare('DELETE FROM barco WHERE matricula = ?');
    $stmt->bind_param('s', $matricula);
    return $stmt->execute();
}
function opciones_barcos($campo)
{
    global $conexion;
    return $campo === 'Barcos_Matricula' ? $conexion->query('SELECT matricula AS valor, CONCAT(nombre, " (", matricula, ")") AS etiqueta FROM barco ORDER BY nombre') : false;
}
