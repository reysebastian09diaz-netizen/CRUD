<?php
session_start();
if (!isset($_SESSION['cedula'])) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Registrar usuario</title>
</head>
<body>
<main class="contenedor pagina-formulario">
    <a class="enlace-volver" href="../pag/users.php">← Volver a usuarios</a>
    <section class="tarjeta-formulario">
        <h1>Registrar usuario</h1>
        <?php if (isset($_GET['error'])): ?>
            <p class="mensaje mensaje-error">Revisa los datos y confirma que las contraseñas coincidan.</p>
        <?php endif; ?>
        <form action="../includes/users/create.php" method="POST" class="formulario-usuario">
            <div class="campo"><label for="nombre">Nombre</label><input id="nombre" type="text" name="nombre" required></div>
            <div class="campo"><label for="documento">Cédula</label><input id="documento" type="text" name="documento" required></div>
            <div class="campo"><label for="telefono">Teléfono</label><input id="telefono" type="tel" name="telefono" required></div>
            <div class="campo"><label for="email">Correo electrónico</label><input id="email" type="email" name="email" required></div>
            <div class="campo"><label for="direccion">Dirección</label><input id="direccion" type="text" name="direccion"></div>
            <div class="campo"><label for="contrasena">Contraseña</label><input id="contrasena" type="password" name="contrasena" required></div>
            <div class="campo"><label for="confirmar_contrasena">Confirmar contraseña</label><input id="confirmar_contrasena" type="password" name="confirmar_contrasena" required></div>
            <button class="boton" type="submit">Registrar usuario</button>
        </form>
    </section>
</main>
</body>
</html>
