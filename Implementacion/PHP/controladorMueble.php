<?php

namespace StockManager\PHP;

use StockManager\PHP\Model\Mueble;
use StockManager\PHP\BDConexion;

class ControladorMueble
{
    private $conexion;
    private $mueble;

    public function __construct()
    {
        $this->conexion = BDConexion::getInstancia();
        $this->mueble = new Mueble($this->conexion);
    }

    public function crearMueble($nombre, $peso, $ancho, $alto, $largo)
    {
        $this->mueble->setNombre($nombre);
        $this->mueble->setPeso($peso);
        $this->mueble->setAncho($ancho);
        $this->mueble->setAlto($alto);
        $this->mueble->setLargo($largo);
        $this->mueble->setVolumen();
        $resultado = $this->mueble->crearMueble();
        return $resultado;
    }

    public function listarMuebles()
    {
        $resultado = $this->mueble->listarMuebles();
        return $resultado;
    }

    public function obtenerMuebleId($id_mueble)
    {
        $resultado = $this->mueble->obtenerMuebleId($id_mueble);
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
        $resultado = $this->mueble->actualizarMuebleId($id_mueble);
        return $resultado;
    }

    public function eliminarMuebleId($id_mueble)
    {
        $resultado = $this->mueble->eliminarMuebleId($id_mueble);
        return $resultado;
    }
}
