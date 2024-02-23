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
            font-size: 15px;
        }

        input#fechaEmision {
            width: 45%;
            font-size: 15px;
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

        .form-container .formulario-receta:first-child {
        margin-top: 0; 
    }

        .formulario-receta label,
        .formulario-receta input[type="number"] {
            display: block;
        }

        .formulario-receta input[type="number"] {
            width: calc(75% - 20px);
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .formulario-receta input[type="button"] {
            background-color: #ccc;
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            display: inline-block;
            width: calc(25% - 20px);
            vertical-align: top;
        }

        .formulario-receta input[type="submit"]:hover {
            background-color: #a5d8b9;
        }

        .label-paciente {
            margin-top: 20px;
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

    <form class="form-container">
        <label for="nroReceta" class="menor-longitud">Número de receta</label><b>*</b>
        <br>
        <input type="number" name="nroReceta" id="nroReceta">
        <br>
        <label for="fechaEmision" class="menor-longitud">Fecha de emisión</label><b>*</b>
        <br>
        <input type="text" name="fechaEmision" id="fechaEmision" placeholder="AAAA-MM-DD">
        <br>
        <div class="formulario-receta envio-remedioReceta">
            <label for="remedio_id_0">Remedio<b>*</b></label>
            <input type="text" id="remedio_id_0" name="remedio_id" required>
            <input type="hidden" name="remedio_id" id="remedio_id_hidden_0">
            <input type="button" value="+" class="remedio-receta">  
        </div>
        <br><br>
        <label for="Paciente_id" class="menor-longitud label-paciente">DNI paciente</label><b>*</b>
        <input type="text" name="Paciente_id" id="Paciente_id">
        <input type="hidden" id="Paciente_id_hidden" name="Paciente_id_hidden">

        <label for="Medico_id" class="menor-longitud">Matrícula médico</label><b>*</b>
        <input type="text" name="Medico_id" id="Medico_id">
        <input type="hidden" id="Medico_id_hidden" name="Medico_id_hidden">

        <input type="submit" value="Guardar" class="guardado">
    </form>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#Paciente_id').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: 'http://localhost:8000/busqueda/paciente',
                        dataType: 'json',
                        data: {
                            busqueda: request.term
                        },
                        success: function(data) {
                            console.log("Datos recibidos:", data);
                            response($.map(data, function(item) {
                                console.log(item);
                                return {
                                    label: item.dni,
                                    value: item.id,
                                    dni: item.dni,
                                    nombre: item.nombre,
                                    apellido: item.apellido
                                };
                            }));
                        }
                    });
                },
                select: function(event, ui) {
                    console.log("Item seleccionado:", ui.item);
                    $('#Paciente_id').val(ui.item.dni + ', ' + ui.item.nombre + ' ' + ui.item.apellido);
                    $('#Paciente_id_hidden').val(ui.item.value);
                    return false;
                }
            });
        });

        $(document).ready(function() {
            $('#Medico_id').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: 'http://localhost:8000/busqueda/medico',
                        dataType: 'json',
                        data: {
                            busqueda: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.matricula,
                                    value: item.id,
                                    matricula: item.matricula,
                                    nombre: item.nombre,
                                    apellido: item.apellido
                                };
                            }));
                        }
                    });
                },
                select: function(event, ui) {
                    $('#Medico_id').val(ui.item.matricula + ', ' + ui.item.nombre + ' ' + ui.item.apellido);
                    $('#Medico_id_hidden').val(ui.item.value);
                    return false;
                }
            });
        });

        $(document).ready(function() {
            $('#remedio_id_0').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: 'http://localhost:8000/busqueda/remedio',
                        dataType: 'json',
                        data: {
                            busqueda: request.term
                        },
                        success: function(data) {
                            //console.log("Datos recibidos:", data);
                            response($.map(data, function(item) {
                                return {
                                    label: item.codigo,
                                    value: item.id,
                                    codigo: item.codigo,
                                    medicamento: item.medicamento
                                };
                            }));
                        }
                    });
                },
                select: function(event, ui) {
                    $('#remedio_id_0').val(ui.item.codigo + ' ' + ui.item.medicamento);
                    $('#remedio_id_hidden_0').val(ui.item.value);
                    return false;
                }
            });
        });
    </script>

    <script>
        let contadorFormularios = 0;
        const formulario = document.querySelector(".form-container");
        //console.log(ui.item.value);
        formulario.addEventListener("click", function(e) {
            if (e.target && e.target.classList.contains("remedio-receta")) {
                e.preventDefault();
                const formRemedio = e.target.parentElement;
                const boton = e.target;
                formRemedio.removeChild(boton);
                const lista = crearNuevoFormulario();
                const nuevoFormulario = lista[0];
                const nroFormulario = lista[1];
                formulario.insertBefore(nuevoFormulario, document.querySelector(".label-paciente"));
                const intermedia = nroFormulario-1;
                const idDelInput = "remedio_id_hidden_" + intermedia;
                const remedio_id = document.getElementById(idDelInput).value;
                console.log(remedio_id);
                debugger;
                hacerPostRemedio(remedio_id);

            } else if (e.target && e.target.classList.contains("eliminar-remedioReceta")) {
                const formGeneral = e.target.parentElement.parentElement;
                const formRemedio = e.target.parentElement;
                const formAnterior = formRemedio.previousElementSibling.previousElementSibling.previousElementSibling;
                formGeneral.removeChild(formRemedio);
                if (formAnterior.children[1]) {
                    if  (formAnterior.children[1].getAttribute("id") == "remedio_id_hidden_0" && formAnterior.children.length < 3) {
                        const nuevoBoton = document.createElement("INPUT");
                        nuevoBoton.type =  "button";
                        nuevoBoton.value = "+";
                        nuevoBoton.classList.add("remedio-receta");
                        formAnterior.appendChild(nuevoBoton);
                    }

                }
                
            } else if (e.target && e.target.classList.contains("guardado")) {
                e.preventDefault();
                const idDelInput = "remedio_id_hidden" + contadorFormularios;
                //console.log(idDelInput);
                const remedio_id = document.getElementById(idDelInput).value;
                //console.log(remedio_id);
                hacerPostRemedio(remedio_id);
                const nroReceta = document.getElementById("nroReceta").value;
                const fechaEmision = document.getElementById("fechaEmision").value;
                const idPaciente = document.getElementById("Paciente_id_hidden").value;
                const idMedico = document.getElementById("Medico_id_hidden").value;
                let formatoData = new FormData();
                formatoData.append("nroReceta", nroReceta);
                formatoData.append("fechaEmision", fechaEmision);
                formatoData.append("Paciente_id", idPaciente);
                formatoData.append("Medico_id", idMedico);
                const xhr = new XMLHttpRequest();
                    xhr.addEventListener("load", ()=> {
                        let respuesta;
                        if (xhr.status == 200) respuesta = xhr.response;
                        else respuesta = "No pudo realizarse el post";
                    })
                    xhr.open('POST', 'http://recetize.test/RecetaController', true);
                    xhr.send(formatoData);
                    alert("Receta cargada con exito");
            }
        });

        function crearNuevoFormulario() {
            contadorFormularios++;
            const nuevoFormulario = document.createElement("DIV");
            nuevoFormulario.classList.add("formulario-receta");
            nuevoFormulario.classList.add("envio-remedioReceta");
            nuevoFormulario.innerHTML += '<label for="remedio_id_hidden' + contadorFormularios + '">Remedio<b>*</b></label>';
            $(document).ready(function() {
                $('#remedio_id_' + contadorFormularios).autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: 'http://localhost:8000/busqueda/remedio',
                            dataType: 'json',
                            data: {
                                busqueda: request.term
                            },
                            success: function(data) {
                                //console.log("Datos recibidos:", data);
                                response($.map(data, function(item) {
                                    return {
                                        label: item.codigo,
                                        value: item.id
                                    };
                                }));
                            }
                        });
                    },
                    select: function(event, ui) {
                        //console.log("Item seleccionado:", ui.item);
                        $('#remedio_id_' + contadorFormularios).val(ui.item.codigo + ' ' + ui.item.medicamento);
                        $('#remedio_id_hidden' + contadorFormularios).val(ui.item.value);
                        return false;
                    }
                });
            });
            const nuevoInput = document.createElement("INPUT");
            nuevoInput.type = "number";
            nuevoInput.setAttribute("id", "remedio_id_hidden" + contadorFormularios);
            nuevoInput.setAttribute("name", "remedio_id");
            nuevoInput.required = true;
            const nuevoBoton = document.createElement("INPUT");
            nuevoBoton.type =  "button";
            nuevoBoton.value = "+";
            nuevoBoton.classList.add("remedio-receta");
            const botonEliminar = document.createElement("INPUT");
            botonEliminar.type =  "button";
            botonEliminar.value = "-";
            botonEliminar.classList.add("eliminar-remedioReceta");
            botonEliminar.style.marginLeft = "10px";
            botonEliminar.style.backgroundColor = "#F76849";
            nuevoFormulario.appendChild(nuevoInput);
            nuevoFormulario.appendChild(nuevoBoton);
            nuevoFormulario.appendChild(botonEliminar);
            
            return [nuevoFormulario, contadorFormularios];
        }

        //Hacer la solicitud con post AJAX
        function hacerPostRemedio(id) {
            let formatoData = new FormData();
                formatoData.append("remedio_id", id);
                const xhr = new XMLHttpRequest();
                    xhr.addEventListener("load", ()=> {
                        let respuesta;
                        if (xhr.status == 200) respuesta = xhr.response;
                        else respuesta = "No pudo realizarse el post";
                        //console.log(respuesta);
                    })
                    xhr.open('POST', 'http://recetize.test/RemedioRecetaController/agregarRemedioTemporal', true);
                    xhr.send(formatoData);
        }   
    </script>

</body>

</html>


