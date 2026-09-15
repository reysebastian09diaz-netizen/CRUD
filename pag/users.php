<?php

session_start();

require_once("../db/funciones.php");

if (!isset($_SESSION["cedula"])) {
    header("Location: ../index.php");
    exit();
}

$usuarios = obtener_usuarios();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Usuarios Registrados</title>

</head>

<body>

    <h1>Usuarios</h1>

    <a href="../form/formUsuarios.php">Nuevo Usuario</a>

    <br><br>

    <table>

        <tr>

            <th>Cédula</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Opciones</th>

        </tr>

        <?php foreach ($usuarios as $usuario) { ?>

            <tr>

                <td>
                    <?php echo $usuario["documento"]; ?>
                </td>

                <td>
                    <?php echo $usuario["nombre"]; ?>
                </td>

                <td>
                    <?php echo $usuario["email"]; ?>
                </td>

                <td>
                    <?php echo $usuario["telefono"]; ?>
                </td>

                <td>

                    <a href="actualizar.php?id=<?php echo $usuario['id_usuario']; ?>">
                        Actualizar
                    </a>

                    &nbsp;

                    <a href="eliminar.php?id=<?php echo $usuario['id_usuario']; ?>">
                        Eliminar
                    </a>

                </td>

            </tr>

        <?php } ?>

    </table>

    <br>

    <a href="cerrarSesion.php">Cerrar sesión</a>

</body>

</html>