<?php
function modificarFecha($fecha) 
{
    $fechaConvertida = explode("-", $fecha);
    $fechaModificada = $fechaConvertida[2]."/".$fechaConvertida[1]."/".$fechaConvertida[0];
    return $fechaModificada;
}

function modificarFormato($formato) {
    $primeraDivision = explode("T",$formato);
    $fechaConFormato = modificarFecha($primeraDivision[0]);
    $horaDividida = explode(".", $primeraDivision[1]);
    $formatoModificado = $fechaConFormato." Hora:".$horaDividida[0];
    return $formatoModificado;
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Recetas</title>
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
    </style>
</head>

<body>
    <h1>Consulta de Recetas</h1>

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
                    <th>Fecha de Creación</th>
                    <th>Última modificación</th>
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
                        <td><?php echo modificarFormato($receta['created_at']); ?></td>
                        <td><?php echo modificarFormato($receta['updated_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No se encontraron recetas.</p>
    <?php endif; ?>
</body>

</html>