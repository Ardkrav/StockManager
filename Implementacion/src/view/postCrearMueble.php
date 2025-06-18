<?php

require_once __DIR__ . '/../bootstrap.php';

use StockManager\Controller\ControladorMueble;

$controladorMueble = new ControladorMueble();
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arrayAsociativo = [
        "nombre" => $_POST['nombre'],
        "peso" => $_POST['peso'],
        "ancho" => $_POST['ancho'],
        "alto" => $_POST['alto'],
        "largo" => $_POST['largo']
    ];

    try {
        $controladorMueble->crearMueble($arrayAsociativo);
        header('Location: ./listarMueble.php?exito=creado');
        exit();
    } catch (\InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}
