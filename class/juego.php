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

    // Añadir generos, plataformas y screenshots
    public function addGenero(Genero $g) {
        $this->generos[] = $g;
    }

    public function addPlataforma(Plataforma $p) {
        $this->plataformas[] = $p;
    }

    public function addScreenshot(Screenshot $s) {
        $this->screenshots[] = $s;
    }

}

?>