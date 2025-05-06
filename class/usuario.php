<?php

class Usuario {

    private $id;
    private $nombre;
    private $email;
    private $contrasena;

    private $colecciones = [];

    public function __construct($id, $nombre, $email, $contrasena) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasena = $contrasena;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getContrasena() {
        return $this->contrasena;
    }
}

?>