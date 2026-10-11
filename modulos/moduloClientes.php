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
    header('Location: users.php');
    exit();
}
$registros = obtener_registros_modulo($config);
$mensajes = ['creado' => ucfirst($config['singular']) . ' registrado correctamente.', 'actualizado' => ucfirst($config['singular']) . ' actualizado correctamente.', 'eliminado' => ucfirst($config['singular']) . ' eliminado correctamente.'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title><?= e($config['titulo']) ?></title>
</head>

<body>
    <header class="header">
        <div class="contenedor contenido-header">
            <h1>Proyecto de barcos</h1>
            <nav class="navegacion-principal"><a href="users.php">Usuarios</a><a href="clientes.php">Clientes</a><a href="barcos.php">Barcos</a><a href="salidas.php">Salidas</a><a href="cerrarSesion.php"><svg class="icono-logout" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                   d="M20 12h-9.5m7.5 3 3-3-3-3m-5-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5a2 2 0 0 0 2-2v-1" />
           </svg></a></nav>
        </div>
    </header>
    <main class="contenedor pagina-usuarios">
        <div class="encabezado-pagina">
            <div>
                <h2><?= e($config['titulo']) ?></h2>
                <p>Administra los <?= strtolower(e($config['titulo'])) ?> registrados.</p>
            </div><a class="boton" href="../form/formClientes.php?tipo=<?= e($tipo) ?>">Nuevo <?= e($config['singular']) ?></a>
        </div>
        <?php if (isset($mensajes[$_GET['mensaje'] ?? ''])): ?><p class="mensaje mensaje-exito"><?= e($mensajes[$_GET['mensaje']]) ?></p><?php endif; ?>
        <?php if (isset($_GET['error'])): ?><p class="mensaje mensaje-error">No se pudo completar la operacion.</p><?php endif; ?>
        <div class="tabla-contenedor">
            <table>
                <thead>
                    <tr><?php foreach ($config['campos'] as $campo => $def): ?><th><?= e($def[0]) ?></th><?php endforeach; ?><th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($registro = $registros->fetch_assoc()): ?><tr><?php foreach ($config['campos'] as $campo => $def): ?><td><?= e($registro[$campo]) ?></td><?php endforeach; ?><td class="acciones"><a href="actualizarModulo.php?tipo=<?= e($tipo) ?>&id=<?= urlencode($registro[$config['clave']]) ?>">Editar</a><a class="accion-eliminar" href="eliminarModulo.php?tipo=<?= e($tipo) ?>&id=<?= urlencode($registro[$config['clave']]) ?>">Eliminar</a></td>
                        </tr><?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>