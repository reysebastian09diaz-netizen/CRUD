<?php
session_start();
require_once(__DIR__ . '/../includes/users/funciones.php');
if (!isset($_SESSION['cedula'])) { header('Location: ../index.php'); exit(); }
$usuarios = obtener_usuarios();
function e($valor) { return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8'); }
$mensajes = ['creado' => 'Usuario registrado correctamente.', 'actualizado' => 'Usuario actualizado correctamente.', 'eliminado' => 'Usuario eliminado correctamente.'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Usuarios registrados</title>
</head>
<body>
<header class="header"><div class="contenedor contenido-header"><h1>Biblioteca</h1><nav class="navegacion-principal"><span>Hola, <?= e($_SESSION['nombre']) ?></span><a href="cerrarSesion.php">Cerrar sesión</a></nav></div></header>
<main class="contenedor pagina-usuarios">
    <div class="encabezado-pagina"><div><h2>Usuarios</h2><p>Administra los usuarios registrados.</p></div><a class="boton" href="../form/formUsuarios.php">Nuevo usuario</a></div>
    <?php if (isset($mensajes[$_GET['mensaje'] ?? ''])): ?><p class="mensaje mensaje-exito"><?= e($mensajes[$_GET['mensaje']]) ?></p><?php endif; ?>
    <?php if (isset($_GET['error'])): ?><p class="mensaje mensaje-error">No se pudo completar la operación.</p><?php endif; ?>
    <div class="tabla-contenedor"><table><thead><tr><th>Cédula</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Acciones</th></tr></thead><tbody>
    <?php while ($usuario = mysqli_fetch_assoc($usuarios)): ?><tr><td><?= e($usuario['documento']) ?></td><td><?= e($usuario['nombre']) ?></td><td><?= e($usuario['email']) ?></td><td><?= e($usuario['telefono']) ?></td><td class="acciones"><a href="actualizar.php?id=<?= e($usuario['id_usuario']) ?>">Editar</a><a class="accion-eliminar" href="eliminar.php?id=<?= e($usuario['id_usuario']) ?>">Eliminar</a></td></tr><?php endwhile; ?>
    </tbody></table></div>
</main>
</body>
</html>
