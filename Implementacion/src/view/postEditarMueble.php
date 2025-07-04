<?php

require_once __DIR__ . '/../bootstrap.php';

use StockManager\Controller\ControladorMueble;

$controladorMueble = new ControladorMueble();
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arrayAsociativo = [
        "id_mueble" => $_GET['id_mueble'],
        "nombre" => $_POST['nombre'],
        "peso" => $_POST['peso'],
        "ancho" => $_POST['ancho'],
        "alto" => $_POST['alto'],
        "largo" => $_POST['largo']
    ];

    try {
        $controladorMueble->actualizarMuebleId($arrayAsociativo);
        header('Location: /stockmanager/index.php?exito=editado');
        exit();
    } catch (\InvalidArgumentException $e) {
        $error = $e->getMessage();
        $id = $_GET['id_mueble'];
        header("Location: ./editarMueble.php?id_mueble=$id&error=argumentoInvalido");
        exit();
    }
}
