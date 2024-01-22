<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar remedio</title>
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

        .message {
            color: red;
            margin-top: 10px;
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

        input#codigo {
            width: 45%; /* Ajuste de la longitud del input */
            color: #aaa;
        }

        input#codigo::placeholder {
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
    </style>
</head>
<body>
    <h1>Remedio</h1>

    <div class="button-container">
        <a href="http://recetize.test/PacienteController/new"><button>Paciente</button></a>
        <button class="selected">Remedio</button>
        <a href="http://recetize.test/MedicoController/new"><button>Médico</button></a>
        <a href="http://recetize.test/RecetaController/new"><button>Receta</button></a>
    </div>

    <p class="message">Aclaración: En caso de haber finalizado de cargar los remedios proceda a cargar el médico</p>    

    <form action="<?= base_url()?>RemedioController" method="post">
        <label for="codigo">Código*</label>
        <input type="number" name="codigo" id="codigo" placeholder="X-XXXXXXXXXXXX">

        <label for="droga">Droga*</label>
        <input type="text" name="droga" id="droga">

        <label for="medicamento">Medicamento</label>
        <input type="text" name="medicamento" id="medicamento">

        <input type="submit" value="Guardar">
    </form>
</body>
</html>


