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

        /* Agregamos un estilo para el mensaje en rojo */
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
    <h1>Receta</h1>

    <div class="button-container">
        <a href="http://recetize.test/PacienteController/new"><button>Paciente</button></a>
        <a href="http://recetize.test/MedicoController/new"><button>Medico</button></a>
        <a href="http://recetize.test/RemedioController/new"><button>Remedio</button></a>
        <button class="selected">Receta</button>
    </div>

    <p class="message">Aclaración: el paciente y el médico deben haber sido cargados previamente</p>

    <form action="<?= base_url()?>RecetaController" method="post">
        <label for="nroReceta">Numero de receta</label>
        <input type="number" name="nroReceta" id="nroReceta">

        <label for="fechaEmision">Fecha de emision</label>
        <input type="text" name="fechaEmision" id="fechaEmision">

        <label for="Remedio_codigo">Codigo del remedio</label>
        <input type="text" name="Remedio_codigo" id="Remedio_codigo">

        <label for="Paciente_dni">DNI del paciente</label>
        <input type="text" name="Paciente_dni" id="Paciente_dni">

        <label for="Medico_matricula">Matricula del medico</label>
        <input type="text" name="Medico_matricula" id="Medico_matricula">

        <input type="submit" value="Guardar">
    </form>

    <!-- <form action="<?= base_url()?>RemedioRecetaController/create" method="post">
        <label for="remedio_id">Remedio</label>
        <input type="number" name="remedio_id" id="remedio_id">

        <input type="submit" value="+">
    </form> -->

    <div class="formulario-receta">
        <form action="<?= base_url()?>RemedioRecetaController" method="post" class="remedio-form">
            <div class="input-group">
                <label for="remedio_id">Remedio</label>
                <input type="number" name="remedio_id[]" class="remedio-id">
            </div>
            <input type="submit" value="+">
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('#formularios-receta').addEventListener('click', function (event) {
                if (event.target.matches('.remedio-form input[type="submit"]')) {
                    event.preventDefault();
                    const newForm = document.querySelector('.formulario-receta').cloneNode(true);
                    newForm.querySelector('.remedio-id').value = '';
                    document.querySelector('#formularios-receta').appendChild(newForm);
                }
            });
        });
    </script>

</body>
</html>

