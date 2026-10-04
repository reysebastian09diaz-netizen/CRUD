<?php

session_start();
require_once("funciones.php");

if (!isset($_SESSION['cedula']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

if (isset($_POST['id_usuario'])) {

    $id = $_POST['id_usuario'];

    if (eliminar_usuario($id)) {

        header('Location: ../../pag/users.php?mensaje=eliminado');
        exit();

    } else {

        header('Location: ../../pag/users.php?error=eliminar');
        exit();

    }

} else {

    echo "No se seleccionó ningún usuario";

}
?>
