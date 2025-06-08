<?php

namespace StockManager\PHP;

use StockManager\PHP\Model\Mueble;
use StockManager\PHP\MuebleMapper;

class ControladorMueble
{
    private $mueble;
    private $mapper;

    public function __construct()
    {
        $this->mapper = new MuebleMapper();
        $this->mueble = new Mueble();
    }

    public function crearMueble($nombre, $peso, $ancho, $alto, $largo)
    {
        $this->mueble->setNombre($nombre);
        $this->mueble->setPeso($peso);
        $this->mueble->setAncho($ancho);
        $this->mueble->setAlto($alto);
        $this->mueble->setLargo($largo);
        $this->mueble->setVolumen();

        $datos = [
            'nombre' => $this->mueble->getNombre(),
            'peso' => $this->mueble->getPeso(),
            'ancho' => $this->mueble->getAncho(),
            'alto' => $this->mueble->getAlto(),
            'largo' => $this->mueble->getLargo()
        ];

        $resultado = $this->mapper->crearMueble($datos);
        return $resultado;
    }

    public function listarMuebles()
    {
        $resultado = $this->mapper->listarMuebles();
        return $resultado;
    }

    public function obtenerMuebleId($id_mueble)
    {
        $resultado = $this->mapper->obtenerMuebleId($id_mueble);
        $this->mueble->setNombre($resultado["nombre"]);
        $this->mueble->setPeso($resultado["peso"]);
        $this->mueble->setAncho($resultado["ancho"]);
        $this->mueble->setAlto($resultado["alto"]);
        $this->mueble->setLargo($resultado["largo"]);
        $this->mueble->setVolumen();
        $resultado["volumen"] = $this->mueble->getVolumen();
        return $resultado;
    }

    public function actualizarMuebleId($id_mueble, $nombre, $peso, $ancho, $alto, $largo)
    {
        $this->mueble->setNombre($nombre);
        $this->mueble->setPeso($peso);
        $this->mueble->setAncho($ancho);
        $this->mueble->setAlto($alto);
        $this->mueble->setLargo($largo);
        $this->mueble->setVolumen();

        $datos = [
            'nombre' => $this->mueble->getNombre(),
            'peso' => $this->mueble->getPeso(),
            'ancho' => $this->mueble->getAncho(),
            'alto' => $this->mueble->getAlto(),
            'largo' => $this->mueble->getLargo()
        ];

        $resultado = $this->mapper->actualizarMuebleId($id_mueble, $datos);
        return $resultado;
    }

    public function eliminarMuebleId($id_mueble)
    {
        $resultado = $this->mapper->eliminarMuebleId($id_mueble);
        return $resultado;
    }
}
