<?php
session_start();
require_once(__DIR__ . '/../includes/users/funciones.php');

if (!isset($_SESSION['cedula'])) {
    header('Location: ../index.php');
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$usuario = $id ? obtener_usuario_por_id($id) : null;
if (!$usuario) {
    header('Location: users.php?error=no_encontrado');
    exit();
}

function e($valor) { return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Actualizar usuario</title>
</head>
<body>
<main class="contenedor pagina-formulario">
    <a class="enlace-volver" href="users.php">← Volver a usuarios</a>
    <section class="tarjeta-formulario">
        <h1>Actualizar usuario</h1>
        <?php if (isset($_GET['error'])): ?><p class="mensaje mensaje-error">No se pudieron guardar los cambios. Verifica el formulario.</p><?php endif; ?>
        <form action="../includes/users/update.php" method="POST" class="formulario-usuario">
            <input type="hidden" name="id_usuario" value="<?= e($usuario['id_usuario']) ?>">
            <div class="campo"><label for="nombre">Nombre</label><input id="nombre" type="text" name="nombre" value="<?= e($usuario['nombre']) ?>" required></div>
            <div class="campo"><label for="documento">Cédula</label><input id="documento" type="text" name="documento" value="<?= e($usuario['documento']) ?>" required></div>
            <div class="campo"><label for="telefono">Teléfono</label><input id="telefono" type="tel" name="telefono" value="<?= e($usuario['telefono']) ?>" required></div>
            <div class="campo"><label for="email">Correo electrónico</label><input id="email" type="email" name="email" value="<?= e($usuario['email']) ?>" required></div>
            <div class="campo"><label for="direccion">Dirección</label><input id="direccion" type="text" name="direccion" value="<?= e($usuario['direccion']) ?>"></div>
            <div class="campo"><label for="contrasena">Contraseña</label><input id="contrasena" type="password" name="contrasena" required></div>
            <div class="campo"><label for="confirmar_contrasena">Confirmar contraseña</label><input id="confirmar_contrasena" type="password" name="confirmar_contrasena" required></div>
            <button class="boton" type="submit">Guardar cambios</button>
        </form>
    </section>
</main>
</body>
</html>
