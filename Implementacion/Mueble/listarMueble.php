<?php

namespace StockManager\Mueble;

require_once __DIR__ . '/../PHP/bootstrap.php';

use StockManager\PHP\ControladorMueble;

$controladorMueble = new ControladorMueble();

if (isset($_GET['eliminar'])) {
    $id_mueble = $_GET['eliminar'];
    $controladorMueble->eliminarMuebleId($id_mueble);
    header("Location: listarMueble.php");
    exit();
}

$muebles = $controladorMueble->listarMuebles();
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
                    <td><?php echo $mueble['id_mueble']; ?></td>
                    <td><?php echo $mueble['nombre']; ?></td>
                    <td><?php echo $mueble['peso']; ?></td>
                    <td><?php echo $mueble['ancho']; ?></td>
                    <td><?php echo $mueble['largo']; ?></td>
                    <td><?php echo $mueble['alto']; ?></td>
                    <td><?php echo $mueble['volumen']; ?></td>
                    <td>
                        <button
                            onclick=
                            "window.location.href='editarMueble.php?id_mueble=<?php echo $mueble['id_mueble']; ?>'">
                            Editar
                        </button>
                        <button onclick="onConfirm(<?php echo $mueble['id_mueble']; ?>)">Eliminar</button>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>

        <script>
            function onConfirm(id_mueble) {
                if (confirm("¿Está seguro de que desea eliminar este mueble?")) {

                    window.location.href = `listarMueble.php?eliminar=${id_mueble}`
                } else {
                }
            }
        </script>
    </section>
</body>

</html>