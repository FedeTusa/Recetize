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
            background-color: #00cc66;
            /* Verde claro para el botón "Remedio" */
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
            background-color: #ccc;
            /* Gris claro para el botón "Paciente" seleccionado */
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

        input#nroReceta {
            width: 45%;
            /* Ajuste de la longitud del input */
            color: #aaa;
        }

        input#fechaEmision {
            width: 45%;
            /* Ajuste de la longitud del input */
            color: #aaa;
        }

        input#fechaEmision::placeholder {
            color: #aaa;
            font-size: 20px;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #ccc;
            /* Gris claro para el botón "Remedio" y "Médico" */
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
            /* Cambio de color al pasar el mouse */
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

        .menor-longitud {
            display: inline-block;
        }

        b {
            color: #f00;
        }
    </style>
</head>

<body>
    <h1>Receta</h1>

    <a href="http://recetize.test/pagprincipal" class="back-button">
        <button>Atrás</button>
    </a>

    <div class="button-container">
        <a href="http://recetize.test/PacienteController/new"><button>Paciente</button></a>
        <a href="http://recetize.test/RemedioController/new"><button>Remedio</button></a>
        <a href="http://recetize.test/MedicoController/new"><button>Médico</button></a>
        <button class="selected">Receta</button>
    </div>

    <p class="message">Aclaración: el paciente, el remedio y el médico deben haber sido cargados previamente</p>

    <form action="<?= base_url() ?>RecetaController" method="post">
        <label for="nroReceta" class="menor-longitud">Número de receta</label><b>*</b>
        <br>
        <input type="number" name="nroReceta" id="nroReceta">
        <br>
        <label for="fechaEmision" class="menor-longitud">Fecha de emisión</label><b>*</b>
        <br>
        <input type="text" name="fechaEmision" id="fechaEmision" placeholder="AAAA-MM-DD">
        <br>
        <label for="Remedio_id" class="menor-longitud">Id remedio</label><b>*</b>
        <input type="text" name="Remedio_id" id="Remedio_id">

        <label for="Paciente_id" class="menor-longitud">Id paciente</label><b>*</b>
        <input type="text" name="Paciente_id" id="Paciente_id">

        <label for="Medico_id" class="menor-longitud">Id médico</label><b>*</b>
        <input type="text" name="Medico_id" id="Medico_id">

        <input type="submit" value="Guardar">
    </form>

    <div class="formulario-receta">
        <form action="<?= base_url()?>/RemedioRecetaController" method="post">
            <div class="input-group">
                <label for="remedio_id">Remedio</label>
                <input type="number" id="remedio_id" name="remedio_id" required><br><br>
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