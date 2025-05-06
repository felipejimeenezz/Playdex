<?php

class Screenshot {

    private $id;
    private $url;
    private $id_juego;

    public function __construct($id, $url, $id_juego) {
        $this->id = $id;
        $this->url = $url;
        $this->id_juego = $id_juego;
    }

    public function getId() {
        return $this->id;
    }

    public function getUrlImg() {
        return $this->url;
    }

    public function getIdJuego() {
        return $this->id_juego;
    }
}
?>