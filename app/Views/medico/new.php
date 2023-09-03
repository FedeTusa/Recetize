<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar medico</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            color: #333; /* Color de texto para el encabezado */
        }

        form {
            background-color: #f0f8f0; /* Color de fondo para el formulario */
            padding: 20px;
            border-radius: 10px;
            width: 400px; /* Ancho del formulario */
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555; /* Color de texto para las etiquetas */
        }

        input[type="number"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #c0e7c8; /* Color de fondo para el botón */
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #a5d8b9; /* Cambio de color al pasar el cursor */
        }
    </style>
</head>
<body>
    
    <h1>cargar medico</h1>

    <form action="<?= base_url()?>MedicoController" method="post">
        <label for="matricula">matricula</label>
        <input type="number" name="matricula" id="matricula">

        <label for="nombre">nombre</label>
        <input type="text" name="nombre" id="nombre">

        <label for="apellido">apellido</label>
        <input type="text" name="apellido" id="apellido">

        <label for="especialidad">especialidad</label>
        <input type="text" name="especialidad" id="especialidad">

        <label for="localidad">localidad</label>
        <input type="text" name="localidad" id="localidad">

        <input type="submit" value="Guardar">
    </form>
    
</body>
</html>
