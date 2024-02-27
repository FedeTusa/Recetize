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
            background-color: #c0e7c8;
            /* Color verde más oscuro para encabezado de tabla */
            color: #000;
        }

        #back {
            float: right;
            margin-top: -40px;
            margin-right: 20px;

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
            background-color: #ccc;
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
            background-color: #a5d8b9;
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

        .delete-button {
            background-color: #F08080;
            color: #fff;
            padding: 10px 15px;
            font-size: 15px;
            border: none;
            border-radius: 20%;
            position: relative;
            left: 50px;
        }

        .delete-button:hover {
            background-color: #B22222;
            color: #fff;
            cursor: pointer;
        }

        .no-encontrado {
            font-size: 20px;
        }


    /* Estilo para el modal*/

    .modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    overflow: auto; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
    }

    .modal-content {
    background-color: #fefefe;
    margin: 10% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    border-radius: 15px; 
    }

    .button-container {
    text-align: center;
    }

    .button-container button {
    margin: 5px;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 15px;
    }

    .button-container button:hover {
    background-color: #a5d8b9;
    }

    .button-container .cancelar-borrado:hover {
    background-color: #F08080;
    }

    /* Fin de los estilos del modal */

    </style>
</head>

<body>
    <h1>Eliminacion de Recetas</h1>
    
    <a href="http://recetize.test/pagprincipal" class="back-button">
        <button>Atrás</button>
    </a>

    <div id="search-form">
    <form class="form-container">
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
        </div>

        <!-- Segunda fila con dos campos -->
        <div class="input-group">
            <div class="campo-busqueda">
                <label for="Paciente_id">Paciente:</label>
                <input type="text" id="Paciente_id" name="Paciente_id">
                <input type="hidden" id="Paciente_id_hidden" name="Paciente_id_hidden">
            </div>
            <div class="campo-busqueda">
                <label for="Medico_id">Médico:</label>
                <input type="text" id="Medico_id" name="Medico_id">
                <input type="hidden" id="Medico_id_hidden" name="Medico_id_hidden">
            </div>
        </div>
        <button type="submit">Buscar</button>
    </form>
