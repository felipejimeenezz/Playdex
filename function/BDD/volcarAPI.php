<?php

include_once 'connection_BDD.php';

//Conexion a la base de datos
$conexion = connect_bbdd();

//Clave de la cuenta de RAWG para acceder a la API
$api_key = '44f61c52003242e081296056cce5bd3a';

//Petición a la API de RAWG para obtener los 100 juegos
$api_url = "https://api.rawg.io/api/games?key=$api_key&page_size=40&page=2";
$response = file_get_contents($api_url);
$data = json_decode($response, true);

//Insertar los juegos en la base de datos
foreach ($data['results'] as $juego) {

    // Obtener los valores directamente de la API
    $nombre = mysqli_real_escape_string($conexion, $juego['name']);
    $fecha_lanzamiento = mysqli_real_escape_string($conexion, $juego['released']);
    $url_imagen = mysqli_real_escape_string($conexion, $juego['background_image']);
    $rating = mysqli_real_escape_string($conexion, $juego['rating']);

    //Obtener descripción del juego haciendo petición por ID del juego
    $slug = $juego['slug'];
    $detalles_url = "https://api.rawg.io/api/games/$slug?key=$api_key";
    $detalles_json = file_get_contents($detalles_url);
    $detalles = json_decode($detalles_json, true);
    $descripcion = mysqli_real_escape_string($conexion, $detalles['description_raw']);

    //Insertar el juego en la tabla juego con sus atributos
    $query_juego = "INSERT INTO juego (nombre, fecha_lanzamiento, url_img, rating, descripcion) 
                    VALUES ('$nombre', '$fecha_lanzamiento', '$url_imagen', '$rating', '$descripcion')";
    if ($conexion->query($query_juego) === TRUE) {
        //Obtener ID del juego insertado
        $id_juego = $conexion->insert_id;

        //Insertar los géneros en la tabla genero
        foreach ($juego['genres'] as $genero) {
            $nombre_genero = mysqli_real_escape_string($conexion, $genero['name']);
            
            //Comprobar si el género ya existe
            $check_genero = $conexion->query("SELECT id FROM genero WHERE nombre = '$nombre_genero'");
            if ($check_genero->num_rows == 0) {
                //Insertar el género si no existe
                $query_genero = "INSERT INTO genero (nombre) VALUES ('$nombre_genero')";
                $conexion->query($query_genero);
                $id_genero = $conexion->insert_id;
            } else {
                //Obtener el ID del género existente
                $row = $check_genero->fetch_assoc();
                $id_genero = $row['id'];
            }

            //Insertar la relación entre juego y género en la tabla juego_genero
            $conexion->query("INSERT INTO juego_genero (id_juego, id_genero) VALUES ($id_juego, $id_genero)");
        }

        //Insertar las plataformas en la tabla plataforma
        foreach ($juego['platforms'] as $plataforma) {
            $nombre_plataforma = mysqli_real_escape_string($conexion, $plataforma['platform']['name']);
            
            //Comprobar si la plataforma ya existe
            $check_plataforma = $conexion->query("SELECT id FROM plataforma WHERE nombre = '$nombre_plataforma'");
            if ($check_plataforma->num_rows == 0) {
                //Insertar la plataforma si no existe
                $query_plataforma = "INSERT INTO plataforma (nombre) VALUES ('$nombre_plataforma')";
                $conexion->query($query_plataforma);
                $id_plataforma = $conexion->insert_id;
            } else {
                //Obtener el ID de la plataforma existente
                $row = $check_plataforma->fetch_assoc();
                $id_plataforma = $row['id'];
            }

            //Insertar la relación entre juego y plataforma en la tabla juego_plataforma
            $conexion->query("INSERT INTO juego_plataforma (id_juego, id_plataforma) VALUES ($id_juego, $id_plataforma)");
        }

        //Insertar las screenshots en la tabla screenshot
        foreach ($juego['short_screenshots'] as $screenshot) {
            $img_screenshot = mysqli_real_escape_string($conexion, $screenshot['image']);
            
            //Insertar la screenshot en la tabla screenshot
            $query_screenshot = "INSERT INTO screenshot (`url`, `id_juego`) VALUES ('$img_screenshot', $id_juego)";
            $conexion->query($query_screenshot);
        }
    }
}

$conexion->close();

echo "Datos volcados con exito";

?>
