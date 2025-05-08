<?php

include_once 'BDD/connection_BDD.php';

function mostrarJuegos ($id) {
    $conexion = connect_bbdd();

    $resultado = mysqli_query($conexion, "SELECT * FROM `juego` WHERE id = $id");

    mysqli_data_seek($resultado, 0);

    $extraido = mysqli_fetch_array($resultado);

    mysqli_close($conexion);

    return $extraido;
}
?>