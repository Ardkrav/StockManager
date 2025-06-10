<?php

namespace StockManager\PHP\Model;

class Mueble
{
    private $id;
    private $nombre;
    private $peso;
    private $ancho;
    private $alto;
    private $largo;
    private $volumen;

    public function __construct(
        $id = null,
        $nombre = null,
        $peso = null,
        $ancho = null,
        $alto = null,
        $largo = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->peso = $peso;
        $this->ancho = $ancho;
        $this->alto = $alto;
        $this->largo = $largo;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getPeso()
    {
        return $this->peso;
    }
    public function getAncho()
    {
        return $this->ancho;
    }
    public function getLargo()
    {
        return $this->largo;
    }
    public function getAlto()
    {
        return $this->alto;
    }
    public function getVolumen()
    {
        return $this->volumen;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;
    }
    public function setLargo($largo)
    {
        $this->largo = $largo;
    }
    public function setAlto($alto)
    {
        $this->alto = $alto;
    }
    public function setVolumen()
    {
        $this->volumen = $this->alto * $this->ancho * $this->largo;
    }
}
