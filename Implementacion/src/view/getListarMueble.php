<?php

    require_once __DIR__ . '/../bootstrap.php';

    use StockManager\controller\ControladorMueble;

if (isset($_GET['eliminar'])) {
    $controladorMueble = new ControladorMueble();
    $id_mueble = $_GET['eliminar'];
    $controladorMueble->eliminarMuebleId($id_mueble);
    header("Location: listarMueble.php?exito=eliminado");
    exit();
}
