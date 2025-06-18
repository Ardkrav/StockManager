<?php

namespace StockManager\Controller;

use StockManager\Model\Mueble;
use StockManager\Connection\MuebleMapper;

class ControladorMueble
{
    private $mueble;
    private $mapper;

    public function __construct(?MuebleMapper $mapper = null)
    {
        $this->mapper = $mapper ?? new MuebleMapper();
        $this->mueble = new Mueble();
    }

    public function crearMueble($arrayAsociativo)
    {
        if (
            empty($arrayAsociativo['nombre']) || !is_numeric($arrayAsociativo['peso']) ||
            !is_numeric($arrayAsociativo['ancho']) || !is_numeric($arrayAsociativo['alto']) ||
            !is_numeric($arrayAsociativo['largo'])
        ) {
            throw new \InvalidArgumentException(
                "Datos invalidos. No pueden haber campos vacios. Peso, ancho, alto y largo deben ser double."
            );
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
        $muebles = [];
        foreach ($resultado as $value) {
            $muebleCargar = new Mueble(
                $value["id_mueble"],
                $value["nombre"],
                $value["peso"],
                $value["ancho"],
                $value["alto"],
                $value["largo"]
            );
            $muebleCargar->setVolumen();
            $muebles[] = $muebleCargar;
        }
        return $muebles;
    }

    public function obtenerMuebleId($id_mueble)
    {
        $resultado = $this->mapper->obtenerMuebleId($id_mueble);
        if($resultado === false)
        {
            throw new \RunTimeException("No se encontro un mueble con la ID especificada.");
        }
        $this->mueble->setNombre($resultado["nombre"]);
        $this->mueble->setPeso($resultado["peso"]);
        $this->mueble->setAncho($resultado["ancho"]);
        $this->mueble->setAlto($resultado["alto"]);
        $this->mueble->setLargo($resultado["largo"]);
        return $this->mueble;
    }

    public function actualizarMuebleId($arrayAsociativo)
    {
        if (
            empty($arrayAsociativo['nombre']) || !is_numeric($arrayAsociativo['peso']) ||
            !is_numeric($arrayAsociativo['ancho']) || !is_numeric($arrayAsociativo['alto']) ||
            !is_numeric($arrayAsociativo['largo']) || (!is_numeric($arrayAsociativo['id_mueble']) || is_float((Float) $arrayAsociativo['id_mueble']) )
        ) {
            throw new \InvalidArgumentException(
                "Datos invalidos. No pueden haber campos vacios. Peso, ancho, alto y largo deben ser double. ID debe ser int."
            );
        }
        $this->mueble->setId($arrayAsociativo["id_mueble"]);
        $this->mueble->setNombre($arrayAsociativo['nombre']);
        $this->mueble->setPeso($arrayAsociativo['peso']);
        $this->mueble->setAncho($arrayAsociativo['ancho']);
        $this->mueble->setAlto($arrayAsociativo['alto']);
        $this->mueble->setLargo($arrayAsociativo['largo']);


        $resultado = $this->mapper->actualizarMuebleId($this->mueble);
        return $resultado;
    }

    public function eliminarMuebleId($id_mueble)
    {
        $resultado = $this->mapper->eliminarMuebleId($id_mueble);
        return $resultado;
    }
}
