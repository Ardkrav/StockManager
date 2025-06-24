<?php

require_once __DIR__ . '/../bootstrap.php';

use StockManager\Controller\ControladorMueble;

$controladorMueble = new ControladorMueble();
$error = null;
$muebles = $controladorMueble->listarMuebles();
$exito = null;
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
    switch ($_GET['error']) {
        case 'idInvalido':
            $error = "ID de mueble inválido.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
</head>

<body class="bg-light">
    <div class="container py-4">
        <header class="mb-4 text-center">
            <h2 class="fw-bold">
                StockManager - Listado de muebles
            </h2>
        </header>

        <?php if ($exito): ?>
            <div id="mensajeExito" class="alert alert-success text-center"><?php echo htmlspecialchars($exito); ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div id="mensajeError" class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle" id="tablaMueble">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Peso (kg)</th>
                        <th class="text-center">Ancho (m)</th>
                        <th class="text-center">Largo (m)</th>
                        <th class="text-center">Alto (m)</th>
                        <th class="text-center">Volumen (m3)</th>
                        <th class="text-center">Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($muebles as $mueble): ?>
                        <tr>
                            <td class="text-center"><?php echo $mueble->getId(); ?></td>
                            <td class="text-center"><?php echo $mueble->getNombre(); ?></td>
                            <td class="text-center"><?php echo $mueble->getPeso(); ?></td>
                            <td class="text-center"><?php echo $mueble->getAncho(); ?></td>
                            <td class="text-center"><?php echo $mueble->getLargo(); ?></td>
                            <td class="text-center"><?php echo $mueble->getAlto(); ?></td>
                            <td class="text-center"><?php echo $mueble->getVolumen(); ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-2"
                                        onclick="window.location.href='editarMueble.php?id_mueble=<?php echo $mueble->getId(); ?>'">
                                    Editar
                                </button>
                                <button class="btn btn-sm btn-danger"
                                        onclick="onConfirm(<?php echo $mueble->getId(); ?>)">
                                    Eliminar
                                </button>
                            </td>
        
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

    <script>
        function onConfirm(id_mueble) {
            if (confirm("¿Está seguro de que desea eliminar este mueble?")) {
                window.location.href = `getListarMueble.php?eliminar=${id_mueble}`
            } else {
                return;
            }
        }
    </script>
    <?php if ($exito): ?>
        <script>
            setTimeout(() => {
                document.getElementById("mensajeExito").style.display = "none";
            }, 3000);
        </script>
    <?php endif; ?>
    <?php if ($error): ?>
        <script>
            setTimeout(() => {
                document.getElementById("mensajeError").style.display = "none";
            }, 3000);
        </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('#tablaMueble').DataTable({
            dom:"<'d-flex justify-content-between align-items-center mb-3'<'custom-filter'f><'custom-button'>>tip",
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.2/i18n/es-AR.json'
            },
            pageLength: 8,
            lengthChange: false,
            ordering: false, 
            responsive: true,
            initComplete: function () {
            $('.custom-button').html(`
                <div class="mb-3 text-end">
                <button class="btn btn-primary" onclick="window.location.href='./crearMueble.php'">
                    Agregar Mueble
                </button>
                </div>
            `);
            }
            });
        });
    </script>
    
</body>

</html>