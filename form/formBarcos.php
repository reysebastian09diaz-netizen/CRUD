<?php

session_start();

require_once "../includes/crud.php";

if (!isset($_SESSION['cedula'])) {
    header("Location: ../index.php");
    exit();
}

$socios = $conexion->query("SELECT cedula, nombres, apellidos FROM socio");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Registrar barco</title>
</head>

<body>

    <main class="contenedor pagina-formulario">

        <a class="enlace-volver" href="../pag/barcos.php">
            Volver a barcos
        </a>

        <section class="tarjeta-formulario">

            <h1>Registrar barco</h1>

            <form action="../includes/barcos/create.php" method="POST">

                <div class="campo">
                    <label>Matrícula</label>
                    <input type="text" name="matricula" required>
                </div>

                <div class="campo">
                    <label>Nombre</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="campo">
                    <label>Amarre</label>
                    <input type="text" name="amarre" required>
                </div>

                <div class="campo">
                    <label>Cuota de amarre</label>
                    <input type="number" name="cuota_amarre" step="0.01" required>
                </div>

                <div class="campo">

                    <label>Socio</label>

                    <select name="socio_cedula" required>

                        <option value="">Seleccione un socio</option>

                        <?php while ($socio = $socios->fetch_assoc()) { ?>

                            <option value="<?php echo $socio['cedula']; ?>">
                                <?php echo $socio['nombres'] . " " . $socio['apellidos']; ?>
                            </option>

                        <?php } ?>

                    </select>

                </div>

                <button class="boton" type="submit">
                    Registrar barco
                </button>

            </form>

        </section>

    </main>

</body>

</html>