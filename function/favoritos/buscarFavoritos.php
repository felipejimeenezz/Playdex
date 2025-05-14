<?php

include_once(__DIR__ . "/../BDD/connection_BDD.php");


function buscarFavoritos($id) {

    $conexion = connect_bbdd();

    $consulta = "SELECT `id_juego` FROM `favoritos` WHERE `id_usuario` = '$id'";
    $resultado = mysqli_query($conexion, $consulta);
    
    $favoritos = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $favoritos[] = $fila;
    }
    
    return $favoritos;
}

?>