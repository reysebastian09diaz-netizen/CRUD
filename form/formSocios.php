<?php

session_start();

if (!isset($_SESSION['cedula'])) {
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Registrar socio</title>
</head>

<body>

    <main class="contenedor pagina-formulario">

        <a class="enlace-volver" href="../pag/socios.php">
            Volver a socios
        </a>

        <section class="tarjeta-formulario">

            <h1>Registrar socio</h1>

            <form action="../includes/socios/create.php" method="POST">

                <div class="campo">
                    <label>Cédula</label>
                    <input type="text" name="cedula" required>
                </div>

                <div class="campo">
                    <label>Nombres</label>
                    <input type="text" name="nombres" required>
                </div>

                <div class="campo">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" required>
                </div>

                <div class="campo">
                    <label>Dirección</label>
                    <input type="text" name="direccion" required>
                </div>

                <div class="campo">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" required>
                </div>

                <button class="boton" type="submit">
                    Registrar socio
                </button>

            </form>

        </section>

    </main>

</body>

</html>