<?php
session_start();
require_once __DIR__ . '/../includes/crud.php';
if (!isset($_SESSION['cedula'])) {
    header('Location: ../index.php');
    exit();
}
$tipo = $_GET['tipo'] ?? '';
$config = configuracion_modulo($tipo);
$id = $_GET['id'] ?? '';
if (!$config || $id === '') {
    header('Location: users.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Eliminar <?= e($config['singular']) ?></title>
</head>

<body>
    <main class="contenedor pagina-formulario">
        <section class="tarjeta-formulario">
            <h1>Eliminar <?= e($config['singular']) ?></h1>
            <p>Esta seguro de que desea eliminar este registro?</p>
            <form action="../includes/<?= e($tipo) ?>/delete.php" method="POST"><input type="hidden" name="id" value="<?= e($id) ?>"><button class="boton" type="submit">Eliminar</button></form><br><a class="enlace-volver" href="<?= e($tipo) ?>.php">Cancelar</a>
        </section>
    </main>
</body>

</html>
