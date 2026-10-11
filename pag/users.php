<?php
session_start();
require_once(__DIR__ . '/../includes/users/funciones.php');
if (!isset($_SESSION['cedula'])) {
    header('Location: ../index.php');
    exit();
}
$usuarios = obtener_usuarios();
function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
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
    <header class="header">
        <div class="contenedor contenido-header">
            <h1>Proyecto de barcos</h1>
            <nav class="navegacion-principal"><a href="clientes.php">Clientes</a><a href="socios.php">Socios</a><a href="barcos.php">Barcos</a><a href="salidas.php">Salidas</a><span>Hola, <?= e($_SESSION['nombre']) ?></span><a href="cerrarSesion.php">
                    <svg class="icono-logout" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 12h-9.5m7.5 3 3-3-3-3m-5-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5a2 2 0 0 0 2-2v-1" />
                    </svg>
                </a></nav>
        </div>
    </header>
    <main class="contenedor pagina-usuarios">
        <div class="encabezado-pagina">
            <div>
                <h2>Usuarios</h2>
                <p>Administra los usuarios registrados.</p>
            </div><a class="boton" href="../form/formUsuarios.php">Nuevo usuario</a>
        </div>
        <?php if (isset($mensajes[$_GET['mensaje'] ?? ''])): ?><p class="mensaje mensaje-exito"><?= e($mensajes[$_GET['mensaje']]) ?></p><?php endif; ?>
        <?php if (isset($_GET['error'])): ?><p class="mensaje mensaje-error">No se pudo completar la operación.</p><?php endif; ?>
        <div class="tabla-contenedor">
            <table>
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($usuario = mysqli_fetch_assoc($usuarios)): ?><tr>
                            <td><?= e($usuario['documento']) ?></td>
                            <td><?= e($usuario['nombre']) ?></td>
                            <td><?= e($usuario['email']) ?></td>
                            <td><?= e($usuario['telefono']) ?></td>
                            <td class="acciones"><a href="actualizar.php?id=<?= e($usuario['id_usuario']) ?>">Editar</a><a class="accion-eliminar" href="eliminar.php?id=<?= e($usuario['id_usuario']) ?>">Eliminar</a></td>
                        </tr><?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>