<?php
function modificarFecha($fecha) 
{
    $fechaConvertida = explode("-", $fecha);
    $fechaModificada = $fechaConvertida[2]."/".$fechaConvertida[1]."/".$fechaConvertida[0];
    return $fechaModificada;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminacion de Recetas</title>
    <style>
        body {
            background-color: #f0f8ff;
            /* Color verde clarito */
            text-align: center;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            /* Color verde más oscuro para encabezado de tabla */
            color: white;
        }

        #back {
            float: right;
            margin-top: -40px;
            margin-right: 20px;

        }

        .back-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .back-button button {
            background-color: #c0e7c8;
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button button:hover {
            background-color: #a5d8b9;
        }

        #search-form {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        #search-form input,
        #search-form select {
            padding: 8px;
            margin: 0 5px;
        }

        #search-form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #search-form button:hover {
            background-color: #45a049;
        }

        .input-group {
            display: flex;
            margin-bottom: 10px;
        }

        .input-group label {
            margin-right: 5px;
            width: 100px;
            text-align: right;
        }

        .campo-busqueda {
            display: inline-block;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <h1>Eliminacion de Recetas</h1>

    <div id="search-form">
    <form>
        <!-- Primera fila con tres campos -->
        <div class="input-group">
            <div class="campo-busqueda">
                <label for="nroReceta">Número de Receta:</label>
                <input type="text" id="nroReceta" name="nroReceta">
            </div>
            <div class="campo-busqueda">
                <label for="fechaEmision">Fecha de Emisión:</label>
                <input type="date" id="fechaEmision" name="fechaEmision">
            </div>
            <div class="campo-busqueda">
                <label for="Remedio_id">Remedio:</label>
                <input type="text" id="Remedio_id" name="Remedio_id">
            </div>

        </div>

        <!-- Segunda fila con dos campos -->
        <div class="input-group">
            <div class="campo-busqueda">
                <label for="Paciente_id">Paciente:</label>
                <input type="text" id="Paciente_id" name="Paciente_id">
            </div>
            <div class="campo-busqueda">
                <label for="Medico_id">Médico:</label>
                <input type="text" id="Medico_id" name="Medico_id">
            </div>
        </div>
        <button type="submit">Buscar</button>
    </form>
</div>



    <a href="http://recetize.test/pagprincipal" class="back-button">
        <button>Atrás</button>
    </a>

    <?php if (!empty($todasLasRecetas)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Nro Receta</th>
                    <th>Fecha Emisión</th>
                    <th>Remedio</th>
                    <th>Paciente</th>
                    <th>Medico</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($todasLasRecetas as $receta) : ?>
                    <tr>
                        <td><?php echo $receta['nroReceta']; ?></td>
                        <td><?php echo modificarFecha($receta['fechaEmision']); ?></td>
                        <td><?php echo $receta['Remedio_id']; ?></td>
                        <td><?php echo $receta['Paciente_id']; ?></td>
                        <td><?php echo $receta['Medico_id']; ?></td>
                        <td>
                            <button class="delete-button" onclick="confirmarEliminar(<?php echo $receta['id']; ?>)">-</button>
                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No se encontraron recetas.</p>
    <?php endif; ?>

    <script>
        function confirmarEliminar(idReceta) {
            if (confirm("¿Estás seguro de que deseas eliminar esta receta?")) {
                var urlEliminarReceta = "<?php echo site_url('pagprincipal/eliminarReceta/'); ?>" + idReceta;

                var form = document.createElement('form');
                form.setAttribute('method', 'POST');
                form.setAttribute('action', urlEliminarReceta);

                var hiddenField = document.createElement('input');
                hiddenField.setAttribute('type', 'hidden');
                hiddenField.setAttribute('name', 'idReceta');
                hiddenField.setAttribute('value', idReceta);
                form.appendChild(hiddenField);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>

</html>
