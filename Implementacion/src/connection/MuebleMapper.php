<?php

namespace StockManager\Connection;

use StockManager\Connection\BDConexion;

class MuebleMapper
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = BDConexion::getInstancia();
    }

    public function crearMueble($datos)
    {
        $query = "INSERT INTO mueble (nombre, peso, ancho, alto, largo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param(
            "sdddd",
            $datos->getNombre(),
            $datos->getPeso(),
            $datos->getAncho(),
            $datos->getAlto(),
            $datos->getLargo()
        );
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function listarMuebles()
    {
        $muebles = $this->conexion->query("SELECT * FROM mueble");
        $resultado = [];
        while ($fila = $muebles->fetch_assoc()) {
            $resultado[] = $fila;
        }
        return $resultado;
    }

    public function obtenerMuebleId($id_mueble)
    {
        $query = "SELECT * FROM mueble WHERE id_mueble = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id_mueble);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        return $resultado;
    }

    public function eliminarMuebleId($id_mueble)
    {
        $query = "DELETE FROM mueble WHERE id_mueble = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id_mueble);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            throw new \RunTimeException("No se encontro el mueble a eliminar");
        }
        return true;
    }

    public function actualizarMuebleId($datos)
    {
        $query = "UPDATE mueble SET nombre = ?, peso = ?, ancho = ?, alto = ?, largo = ? WHERE id_mueble = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param(
            "sddddi",
            $datos->getNombre(),
            $datos->getPeso(),
            $datos->getAncho(),
            $datos->getAlto(),
            $datos->getLargo(),
            $datos->getId()
        );
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
