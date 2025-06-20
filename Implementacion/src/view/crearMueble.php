<?php

$error = null;
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
        <form method="POST" action="postCrearMueble.php">
            <label for="nombre">Nombre:</label>
            <input id="nombre" name="nombre" type="text" required>
            <br>
            <label for="peso">Peso (kg):</label>
            <input id="peso" name="peso" type="number" step="0.01" required>
            <br>
            <label for="ancho">Ancho (m):</label>
            <input id="ancho" name="ancho" type="number" step="0.01" required>
            <br>
            <label for="largo">Largo (m):</label>
            <input id="largo" name="largo" type="number" step="0.01" required>
            <br>
            <label for="alto">Alto (m):</label>
            <input id="alto" name="alto" type="number" step="0.01" required>
            <hr>
            <button type="submit">Aceptar</button>
            <button id="cancelar">Cancelar</button>
        </form>
        <?php if ($error) : ?>
        <p style="color: red; font-weight: bold;"> <?php echo $error ?></p>
        <?php endif; ?>
    </section>
    <script src="./js/cancelarFormulario.js"></script>
</body>

</html>