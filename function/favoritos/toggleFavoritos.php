<?php

include_once "../BDD/connection_BDD.php";
include_once "../login/loginFunction.php";

    session_start();

    if (!isset($_SESSION["login"]) || $_SESSION["login"] != true) {
        die("Debes iniciar sesión.");
    } else {
        $user = $_SESSION['nombre'];
        $pass = $_SESSION['contrasena'];

        $consulta = "SELECT * FROM `usuario` WHERE `nombre` = '$user' AND `contrasena` = '$pass'";
        $extraido = consultaUsuarios($consulta);
        $id_usuario = $extraido['id'];
    }

    $id_juego = $_POST['id_juego'] ?? null;
    $conexion = connect_bbdd();

    if (!$id_juego) {
        die("Juego no válido.");
    }

    $consulta = "SELECT * FROM `favoritos` WHERE `id_usuario` = '$id_usuario' AND `id_juego` = '$id_juego'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $eliminar = "DELETE FROM `favoritos` WHERE `id_usuario` = '$id_usuario' AND `id_juego` = '$id_juego'";
        mysqli_query($conexion, $eliminar);
    } else {
        $insertar = "INSERT INTO `favoritos` (`id_usuario`, `id_juego`) VALUES ('$id_usuario', '$id_juego')";
        mysqli_query($conexion, $insertar);
    }

    header("Location: ../../juegoinfo.php?id=$id_juego");
    exit();
?>