</div>


    <div id="muestra-recetas">
        <?php if (!empty($todasLasRecetas)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Nro Receta</th>
                        <th>Fecha Emisión</th>
                        <th>Remedios</th>
                        <th>Paciente</th>
                        <th>Medico</th>
                        <th>Eliminar receta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($todasLasRecetas as $receta) : ?>
                        <tr>
                            <td><?php echo $receta['nroReceta']; ?></td>
                            <td><?php echo modificarFecha($receta['fechaEmision']); ?></td>
                            <td><?php 
                            $remedioreceta = model('App\Models\RemedioRecetaModel');
                            $remediosdereceta = $remedioreceta->remediosDeReceta($receta['id']);
                            $remedios = json_decode($remediosdereceta, true);
                            foreach ($remedios as $remedio) {echo $remedio['droga'] . "<br>";}
                            ?></td>
                            <td><?php echo $receta['Paciente_id']; ?></td>
                            <td><?php echo $receta['Medico_id']; ?></td>
                            <td>
                            <button class="delete-button" onclick="eliminarReceta(<?php echo $receta['id']; ?>, <?php echo $receta['nroReceta']; ?>)">X</button>

                            </td>                    
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No se encontraron recetas.</p>
        <?php endif; ?>
    </div>

</body>

</html>

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
</script>

<script>

    formulario = document.querySelector(".form-container");
    divTabla = document.getElementById("muestra-recetas");

    formulario.addEventListener("submit", async function(e) {
        e.preventDefault();
        tabla = divTabla.children[0];
        divTabla.removeChild(tabla);

        const nroReceta = document.getElementById("nroReceta").value;
        const fechaEmision = document.getElementById("fechaEmision").value;
        const idPaciente = document.getElementById("Paciente_id_hidden").value;
        document.getElementById("Paciente_id_hidden").value = "";
        const idMedico = document.getElementById("Medico_id_hidden").value;
        document.getElementById("Medico_id_hidden").value = "";

        try {
            const resultadoBusqueda = await realizarBusqueda(nroReceta, fechaEmision, idPaciente, idMedico);
            let recetas = JSON.parse(resultadoBusqueda);
            if (recetas.length >= 1 && hayRecetasParaMostrar(recetas)) {
                nuevaTabla = document.createElement("TABLE");
                header = document.createElement("THEAD");
                header.innerHTML = `<tr>
                                        <th>Nro Receta</th>
                                        <th>Fecha Emisión</th>
                                        <th>Remedios</th>
                                        <th>Paciente</th>
                                        <th>Medico</th>
                                        <th>Eliminar receta</th>
                                    </tr>`
                nuevaTabla.appendChild(header);
                bodyTabla = document.createElement("TBODY");

                for (let receta of recetas) {
                    if (!receta["borrado_logico"]) {
                        let fechaMod = modificarFecha(receta['fechaEmision']);
                        let paciente = JSON.parse(await obtenerPaciente(receta));
                        let nombrePaciente = paciente['nombre'] + " " + paciente['apellido'];
                        receta['Paciente_id'] = nombrePaciente;
                        let medico = JSON.parse(await obtenerMedico(receta));
                        let nombreMedico = medico['nombre'] + " " + medico['apellido'];
                        receta['Medico_id'] = nombreMedico;
                        let remedios = JSON.parse(await obtenerRemedios(receta['id']));
                        let camposTabla = `<tr>
                                                    <td>${receta['nroReceta']}</td>
                                                    <td>${fechaMod}</td>
                                                    <td>`
                        for (remedio of remedios) {
                            camposTabla += `${remedio['droga']}<br>`
                        } 
                        camposTabla += `</td>`
                        camposTabla += `<td>${receta['Paciente_id']}</td>
                                        <td>${receta['Medico_id']}</td>
                                        <td><button class="delete-button" onclick="eliminarReceta(${receta["id"]}, ${receta['nroReceta']})">X</button></td>
                                        </tr>`
                        bodyTabla.innerHTML += camposTabla;
                    
                        nuevaTabla.appendChild(bodyTabla);
                        divTabla.appendChild(nuevaTabla);
                    }
                }
            } else {
                mensaje = document.createElement("P");
                mensaje.classList.add("no-encontrado");
                mensaje.innerHTML = "No se encontraron recetas";
                divTabla.appendChild(mensaje);
            }

        } catch (error) {
            console.error('Error en la búsqueda:', error);
        }

        
    });

    function eliminarReceta(idReceta, nroReceta) {
        confirmarBorrado(nroReceta).then(function(resultado) {
            if (resultado) {
                let url = "http://recetize.test/pagprincipal/eliminarReceta/" + idReceta;

                const xhr = new XMLHttpRequest();
                xhr.addEventListener("load", () => {
                    let respuesta;
                    if (xhr.status == 200) {
                        alert("Receta eliminada con exito");
                        location.reload();
                    } 
                    else respuesta = console.log("No pudo realizarse el post");
                })
                xhr.open('POST', url, true);
                xhr.send();
            }
        });   
    }

    function hayRecetasParaMostrar(recetas) {
        let contador = 0;

        for (receta of recetas) {
            if (!receta["borrado_logico"]) contador++;
        }

        if (contador != 0) return true;
        else return false;
    }

    function modificarFecha(fecha) {
        let arrayFecha = fecha.split("-");
        let fechaModificada = arrayFecha[2] + "/" + arrayFecha[1] + "/" + arrayFecha[0];

        return fechaModificada;
    }

    function realizarBusqueda(nroReceta, fechaEmision, paciente_id, medico_id) {
        return new Promise((resolve, reject) => {
            let url = 'http://localhost:8000/busqueda/receta?';
            if (nroReceta) url += 'nroReceta=' + encodeURIComponent(nroReceta) + '&';
            if (fechaEmision) url += 'fechaEmision=' + encodeURIComponent(fechaEmision) + '&';
            if (paciente_id) url += 'paciente_id=' + encodeURIComponent(paciente_id) + '&';
            if (medico_id) url += 'medico_id=' + encodeURIComponent(medico_id);
            url = url.replace(/&$/, '');

            const xhr = new XMLHttpRequest();
            xhr.open('GET', url);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    resolve(xhr.responseText);
                } else {
                    console.error('Error en la solicitud');
                    reject(xhr.status);
                }
            };
            xhr.onerror = function() {
                console.error('Error en la solicitud');
                reject(xhr.status);
            };
            xhr.send();
        });
    }

    function obtenerPaciente(receta) {
            return new Promise((resolve, reject) => {

                let url = 'http://localhost:8000/paciente/' + receta['Paciente_id'];

                const xhr = new XMLHttpRequest();
                xhr.open('GET', url);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        resolve(xhr.responseText);
                    } else {
                        console.error('Error en la solicitud');
                        reject(xhr.status);
                    }
                };
                xhr.onerror = function() {
                    console.error('Error en la solicitud');
                    reject(xhr.status);
                };
                xhr.send();
        });
    }
    

    function obtenerMedico(receta) {
            return new Promise((resolve, reject) => {

                let url = 'http://localhost:8000/medico/' + receta['Medico_id'];

                const xhr = new XMLHttpRequest();
                xhr.open('GET', url);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        resolve(xhr.responseText);
                    } else {
                        console.error('Error en la solicitud');
                        reject(xhr.status);
                    }
                };
                xhr.onerror = function() {
                    console.error('Error en la solicitud');
                    reject(xhr.status);
                };
                xhr.send();
        });
    }

    function obtenerRemedios(idReceta) {
            return new Promise((resolve, reject) => {

                let url = 'http://localhost:8000/busqueda/remedioreceta?busqueda=' + idReceta;

                const xhr = new XMLHttpRequest();
                xhr.open('GET', url);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        resolve(xhr.responseText);
                    } else {
                        console.error('Error en la solicitud');
                        reject(xhr.status);
                    }
                };
                xhr.onerror = function() {
                    console.error('Error en la solicitud');
                    reject(xhr.status);
                };
                xhr.send();
        });
    }

    function confirmarBorrado(nroReceta) {
        var existingModal = document.getElementById("deleteConfirmationModal");
        
        // Si ya existe un modal, borrarlo
        if (existingModal) {
            existingModal.parentNode.removeChild(existingModal);
        }

        // Crear el modal
        var modal = document.createElement("div");
        modal.id = "deleteConfirmationModal";
        modal.className = "modal";
        var modalContent = document.createElement("div");
        modalContent.className = "modal-content";
        var title = document.createElement("h2");
        title.textContent = "¿Estás seguro que deseas borrar la receta nro = " + nroReceta + "?";
        var buttonContainer = document.createElement("div");
        buttonContainer.className = "button-container";
        var confirmBtn = document.createElement("button");
        confirmBtn.id = "confirmDeleteBtn";
        confirmBtn.textContent = "Aceptar";
        var cancelBtn = document.createElement("button");
        cancelBtn.id = "cancelDeleteBtn";
        cancelBtn.classList.add("cancelar-borrado");
        cancelBtn.textContent = "Cancelar";
        buttonContainer.appendChild(confirmBtn);
        buttonContainer.appendChild(cancelBtn);
        modalContent.appendChild(title);
        modalContent.appendChild(buttonContainer);
        modal.appendChild(modalContent);
        document.body.appendChild(modal);

        // Mostrar el modal
        modal.style.display = "block";

        return new Promise(function(resolve, reject) {
            // Manejadores de eventos para los botones
            document.getElementById("confirmDeleteBtn").onclick = function() {
                modal.style.display = "none";
                resolve(true); // Resuelve la promesa con true si el usuario confirma
            };

            document.getElementById("cancelDeleteBtn").onclick = function() {
                modal.style.display = "none";
                resolve(false); // Resuelve la promesa con false si el usuario cancela
            };

            // También cerrar el modal si el usuario hace clic fuera de él
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    resolve(false); // Resuelve la promesa con false si el usuario hace clic fuera del modal
                }
            };
        });
    }

</script>