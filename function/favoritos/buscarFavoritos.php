<?php

include_once(__DIR__ . "/../BDD/connection_BDD.php");

// Función para buscar los juegos favoritos de un usuario
function buscarFavoritos($id) {

    $conexion = connect_bbdd();

    $consulta = "SELECT `id_juego` FROM `favoritos` WHERE `id_usuario` = '$id'";
    $resultado = mysqli_query($conexion, $consulta);
    
    // Array para almacenar los IDs de los juegos favoritos
    $favoritos = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $favoritos[] = $fila;
    }
    
    return $favoritos;
}

?>