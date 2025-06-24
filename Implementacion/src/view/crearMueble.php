<?php

$error = null;

if (isset($_GET['error'])) {
    $error =
        "Argumento invalido. \nRevise que no hayan campos vacios y 
        peso, ancho, alto y largo sean valores numéricos.";
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
</head>

<body>
    <div class="container py-4">
        <header class="mb-1 text-center">
            <h2 class="fw-bold">
                StockManager - Creacion de mueble
            </h2>
        </header>

        <?php if ($error): ?>
            <div id="mensajeError" class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="postCrearMueble.php" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ej: Mesa de comedor" required>
            <div class="invalid-feedback">Por favor, ingrese un nombre.</div>
        </div>

        <div class="mb-3">
            <label for="peso" class="form-label">Peso (kg):</label>
            <input id="peso" name="peso" type="number" step="0.01" class="form-control" placeholder="Ej: 12.5" required>
            <div class="invalid-feedback">Ingrese un peso válido.</div>
        </div>

        <div class="mb-3">
            <label for="ancho" class="form-label">Ancho (m):</label>
            <input id="ancho" name="ancho" type="number" step="0.01" class="form-control" placeholder="Ej: 1.20" required>
            <div class="invalid-feedback">Ingrese un ancho válido.</div>
        </div>

        <div class="mb-3">
            <label for="largo" class="form-label">Largo (m):</label>
            <input id="largo" name="largo" type="number" step="0.01" class="form-control" placeholder="Ej: 2.00" required>
            <div class="invalid-feedback">Ingrese un largo válido.</div>
        </div>

        <div class="mb-3">
            <label for="alto" class="form-label">Alto (m):</label>
            <input id="alto" name="alto" type="number" step="0.01" class="form-control" placeholder="Ej: 0.75" required>
            <div class="invalid-feedback">Ingrese un alto válido.</div>
        </div>

        <hr>

        <button type="submit" class="btn btn-success me-2">Aceptar</button>
        <button type="button" id="cancelar" class="btn btn-secondary">Cancelar</button>
    </form>
    </div>
    <script src="./js/cancelarFormulario.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">
    </script>
    <script src="./js/restriccionesBoostrap.js"></script>

</body>

</html>