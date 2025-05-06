<?php

class Coleccion {

    private $id;
    private $nombre;
    private $id_usuario;

    private $juegos = [];

    public function __construct($id, $nombre, $id_usuario) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->id_usuario = $id_usuario;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

}

?>