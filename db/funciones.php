<?php

function obtener_usuarios()
{
    require "conexion.php";

    $sql = "SELECT * FROM usuario";
    $query = mysqli_query($conex, $sql);

    return $query;
}


function create_user()
{
    require "conexion.php";

    $errores = [];

    $nombre = "";
    $documento = "";
    $telefono = "";
    $email = "";
    $direccion = "";
    $contraseña = "";

    if (isset($_POST["agregar"])) {

        $nombre = $_POST["nombre"] ?? "";
        $documento = $_POST["documento"] ?? "";
        $telefono = $_POST["telefono"] ?? "";
        $email = $_POST["email"] ?? "";
        $direccion = $_POST["direccion"] ?? "";
        $contraseña = $_POST["contraseña"] ?? "";

        // VALIDACIONES

        if (!$nombre) {
            $errores[] = "Ingrese el nombre";
        }

        if (!$documento) {
            $errores[] = "Ingrese el documento";
        }

        if (!$telefono) {
            $errores[] = "Ingrese el teléfono";
        }

        if (!$email) {
            $errores[] = "Ingrese el correo";
        }

        if (!$direccion) {
            $errores[] = "Ingrese la dirección";
        }

        if (!$contraseña) {
            $errores[] = "Ingrese la contraseña";
        }


        // COMPROBAR SI YA EXISTE

        $query = "SELECT * FROM usuario WHERE documento = '$documento'";
        $resultado = mysqli_query($conex, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $errores[] = "El usuario ya existe";
        }


        // INSERTAR USUARIO

        if (empty($errores)) {

            $password_hash = password_hash($contraseña, PASSWORD_DEFAULT);

            $query = "INSERT INTO usuario
            (nombre, documento, telefono, email, direccion, contraseña)
            VALUES
            ('$nombre', '$documento', '$telefono', '$email', '$direccion', '$password_hash')";

            $insertar = mysqli_query($conex, $query);

            if ($insertar) {

                header("Location: index.php");
                exit;

            } else {

                $errores[] = "Error al insertar: " . mysqli_error($conex);
            }
        }
    }

    return $errores;
}


function iniciar_sesion()
{
    require "conexion.php";

    $errores_login = [];

    if (isset($_POST["login"])) {

        $email = $_POST["email_login"] ?? "";
        $contraseña = $_POST["contraseña_login"] ?? "";

        $query = "SELECT * FROM usuario WHERE email = '$email'";

        $resultado = mysqli_query($conex, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {

            $usuario = mysqli_fetch_assoc($resultado);

            if (password_verify($contraseña, $usuario["contraseña"])) {

                header("Location: /PAGINA-2/index.html");
                exit;

            } else {

                $errores_login[] = "Usuario o contraseña incorrectos";
            }

        } else {

            $errores_login[] = "Usuario o contraseña incorrectos";
        }
    }

    return $errores_login;
}