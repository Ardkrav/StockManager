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

    public function crearMueble($arrayAsociativo)
    {
        if (!isset($arrayAsociativo['nombre']) || !isset($arrayAsociativo['peso']) ||
            !isset($arrayAsociativo['ancho']) || !isset($arrayAsociativo['alto']) ||
            !isset($arrayAsociativo['largo'])) {
            throw new \InvalidArgumentException("Faltan datos para crear el mueble.");
        }
        $this->mueble->setNombre($arrayAsociativo['nombre']);
        $this->mueble->setPeso($arrayAsociativo['peso']);
        $this->mueble->setAncho($arrayAsociativo['ancho']);
        $this->mueble->setAlto($arrayAsociativo['alto']);
        $this->mueble->setLargo($arrayAsociativo['largo']);

        $resultado = $this->mapper->crearMueble($this->mueble);
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
        return $this->mueble;
    }

    public function actualizarMuebleId($arrayAsociativo)
    {
        if (!isset($arrayAsociativo['nombre']) || !isset($arrayAsociativo['peso']) ||
            !isset($arrayAsociativo['ancho']) || !isset($arrayAsociativo['alto']) ||
            !isset($arrayAsociativo['largo']) || !isset($arrayAsociativo['id_mueble'])) {
            throw new \InvalidArgumentException("Faltan datos para actualizar el mueble.");
        }
        $this->mueble->setNombre($arrayAsociativo['nombre']);
        $this->mueble->setPeso($arrayAsociativo['peso']);
        $this->mueble->setAncho($arrayAsociativo['ancho']);
        $this->mueble->setAlto($arrayAsociativo['alto']);
        $this->mueble->setLargo($arrayAsociativo['largo']);


        $resultado = $this->mapper->actualizarMuebleId($arrayAsociativo["id_mueble"], $this->mueble);
        return $resultado;
    }

    public function eliminarMuebleId($id_mueble)
    {
        $resultado = $this->mapper->eliminarMuebleId($id_mueble);
        return $resultado;
    }
}
