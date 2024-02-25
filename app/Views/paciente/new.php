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
            position: relative;
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
            margin-top: 0;
        }

        .button-container button {
            background-color: #a5d8b9;
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
            background-color: #c0e7c8;
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
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Estilo específico para el input de DNI */
        input#dni {
            width: 35%; /* Ajuste de la longitud del input */
        }

        input#dni::placeholder {
            color: #aaa;
            font-size: 20px;
        }

        /* Estilo específico para el input de Altura */
        input#altura {
            width: 30%;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #ccc;
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

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #a5d8b9;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
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

        #logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 100px;
        }

        label {
            display: inline-block;
        }

        .menor-longitud {
            display: inline-block;
        }

        b {
            color: #f00;
        }

    </style>
</head>

<body>
    <!-- <img src="../logo.png" alt="Logo" id="logo"> -->

    <h1>Paciente</h1>

    <h2><?= $validation->listErrors() ?></h2>

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
        <label for="dni" class="menor-longitud">DNI</label><b>*</b>
        <br>
        <input type="text" name="dni" id="dni" placeholder="XX.XXX.XXX">
        <br>
        <label for="nombre">Nombres</label><b>*</b>
        <input type="text" name="nombre" id="nombre">

        <label for="apellido">Apellidos</label><b>*</b>
        <input type="text" name="apellido" id="apellido">

        <label for="celular">Celular</label><b>*</b>
        <input type="text" name="celular" id="celular">

        <label for="localidad">Localidad</label><b>*</b>
        <input type="text" name="localidad" id="localidad">

        <label for="calle">Calle</label><b>*</b>
        <input type="text" name="calle" id="calle">

        <label for="altura" class="menor-longitud">Altura</label><b>*</b>
        <br>
        <input type="text" name="altura" id="altura">

        <input type="submit" value="Guardar">
    </form>
</body>

</html>




