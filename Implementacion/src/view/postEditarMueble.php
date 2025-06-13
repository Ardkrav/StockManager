<?php

require_once __DIR__ . '/../bootstrap.php';

use StockManager\controller\ControladorMueble;


$controladorMueble = new controladorMueble();
$mueble = $controladorMueble->obtenerMuebleId($_GET['id_mueble']);
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
        header('Location: ./listarMueble.php');
        exit();
    } catch (\InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}
