<?php

session_start();

require_once("db/funciones.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $contraseña = $_POST["contraseña"];

    $sql = "SELECT * FROM usuario WHERE email = ? AND contraseña = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $email, $contraseña);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {

        $usuario = $resultado->fetch_assoc();

        $_SESSION["cedula"] = $usuario["documento"];
        $_SESSION["nombre"] = $usuario["nombre"];

        header("Location: pag/users.php");
        exit();

    } else {

        $mensaje = "Usuario o contraseña incorrectos.";

    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>

<body>

    <h1>Login</h1>

    <?php if ($mensaje != "") { ?>
        <p><?php echo $mensaje; ?></p>
    <?php } ?>

    <form method="POST">

        <label>Correo:</label>
        <br>
        <input type="email" name="email" required>

        <br><br>

        <label>Contraseña:</label>
        <br>
        <input type="password" name="contraseña" required>

        <br><br>

        <button type="submit">Ingresar</button>

    </form>

    <br>

    <a href="form/formUsuarios.php">Registrar usuario</a>

</body>

</html>