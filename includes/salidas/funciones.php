<?php
require_once __DIR__ . '/../../db/conexion.php';
function obtener_salidas() { global $conexion; return $conexion->query('SELECT * FROM salidas ORDER BY IdSalida DESC'); }
function obtener_salida_por_id($id) { global $conexion; $stmt = $conexion->prepare('SELECT * FROM salidas WHERE IdSalida = ?'); $stmt->bind_param('s', $id); $stmt->execute(); return $stmt->get_result()->fetch_assoc(); }
function crear_salida($datos) { global $conexion; $stmt = $conexion->prepare('INSERT INTO salidas (Fecha, Hora, Destino, Barcos_Matricula) VALUES (?, ?, ?, ?)'); $stmt->bind_param('ssss', $datos['Fecha'], $datos['Hora'], $datos['Destino'], $datos['Barcos_Matricula']); return $stmt->execute(); }
function actualizar_salida($datos, $idOriginal) { global $conexion; $stmt = $conexion->prepare('UPDATE salidas SET Fecha = ?, Hora = ?, Destino = ?, Barcos_Matricula = ? WHERE IdSalida = ?'); $stmt->bind_param('sssss', $datos['Fecha'], $datos['Hora'], $datos['Destino'], $datos['Barcos_Matricula'], $idOriginal); return $stmt->execute(); }
function eliminar_salida($id) { global $conexion; $stmt = $conexion->prepare('DELETE FROM salidas WHERE IdSalida = ?'); $stmt->bind_param('s', $id); return $stmt->execute(); }
function opciones_salidas($campo) { return false; }
