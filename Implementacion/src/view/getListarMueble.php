<?php

    require_once __DIR__ . '/../bootstrap.php';

    use StockManager\Controller\ControladorMueble;

if (isset($_GET['eliminar'])) {
    $controladorMueble = new ControladorMueble();
    $id_mueble = $_GET['eliminar'];
    try {
        $controladorMueble->eliminarMuebleId($id_mueble);
        header("Location: listarMueble.php?exito=eliminado");
        exit();
    } catch (\RunTimeException $e) {
        header("Location: listarMueble.php?error=idInvalido");
        exit();
    }
}
