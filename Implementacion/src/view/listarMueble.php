<?php

require_once __DIR__ . '/../bootstrap.php';

use StockManager\controller\ControladorMueble;

$controladorMueble = new ControladorMueble();

$muebles = $controladorMueble->listarMuebles();

if (isset($_GET['exito'])) {
    switch ($_GET['exito']) {
        case 'creado':
            $exito = "Mueble agregado correctamente.";
            break;
        case 'editado':
            $exito = "Mueble editado correctamente.";
            break;
        case 'eliminado':
            $exito = "Mueble eliminado correctamente.";
            break;
    }
}

if (isset($_GET['error'])) {
    $exito = $_GET['error'];
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
            Listado de muebles
        </h1>
    </header>
    <section>

        <?php if ($exito) : ?>
            <p style="color: green; font-weight: bold;"><?php echo htmlspecialchars($exito); ?></p>
        <?php endif; ?>

        <?php if ($error) : ?>
            <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <button onclick="window.location.href='./crearMueble.php'">Agregar</button>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Peso (kg)</th>
                <th>Ancho (m)</th>
                <th>Largo (m)</th>
                <th>Alto (m)</th>
                <th>Volumen (m3)</th>
                <th>Acci&oacute;n</th>
            </tr>
            <?php foreach ($muebles as $mueble) : ?>
                <tr>
                    <td><?php echo $mueble->getId(); ?></td>
                    <td><?php echo $mueble->getNombre(); ?></td>
                    <td><?php echo $mueble->getPeso(); ?></td>
                    <td><?php echo $mueble->getAncho(); ?></td>
                    <td><?php echo $mueble->getLargo(); ?></td>
                    <td><?php echo $mueble->getAlto(); ?></td>
                    <td><?php echo $mueble->getVolumen(); ?></td>
                    <td>
                        <button
                            onclick=
                            "window.location.href='editarMueble.php?id_mueble=<?php echo $mueble->getId(); ?>'">
                            Editar
                        </button>
                        <button onclick="onConfirm(<?php echo $mueble->getId(); ?>)">Eliminar</button>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>

        <script>
            function onConfirm(id_mueble) {
                if (confirm("¿Está seguro de que desea eliminar este mueble?")) {
                    window.location.href = `getListarMueble.php?eliminar=${id_mueble}`
                } else {
                    return;
                }
            }
        </script>
    </section>
</body>

</html>