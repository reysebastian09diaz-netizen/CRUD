<?php
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!isset($_SESSION['cedula']) || !$id) {
    header('Location: users.php?error=no_encontrado');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Eliminar usuario</title>
</head>
<body>
<main class="contenedor pagina-formulario"><section class="tarjeta-formulario">
    <h1>Eliminar usuario</h1>
    <p>¿Está seguro de que desea eliminar este usuario?</p>
    <form action="../includes/users/delete.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8') ?>">
        <button class="boton" type="submit">Eliminar usuario</button>
    </form>
    <br><a class="enlace-volver" href="users.php">Cancelar</a>
</section></main>
</body>
</html>
