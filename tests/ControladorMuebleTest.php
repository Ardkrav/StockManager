<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use StockManager\Controller\ControladorMueble;
use StockManager\Model\Mueble;
use StockManager\Connection\MuebleMapper;
use ReflectionClass;
use InvalidArgumentException;
use RunTimeException;

class ControladorMuebleTest extends TestCase
{
    private $mapperMock;
    private $controlador;

    public function setUp(): void
    {
        $this->mapperMock = $this->getMockBuilder(MuebleMapper::class)
                             ->disableOriginalConstructor()
                             ->getMock();

        $this->controlador = new ControladorMueble($this->mapperMock);
        $ref = new ReflectionClass($this->controlador);
        $prop = $ref->getProperty('mapper');
        $prop->setAccessible(true);
        $prop->setValue($this->controlador, $this->mapperMock);
    }

    // Crear mueble
    public function testCP02_1_CrearMuebleValido()
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

    public function testCP02_2_CrearMuebleFaltanCampos()
    {
        $this->expectException(InvalidArgumentException::class);

        $data = [
            'nombre' => 'Mesa',
            'peso' => 15,
            // falta 'ancho', 'alto', 'largo'
        ];

        $this->controlador->crearMueble($data);
    }

    public function testCP02_3_CrearMuebleConString()
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
    public function testCP00_1_ObtenerMuebleValido()
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

    public function testCP00_2_ObtenerMuebleNoEncontrado()
    {
        $this->expectException(RunTimeException::class);

        $this->mapperMock->expects($this->once())
            ->method('obtenerMuebleId')
            ->with(5)
            ->willReturn(null);

        $mueble = $this->controlador->obtenerMuebleId(5);
    }

    public function testCP00_3_ObtenerMuebleIdInvalido()
    {
        $this->expectException(RunTimeException::class);

        $this->mapperMock->expects($this->once())
            ->method('obtenerMuebleId')
            ->with('cinco')
            ->willReturn(null);

        $mueble = $this->controlador->obtenerMuebleId('cinco');
    }

    // Actualizar mueble
    public function testCP03_1_ActualizarMuebleValido()
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
            ->with($this->callback(function ($mueble) use ($data) {
                return $mueble->getId() === $data['id_mueble']
                    && $mueble->getNombre() === $data['nombre']
                    && $mueble->getPeso() === $data['peso']
                    && $mueble->getAncho() === $data['ancho']
                    && $mueble->getAlto() === $data['alto']
                    && $mueble->getLargo() === $data['largo'];
            }))
            ->willReturn(true);


        $resultado = $this->controlador->actualizarMuebleId($data);

        $this->assertTrue($resultado);
    }

    public function testCP03_2_ActualizarMuebleInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $data = [
            'id_mueble' => 1,
            'nombre' => 'Silla',
            'peso' => 10
        ];

        $resultado = $this->controlador->actualizarMuebleId($data);
    }

    // Eliminar mueble
    public function testCP04_1_EliminarMuebleValido()
    {
        $this->mapperMock->expects($this->once())
            ->method('eliminarMuebleId')
            ->with(5)
            ->willReturn(true);

        $resultado = $this->controlador->eliminarMuebleId(5);
        $this->assertEquals(true, $resultado);
    }

    public function testCP04_2_EliminarMuebleInvalido()
    {
        $this->expectException(RunTimeException::class);

        $this->mapperMock->expects($this->once())
            ->method('eliminarMuebleId')
            ->with(5)
            ->willThrowException(new RuntimeException("No se encontro el mueble a eliminar"));

        $resultado = $this->controlador->eliminarMuebleId(5);
        $this->assertEquals(false, $resultado);
    }
}
