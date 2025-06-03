<?php

namespace Implementacion\PHP\models;

class Mueble
{
    private $nombre;
    private $peso;
    private $ancho;
    private $alto;
    private $largo;
    private $volumen;
    private $conexion;

    public function __construct(
        $conexion,
        $nombre = null,
        $peso = null,
        $ancho = null,
        $alto = null,
        $largo = null,
        $volumen = null
    ) {
        $this->conexion = $conexion;
        $this->nombre = $nombre;
        $this->peso = $peso;
        $this->ancho = $ancho;
        $this->alto = $alto;
        $this->largo = $largo;
        $this->volumen = $volumen;
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

    public function crearMueble()
    {
        $query = "INSERT INTO mueble (nombre, peso, ancho, alto, largo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sdddd", $this->nombre, $this->peso, $this->ancho, $this->alto, $this->largo);
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
            $fila['volumen'] = $fila['alto'] * $fila['ancho'] * $fila['largo'];
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
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizarMuebleId($id_mueble)
    {
        $query = "UPDATE mueble SET nombre = ?, peso = ?, ancho = ?, alto = ?, largo = ? WHERE id_mueble = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sddddi", $this->nombre, $this->peso, $this->ancho, $this->alto, $this->largo, $id_mueble);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
