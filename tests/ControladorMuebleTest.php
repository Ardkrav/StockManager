<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use StockManager\Controller\ControladorMueble;
use StockManager\Model\Mueble;
use StockManager\Connection\MuebleMapper;

class ControladorMuebleTest extends TestCase
{
    private $mapperMock;
    private $controlador;

    public function setUp()
    {
        $this->mapperMock = $this->createMock(MuebleMapper::class);

        $this->controlador = new ControladorMueble();
        $ref = new ReflectionClass($this->controlador);
        $prop = $ref->getProperty('mapper');
        $prop->setAccessible(true);
        $prop->setValue($this->controlador, $this->mapperMock);
    }

    // Crear mueble
    public function testCrearMuebleValido()
    {
        $data = [
            'nombre' => 'Silla',
            'peso' => 10,
            'ancho' => 50,
            'alto' => 100,
            'largo' => 60
        ];

        $this->mapperMock->expects($this->once())
            ->method('crearMueble')
            ->willReturn(true);

        $resultado = $this->controlador->crearMueble($data);

        $this->assertTrue($resultado);
    }

    public function testCrearMuebleInvalido1()
    {
        $this->expectException(InvalidArgumentException::class);

        $data = [
            'nombre' => 'Mesa',
            'peso' => 15,
            // falta 'ancho', 'alto', 'largo'
        ];

        $this->controlador->crearMueble($data);
    }

    public function testCrearMuebleInvalido2()
    {
        $this->expectException(InvalidArgumentException::class);

        $data = [
            'nombre' => 'Mesa',
            'peso' => 15,
            'ancho' => 'diez',
            'alto' => 'veinte',
            'largo' => 'quince'
        ];

        $this->controlador->crearMueble($data);
    }

    // Obtener muble por id
    public function testObtenerMueblePorIdValido()
    {
        $muebleData = [
            'nombre' => 'Mesa',
            'peso' => 20,
            'ancho' => 80,
            'alto' => 75,
            'largo' => 120
        ];

        $this->mapperMock->expects($this->once())
            ->method('obtenerMuebleId')
            ->with(5)
            ->willReturn($muebleData);

        $mueble = $this->controlador->obtenerMuebleId(5);

        $this->assertEquals('Mesa', $mueble->getNombre());
        $this->assertEquals(20, $mueble->getPeso());
        $this->assertEquals(80, $mueble->getAncho());
        $this->assertEquals(75, $mueble->getAlto());
        $this->assertEquals(120, $mueble->getLargo());
    }

    public function testObtenerMueblePorIdInvalido1()
    {
        $this->expectException(RunTimeException::class);

        $this->mapperMock->expects($this->once())
            ->method('obtenerMuebleId')
            ->with(5)
            ->willReturn([]);

        $mueble = $this->controlador->obtenerMuebleId(5);
    }

    public function testObtenerMueblePorIdInvalido2()
    {
        $this->expectException(RunTimeException::class);

        $this->mapperMock->expects($this->once())
            ->method('obtenerMuebleId')
            ->with('cinco')
            ->willReturn([]);

        $mueble = $this->controlador->obtenerMuebleId('cinco');
    }

    // Actualizar mueble
    public function testActualizarMuebleIdValido()
    {
        $data = [
            'id_mueble' => 1,
            'nombre' => 'Silla',
            'peso' => 10,
            'ancho' => 50,
            'alto' => 100,
            'largo' => 60
        ];

        $this->mapperMock->expects($this->once())
            ->method('actualizarMuebleId')
            ->with($data)
            ->willReturn(true);

        $resultado = $this->controlador->actualizarMuebleId($data);

        $this->assertTrue($resultado);
    }

    public function testActualizarMuebleIdInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $data = [
            'id_mueble' => 1,
            'nombre' => 'Silla',
            'peso' => 10
        ];

        $this->mapperMock->expects($this->once())
            ->method('actualizarMuebleId')
            ->with($data)
            ->willReturn(true);

        $resultado = $this->controlador->actualizarMuebleId($data);
    }

    // Eliminar mueble
    public function testEliminarMuebleValido()
    {
        $this->mapperMock->expects($this->once())
            ->method('eliminarMuebleId')
            ->with(5)
            ->willReturn(true);

        $resultado = $this->controlador->eliminarMuebleId(5);
        $this->assertEquals(true, $resultado);
    }

    public function testEliminarMuebleInvalido()
    {
        $this->mapperMock->expects($this->once())
            ->method('eliminarMuebleId')
            ->with(5)
            ->willReturn(false);

        $resultado = $this->controlador->eliminarMuebleId(5);
        $this->assertEquals(false, $resultado);
    }
}
