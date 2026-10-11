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
    <title>Registrar cliente</title>
</head>

<body>

    <main class="contenedor pagina-formulario">

        <a class="enlace-volver" href="../pag/clientes.php">
            Volver a clientes
        </a>

        <section class="tarjeta-formulario">

            <h1>Registrar cliente</h1>

            <form action="../includes/clientes/create.php" method="POST">

                <div class="campo">
                    <label>Nombre</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="campo">
                    <label>Documento</label>
                    <input type="text" name="documento" required>
                </div>

                <div class="campo">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" required>
                </div>

                <div class="campo">
                    <label>Correo</label>
                    <input type="email" name="email" required>
                </div>

                <div class="campo">
                    <label>Dirección</label>
                    <input type="text" name="direccion" required>
                </div>

                <button class="boton" type="submit">
                    Registrar cliente
                </button>

            </form>

        </section>

    </main>

</body>

</html>