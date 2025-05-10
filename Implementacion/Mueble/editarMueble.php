<?php
require_once __DIR__ . '/../PHP/controladorMueble.php';

$controladorMueble = new controladorMueble();
$mueble = $controladorMueble->obtenerMuebleId($_GET['id_mueble']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $peso = $_POST['peso'];
    $ancho = $_POST['ancho'];
    $alto = $_POST['alto'];
    $largo = $_POST['largo'];

    $muebleActualizado = $controladorMueble->actualizarMuebleId($_GET['id_mueble'], $nombre, $peso, $ancho, $alto, $largo);
    if ($muebleActualizado) {
        header('Location: ./listarMueble.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Manager</title>
</head>
<body>
    <header>
        <nav>

        </nav>
        <h1>
            Stock Manager
        </h1>
    </header>
    <section>
        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input id="nombre" name="nombre" type="text" value ="<?php echo $mueble["nombre"] ?>">
            <br>
            <label for="peso">Peso (kg):</label>
            <input id="peso" name="peso" type="number" step="0.01" value ="<?php echo $mueble["peso"] ?>">
            <br>
            <label for="ancho">Ancho (m):</label>
            <input id="ancho" name="ancho" type="number" step="0.01" value ="<?php echo $mueble["ancho"] ?>">
            <br>
            <label for="largo">Largo (m):</label>
            <input id="largo" name="largo" type="number" step="0.01" value ="<?php echo $mueble["largo"] ?>">
            <br>
            <label for="alto">Alto (m):</label>
            <input id="alto" name="alto" type="number" step="0.01" value ="<?php echo $mueble["alto"] ?>">
            <hr>
            <button type="submit">Aceptar</button>
            <button id="cancelar" >Cancelar</button>
        </form>
    </section>
    <script src="./js/cancelarFormulario.js"></script>

</body>
</html>