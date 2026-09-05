<?php

require "./db/funciones.php";

$login = iniciar_sesion();

$adduser = create_user();

$usuarios = obtener_usuarios();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CRUD Biblioteca</title>

</head>

<body>


    <!-- LOGIN -->

    <h1>Iniciar sesión</h1>

    <?php

    if (!empty($login)) {

        foreach ($login as $error) {

            echo "<p>$error</p>";

        }

    }

    ?>

    <form action="index.php" method="POST">

        <label for="email_login">Correo:</label>

        <input
            type="email"
            name="email_login"
            id="email_login"
            required
        >

        <br><br>


        <label for="contraseña_login">Contraseña:</label>

        <input
            type="password"
            name="contraseña_login"
            id="contraseña_login"
            required
        >

        <br><br>


        <input
            type="submit"
            name="login"
            value="Iniciar sesión"
        >

    </form>


    <hr>


    <!-- REGISTRO -->

    <h1>Registrar usuario</h1>

    <?php

    if (!empty($adduser)) {

        foreach ($adduser as $error) {

            echo "<p>$error</p>";

        }

    }

    ?>

    <form action="index.php" method="POST">

        <label for="nombre">Nombre:</label>

        <input
            type="text"
            name="nombre"
            id="nombre"
            required
        >

        <br><br>


        <label for="documento">Documento:</label>

        <input
            type="text"
            name="documento"
            id="documento"
            required
        >

        <br><br>


        <label for="telefono">Teléfono:</label>

        <input
            type="text"
            name="telefono"
            id="telefono"
            required
        >

        <br><br>


        <label for="email">Correo:</label>

        <input
            type="email"
            name="email"
            id="email"
            required
        >

        <br><br>


        <label for="direccion">Dirección:</label>

        <input
            type="text"
            name="direccion"
            id="direccion"
            required
        >

        <br><br>


        <label for="contraseña">Contraseña:</label>

        <input
            type="password"
            name="contraseña"
            id="contraseña"
            required
        >

        <br><br>


        <input
            type="submit"
            name="agregar"
            value="Registrar usuario"
        >

    </form>


    <hr>


    <!-- LISTA DE USUARIOS -->

    <h1>Usuarios registrados</h1>

    <table border="1">

        <tr>

            <th>ID</th>

            <th>Nombre</th>

            <th>Documento</th>

            <th>Teléfono</th>

            <th>Email</th>

            <th>Dirección</th>

        </tr>


        <?php

        if ($usuarios) {

            while ($usuario = mysqli_fetch_assoc($usuarios)) {

        ?>

                <tr>

                    <td>
                        <?php echo $usuario["id_usuario"]; ?>
                    </td>

                    <td>
                        <?php echo $usuario["nombre"]; ?>
                    </td>

                    <td>
                        <?php echo $usuario["documento"]; ?>
                    </td>

                    <td>
                        <?php echo $usuario["telefono"]; ?>
                    </td>

                    <td>
                        <?php echo $usuario["email"]; ?>
                    </td>

                    <td>
                        <?php echo $usuario["direccion"]; ?>
                    </td>

                </tr>

        <?php

            }

        }

        ?>

    </table>

</body>

</html>