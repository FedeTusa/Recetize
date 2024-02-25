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

        input#matricula {
            width: 30%; 
        }

        input#matricula::placeholder {
            color: #aaa;
            font-size: 20px;
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

        .menor-longitud {
            display: inline-block;
        }

        b {
            color: #f00;
        }

    </style>
</head>
<body>
    <h1>Médico</h1>

    <div class="button-container">
        <a href="http://recetize.test/PacienteController/new"><button>Paciente</button></a>
        <a href="http://recetize.test/RemedioController/new"><button>Remedio</button></a>
        <button class="selected">Médico</button>
        <a href="http://recetize.test/RecetaController/new"><button>Receta</button></a>
        
    </div>

    <form action="<?= base_url()?>MedicoController" method="post">
        <label for="matricula" class="menor-longitud">Matrícula Provincial</label><b>*</b>
        <br>
        <input type="number" name="matricula" id="matricula" placeholder="XXXXX">
        <br>
        <label for="nombre" class="menor-longitud">Nombres</label><b>*</b>
        <input type="text" name="nombre" id="nombre">

        <label for="apellido" class="menor-longitud">Apellidos</label><b>*</b>
        <input type="text" name="apellido" id="apellido">

        <label for="especialidad" class="menor-longitud">Especialidad</label><b>*</b>
        <input type="text" name="especialidad" id="especialidad">

        <label for="localidad" class="menor-longitud">Localidad</label><b>*</b>
        <input type="text" name="localidad" id="localidad">

        <input type="submit" value="Guardar">
    </form>
</body>
</html>
