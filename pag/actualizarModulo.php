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
$registro = $config && $id !== '' ? obtener_registro_modulo($config, $id) : null;
if (!$registro) {
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
    <title>Actualizar <?= e($config['singular']) ?></title>
</head>

<body>
    <main class="contenedor pagina-formulario"><a class="enlace-volver" href="<?= e($tipo) ?>.php">Volver a <?= e($config['titulo']) ?></a>
        <section class="tarjeta-formulario">
            <h1>Actualizar <?= e($config['singular']) ?></h1>
            <form action="../includes/<?= e($tipo) ?>/update.php" method="POST" class="formulario-usuario"><input type="hidden" name="id_original" value="<?= e($id) ?>"><?php foreach ($config['campos'] as $campo => $def): ?><div class="campo"><label for="<?= e($campo) ?>"><?= e($def[0]) ?></label><?php if ($def[1] === 'select'): ?><select id="<?= e($campo) ?>" name="<?= e($campo) ?>" required><?php $opciones = opciones_campo_modulo($campo);
                                                                                                                                                                                                                                                                                                                                                                                                                                                            while ($opcion = $opciones->fetch_assoc()): ?><option value="<?= e($opcion['valor']) ?>" <?= $registro[$campo] === $opcion['valor'] ? 'selected' : '' ?>><?= e($opcion['etiqueta']) ?></option><?php endwhile; ?></select><?php else: ?><input id="<?= e($campo) ?>" type="<?= e($def[1]) ?>" name="<?= e($campo) ?>" value="<?= e($registro[$campo]) ?>" <?= $def[1] === 'number' ? 'step="0.01" min="0"' : '' ?> required><?php endif; ?></div><?php endforeach; ?><button class="boton" type="submit">Guardar cambios</button></form>
        </section>
    </main>
</body>

</html>
