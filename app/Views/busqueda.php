<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>busqueda</title>
</head>
<body>
    <h1>RECETAS</h1>

    <?php if (!empty($todasLasRecetas)) : ?>
        <pre>
            <?php print_r($todasLasRecetas); ?>
        </pre>
    <?php else : ?>
        <p>No se han recibido datos del servidor.</p>
    <?php endif; ?>
</body>
</html>