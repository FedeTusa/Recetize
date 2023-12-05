<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar paciente</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: left;
            margin-top: 20px;
            font-size: 32px;
            color: #333;
        }

        .button-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
        }

        .button-container button {
            background-color: #00cc66; /* Verde claro para el botón "Remedio" */
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            width: 120px;
            margin-right: 10px;
        }

        .button-container button.selected {
            background-color: #ccc; /* Gris claro para el botón "Paciente" seleccionado */
        }

        form {
            background-color: #f0f8f0;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="number"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"], input[type="button"] {
            background-color: #ccc; /* Gris claro para el botón "Remedio" y "Médico" */
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            display: inline-block;
            width: 100%;
        }

        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #a5d8b9; /* Cambio de color al pasar el mouse */
        }

                /* Estilos para el botón "Atrás" */
                .back-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* Estilos para el botón */
        .back-button button {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 10px 20px; /* Ajusta el padding para cambiar el tamaño del botón */
            border-radius: 10px; /* Bordes redondeados */
            font-weight: bold;
            font-size: 18px; /* Tamaño del texto */
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button button:hover {
            background-color: #333; /* Cambio de color al pasar el mouse */
        }

    </style>
</head>
<body>
    <h1>Paciente</h1>

    <h2><?= $validation->listErrors() ?></h2> <!-- no funciona -->

    <a href="http://recetize.test/pagprincipal" class="back-button">
        <button>Atrás</button>
    </a>

    <div class="button-container">
        <button class="selected">Paciente</button>
        <a href="http://recetize.test/RemedioController/new"><button>Remedio</button></a>
        <a href="http://recetize.test/MedicoController/new"><button>Médico</button></a>
        <a href="http://recetize.test/RecetaController/new"><button>Receta</button></a>
    </div>

    <form action="<?= base_url()?>PacienteController" method="post">
        <label for="dni">DNI</label>
        <input type="number" name="dni" id="dni">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">

        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido">

        <label for="celular">Celular</label>
        <input type="text" name="celular" id="celular">

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad" id="localidad">

        <label for="calle">Calle</label>
        <input type="text" name="calle" id="calle">

        <label for="altura">Altura</label>
        <input type="text" name="altura" id="altura">

        <input type="submit" value="Guardar">
    </form>
</body>
</html>



