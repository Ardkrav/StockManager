<?php

require_once __DIR__ . '/../PHP/bootstrap.php';

use StockManager\PHP\ControladorMueble;


$controladorMueble = new controladorMueble();
$mueble = $controladorMueble->obtenerMuebleId($_GET['id_mueble']);
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $arrayAsociativo = ["id_mueble" => $_GET['id_mueble'], "nombre" => $_POST['nombre'], "peso" => $_POST['peso'], "ancho" => $_POST['ancho'], "alto" => $_POST['alto'], "largo" => $_POST['largo']];

    try {
        $controladorMueble->actualizarMuebleId($arrayAsociativo);
        header('Location: ./listarMueble.php');
        exit();
    } catch (\InvalidArgumentException $e) {
        $error = $e->getMessage();
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
            <input id="nombre" name="nombre" type="text" value="<?php echo $mueble->getNombre() ?>" required>
            <br>
            <label for="peso">Peso (kg):</label>
            <input id="peso" name="peso" type="number" step="0.01" value="<?php echo $mueble->getPeso() ?>" required>
            <br>
            <label for="ancho">Ancho (m):</label>
            <input id="ancho" name="ancho" type="number" step="0.01" value="<?php echo $mueble->getAncho() ?>" required>
            <br>
            <label for="largo">Largo (m):</label>
            <input id="largo" name="largo" type="number" step="0.01" value="<?php echo $mueble->getLargo() ?>" required>
            <br>
            <label for="alto">Alto (m):</label>
            <input id="alto" name="alto" type="number" step="0.01" value="<?php echo $mueble->getAlto() ?>" required>
            <hr>
            <button type="submit">Aceptar</button>
            <button id="cancelar">Cancelar</button>
        </form>
        <?php if($error): ?>
        <p><?php echo $error ?></p>
        <?php endif; ?>

    </section>
    <script src="./js/cancelarFormulario.js"></script>

</body>

</html>