<?php

include_once "class/juego.php";
include_once "class/screenshot.php";
include_once "class/genero.php";
include_once "class/plataforma.php";
include_once "function/BDD/connection_BDD.php";

class Juego {

    private $id;
    private $nombre;
    private $fecha_lanzamiento;
    private $url_img;
    private $rating;
    private $descripcion;

    private $generos = [];
    private $plataformas = [];
    private $screenshots = [];

    public function __construct($id, $nombre, $fecha_lanzamiento, $url_img, $rating, $descripcion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fecha_lanzamiento = $fecha_lanzamiento;
        $this->url_img = $url_img;
        $this->rating = $rating;
        $this->descripcion = $descripcion;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getFechaLanzamiento() {
        return $this->fecha_lanzamiento;
    }

    public function getUrlImg() {
        return $this->url_img;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getGeneros() {
        return $this->generos;
    }

    public function getPlataformas() {
        return $this->plataformas;
    }

    public function getScreenshots() {
        return $this->screenshots;
    }

    public function addGenero(Genero $g) {
        $this->generos[] = $g;
    }

    public function addPlataforma(Plataforma $p) {
        $this->plataformas[] = $p;
    }

    public function addScreenshot(Screenshot $s) {
        $this->screenshots[] = $s;
    }

    public function imprimirJuego($juego) {
        echo "Id:".$juego->getId()."<br>";

        echo "Nombre:".$juego->getNombre()."<br>";

        echo "Fecha de lanzamiento:".$juego->getFechaLanzamiento()."<br>";

        echo "<img src='".$juego->getUrlImg()."'><br>";

        echo "Rating".$juego->getRating()."<br>";

        echo "Generos:";
        foreach ($juego->getGeneros() as $genero) {
            echo $genero->getNombre().", ";
        };

        echo "<br>Plataformas:";
        foreach ($juego->getPlataformas() as $plataforma) {
            echo $plataforma->getNombre().", ";
        };

        echo "<br>Screenshots:";
        foreach ($juego->getScreenshots() as $screenshot) {
            echo "<img src='".$screenshot->getUrlImg()."'>";
        };

        echo "<br>Descripcion".$juego->getDescripcion()."<br>";
    }

    public function mostrarJuegos () {
    $conexion = connect_bbdd();

    $juegos = mysqli_query($conexion, "SELECT * FROM `juego`");

    foreach ($juegos as $juego) {

        $id = $juego['id'];
        $nombre = $juego['nombre'];
        $fecha_lanzamiento = $juego['fecha_lanzamiento'];
        $url_img = $juego['url_img'];
        $rating = $juego['rating'];
        $descripcion = $juego['descripcion'];

        $juego = new Juego($id, $nombre, $fecha_lanzamiento, $url_img, $rating, $descripcion);

        //Generos
        $generos = mysqli_query($conexion,
        "SELECT g.id, g.nombre
        FROM genero g
        JOIN juego_genero jg ON g.id = jg.id_genero
        WHERE jg.id_juego = $id"
        );

        while ($g = mysqli_fetch_assoc($generos)) {
            $juego->addGenero(new Genero($g['id'], $g['nombre']));
        }

        //Plataformas
        $plataformas = mysqli_query($conexion,
        "SELECT p.id, p.nombre
        FROM plataforma p
        JOIN juego_plataforma jp ON p.id = jp.id_plataforma
        WHERE jp.id_juego = $id"
        );

        while ($p = mysqli_fetch_assoc($plataformas)) {
            $juego->addPlataforma(new Plataforma($p['id'], $p['nombre']));
        }

        //Screenshots
        $screenshot = mysqli_query($conexion,
        "SELECT id, url
        FROM screenshot
        WHERE id_juego = $id"
        );

        while ($s = mysqli_fetch_assoc($screenshot)) {
            $juego->addScreenshot(new Screenshot($s['id'], $s['url'], $id));
        }

        $juego->imprimirJuego($juego);

}
    }

}

?>