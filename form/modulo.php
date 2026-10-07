<?php
session_start();
require_once __DIR__ . '/../includes/crud.php';
if (!isset($_SESSION['cedula'])) {
    header('Location: ../index.php');
    exit();
}
$tipo = $_GET['tipo'] ?? '';
$config = configuracion_modulo($tipo);
if (!$config) {
    header('Location: ../pag/users.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Registrar <?= e($config['singular']) ?></title>
</head>

<body>
    <main class="contenedor pagina-formulario"><a class="enlace-volver" href="../pag/<?= e($tipo) ?>.php">Volver a <?= e($config['titulo']) ?></a>
        <section class="tarjeta-formulario">
            <h1>Registrar <?= e($config['singular']) ?></h1><?php if (isset($_GET['error'])): ?><p class="mensaje mensaje-error">Revisa los datos ingresados.</p><?php endif; ?><form action="../includes/<?= e($tipo) ?>/create.php" method="POST" class="formulario-usuario"><?php foreach ($config['campos'] as $campo => $def): ?><div class="campo"><label for="<?= e($campo) ?>"><?= e($def[0]) ?></label><?php if ($def[1] === 'select'): ?><select id="<?= e($campo) ?>" name="<?= e($campo) ?>" required>
                                <option value="">Seleccione una opcion</option><?php $opciones = opciones_campo_modulo($campo);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    while ($opcion = $opciones->fetch_assoc()): ?><option value="<?= e($opcion['valor']) ?>"><?= e($opcion['etiqueta']) ?></option><?php endwhile; ?>
                            </select><?php else: ?><input id="<?= e($campo) ?>" type="<?= e($def[1]) ?>" name="<?= e($campo) ?>" <?= $def[1] === 'number' ? 'step="0.01" min="0"' : '' ?> required><?php endif; ?></div><?php endforeach; ?><button class="boton" type="submit">Registrar <?= e($config['singular']) ?></button></form>
        </section>
    </main>
</body>

</html>
