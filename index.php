<?php
session_start();
require_once(__DIR__ . '/db/conexion.php');

if (isset($_SESSION['cedula'])) {
    header('Location: pag/users.php');
    exit();
}

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $sql = 'SELECT id_usuario, nombre FROM usuario WHERE email = ? AND contraseña = ?';
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ss', $email, $contrasena);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
        $_SESSION['cedula'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        header('Location: pag/users.php');
        exit();
    }
    $mensaje = 'Correo o contraseña incorrectos.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Iniciar sesión</title>
</head>
<body class="pagina-login">
<main class="login-container">
    <section class="login-card">
        <h1>Biblioteca</h1>
        <h2>Iniciar sesión</h2>
        <?php if ($mensaje): ?><p class="mensaje mensaje-error"><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <form method="POST">
            <div class="campo"><label for="email">Correo electrónico</label><input id="email" type="email" name="email" required></div>
            <div class="campo"><label for="contrasena">Contraseña</label><input id="contrasena" type="password" name="contrasena" required></div>
            <button class="btn-submit" type="submit">Ingresar</button>
        </form>
    </section>
</main>
</body>
</html>
