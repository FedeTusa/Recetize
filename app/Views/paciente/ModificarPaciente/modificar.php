<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recetize</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="<?= base_url('css/style.css?v=' . time()) ?>" rel="stylesheet">
</head>
<body class="body_inicio">
  <div class="barra-header"></div>
  <div class="barra-footer"></div>
  <div class="container_principal">
    <div class="indice">
      <div class="recetize" onclick="window.location.href='http://recetize.test/index.php/pagprincipal'">RECETIZE</div>
    </div>
    <div class="options">
      <div class="row">
        <div class="option-select">
          Paciente</div>
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio'">
          Remedio</div>
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/medico'">
          Medico</div>
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/receta'">
          Receta</div>
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/historial'">
          Historial</div>
        <div class="option2" id="salir" >
          Salir</div>
      </div>
    </div>
    <div class="container_inicio">
      <div class="sub_menu">
              <div class="lista">
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/paciente/nuevo'">
                  Cargar</div>
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/paciente/buscar'">
                  Buscar</div>
                <div class="option-select-lista divisor" >
                  Modificar</div>
                <div class="option-lista divisor2" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/paciente/eliminar'">
                  Eliminar</div>
              </div>
      </div>

      <div id="search-form1">
        <form class="form-container">
                <div class="form-grupo">
                  <div class="input-groupo">
                    <input type="text" id="Paciente_DNI" name="Paciente_DNI" class="input">
                    <label for="Paciente_DNI" class="label">DNI</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="nombre" name="nombre" class="input" >
                    <label for="nombre" class="label">Nombre</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="apellido" name="apellido" class="input">
                    <label for="apellido" class="label">Apellido</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="obrasocial" name="obrasocial" class="input" >
                    <label for="obrasocial" class="label">Obra Social</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="nroafiliado" name="nroafiliado" class="input">
                    <label for="nroafiliado" class="label">Nro Afiliado</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="localidad" name="localidad" class="input">
                    <label for="localidad" class="label">Localidad</label>
                  </div>
                  <button type="submit" class="busqueda">
                      <img src="<?= base_url('img/lupa.png'); ?>" alt="logo" class="lupa">
                  </button>
                </div>
        </form>
  </div>
    <div id="muestra-paciente" class="tabla"></div>
    <div id="pagination-controls" class="pagination-container"></div>
</div>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<script>
        document.querySelectorAll('.input').forEach(input => {
            input.addEventListener('input', () => {
                if (input.value) {
                    input.classList.add('valid');
                } else {
                    input.classList.remove('valid');
                }
            });

            // Para mantener la animación si el campo ya está lleno al cargar la página
            if (input.value) {
                input.classList.add('valid');
            }
        });

        $(document).ready(function() {
            // Cargar todos los pacientes al iniciar la página
            let currentPage = 1;
            cargarPacientes();

            $('#Paciente_DNI').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/paciente',
                        dataType: 'json',
                        data: {
                            busquedaDNI: request.term
                        },
                        success: function(data) {
                          let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.dni]) {
                                return false;
                            } else {
                                uniqueItems[item.dni] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 6);

                            response($.map(filteredData, function(item) {
                                return {
                                    label: item.dni,
                                    value: item.id,
                                    dni: item.dni,
                                };
                            }));
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#Paciente_DNI').val(ui.item.dni);
                    $('#Paciente_id_hidden').val(ui.item.value);
                    return false;
                }
            });

            $('#nroafiliado').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/paciente',
                        dataType: 'json',
                        data: {
                            busquedaNroafiliado: request.term
                        },
                        success: function(data) {
                          let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.nroafiliado]) {
                                return false;
                            } else {
                                uniqueItems[item.nroafiliado] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 6);

                            response($.map(filteredData, function(item) {
                                return {
                                    label: item.nroafiliado,
                                    nroafiliado: item.nroafiliado,
                                };
                            }));
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#nroafiliado').val(ui.item.nroafiliado);
                    return false;
                }
            });

            $('#obrasocial').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/paciente',
                        dataType: 'json',
                        data: {
                            busquedaObrasocial: request.term
                        },
                        success: function(data) {
                          let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.obrasocial]) {
                                return false;
                            } else {
                                uniqueItems[item.obrasocial] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 6);

                            response($.map(filteredData, function(item) {
                                return {
                                    label: item.obrasocial,
                                    obrasocial: item.obrasocial,
                                };
                            }));
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#obrasocial').val(ui.item.obrasocial);
                    return false;
                }
            });

            $('#localidad').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/paciente',
                        dataType: 'json',
                        data: {
                            busquedaLocalidad: request.term
                        },
                        success: function(data) {
                          let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.localidad]) {
                                return false;
                            } else {
                                uniqueItems[item.localidad] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 6);

                            response($.map(filteredData, function(item) {
                                return {
                                    label: item.localidad,
                                    localidad: item.localidad,
                                };
                            }));
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#localidad').val(ui.item.localidad);
                    return false;
                }
            });


            // Manejador del evento submit del formulario
            $('.form-container').on('submit', function(e) {
                e.preventDefault();
                const pacienteDNI = $('#Paciente_DNI').val();
                const pacienteNombre = $('#nombre').val();
                const pacienteApellido = $('#apellido').val();
                const pacienteNroafiliado = $('#nroafiliado').val();
                const pacienteObrasocial = $('#obrasocial').val();
                const pacienteLocalidad = $('#localidad').val();
                cargarPacientes(pacienteDNI, pacienteNombre, pacienteApellido, pacienteNroafiliado, pacienteObrasocial, pacienteLocalidad);
            });

            function cargarPacientes(dni = '', nombre = '', apellido = '', nroafiliado = '', obrasocial = '', localidad = '') {
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost:8000/api/pacientepag',
                    dataType: 'json',
                    data: {
                        busquedaDNI: dni,
                        busquedaNombre: nombre,
                        busquedaApellido: apellido,
                        busquedaNroafiliado: nroafiliado,
                        busquedaObrasocial: obrasocial,
                        busquedaLocalidad: localidad,
                        limit: 8, // Número de registros por página
                        page: currentPage // Página actual
                    },
                    success: function(data) {
                        mostrarPacientes(data.data); // Muestra los pacientes
                        mostrarPaginacion(data.total, data.per_page, dni, nombre, apellido, nroafiliado, obrasocial, localidad); // Muestra la paginación
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error en la solicitud:", textStatus, errorThrown);
                    }
                });
            }

function mostrarPaginacion(total, perPage, dni, nombre, apellido, nroafiliado, obrasocial, localidad) {
    const totalPages = Math.ceil(total / perPage);
    let paginationHTML = '<ul class="pagination">';
    const maxVisiblePages = 3; // Número máximo de páginas visibles
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, currentPage + Math.floor(maxVisiblePages / 2));

    // Ajustar el rango para garantizar que siempre se muestren 3 páginas al cargar
    if (endPage - startPage + 1 < maxVisiblePages) {
        if (startPage === 1) {
            endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        } else if (endPage === totalPages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }
    }

    // Mostrar "Página Anterior"
    if (currentPage > 10) {
        paginationHTML += `<li class="page-item">
                              <a class="page-link" href="#"><<</a>
                           </li>`;
    }

    // Mostrar el primer enlace si es necesario
    if (startPage > 2) {
        paginationHTML += `<li class="page-item"><a class="page-link" href="#">1</a></li>`;
        if (startPage > 3) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">|</span></li>`;
        }
    }

    // Mostrar las páginas visibles
    for (let i = startPage; i <= endPage; i++) {
        paginationHTML += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                              <a class="page-link" href="#">${i}</a>
                           </li>`;
    }

    // Mostrar el último enlace si es necesario
    if (endPage < totalPages - 1) {
        if (endPage < totalPages - 2) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">|</span></li>`;
        }
        paginationHTML += `<li class="page-item"><a class="page-link" href="#">${totalPages}</a></li>`;
    }

    // Mostrar "Página Siguiente"
    if (totalPages > 10 & currentPage < totalPages - 10) {
        paginationHTML += `<li class="page-item">
                              <a class="page-link" href="#">>></a>
                           </li>`;
    }

    paginationHTML += '</ul>';
    $('#pagination-controls').html(paginationHTML);

    // Asignar eventos de clic a los enlaces de paginación
    $('.pagination a').on('click', function (e) {
        e.preventDefault();
        const clickedPage = $(this).text();

        if (clickedPage === '<<') {
            currentPage = Math.max(1, currentPage - 10);
        } else if (clickedPage === '>>') {
            currentPage = Math.min(totalPages, currentPage + 10);
        } else if (!isNaN(clickedPage)) {
            currentPage = parseInt(clickedPage);
        }

        // Recargar los médicos manteniendo los términos de búsqueda
        cargarPacientes(dni, nombre, apellido, nroafiliado, obrasocial, localidad);
    });
}

            function mostrarPacientes(pacientes) {
                const divTabla = $('#muestra-paciente');
                divTabla.empty(); // Limpiar el contenido anterior

                if (pacientes.length > 0) {
                    let tabla = `<table class="style_table">
                                    <thead>
                                        <tr>
                                            <th>DNI</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Obra Social</th>
                                            <th>Nro Afiliado</th>
                                            <th>Provincia</th>
                                            <th>Localidad</th>
                                            <th>C.P.</th>
                                            <th>Calle</th>
                                            <th>Altura</th>
                                            <th>Telefono</th>
                                            <th>Email</th>
                                            <th>Modificar</th>
                                            </tr>
                                    </thead>
                                    <tbody>`;

                    pacientes.forEach(paciente => {
                        tabla += `<tr class="style_table">
                                    <td>${paciente.dni}</td>
                                    <td>${paciente.nombre}</td>
                                    <td>${paciente.apellido}</td>
                                    <td>${paciente.obrasocial || ''}</td>
                                    <td>${paciente.nroafiliado || ''}</td>
                                    <td>${paciente.provincia || ''}</td>
                                    <td>${paciente.localidad || ''}</td>
                                    <td>${paciente.cp || ''}</td>
                                    <td>${paciente.calle || ''}</td>
                                    <td>${paciente.altura || ''}</td>
                                    <td>${paciente.prefijo || '0'}-${paciente.celular || ''}</td>
                                    <td>${paciente.email || '-'}</td>
                                     <td><a href="editar?id=${paciente.id}" class="img-center"><img src="<?= base_url('img/edit.png?v=' . time() ); ?>" alt="logo" class="img-action""></a></td>
                                </tr>`;
                    });

                    tabla += `</tbody></table>`;
                    divTabla.html(tabla);
                } else {
                    divTabla.html("<p>No se encontraron pacientes.</p>");
                }
            }
          });
</script>
<script type="module">

        import {
                    initializeApp
                } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js";

        import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, signOut, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-auth.js";

        //Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBakDzF3H0gku4gD--uUU2K-30BIpiT1Yo",
            authDomain: "recetize-8673b.firebaseapp.com",
            projectId: "recetize-8673b",
            storageBucket: "recetize-8673b.appspot.com",
            messagingSenderId: "785480675848",
            appId: "1:785480675848:web:fa6aaa899d8f66f56917bd"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);

        // Initialize Firebase Authentication and get a reference to the service
        const auth = getAuth(app); 

    

   // <!-- CUSTOM CODE -->
// REGISTRO____________________________________________________________________
        console.log('hello word')

        const logout = document.querySelector('#salir');

        logout.addEventListener('click', (e) => {
            e.preventDefault();

            signOut(auth).then(() => {
                console.log('sing out')
            })

        })

        onAuthStateChanged(auth, (user) => {
            if (user) {
                    console.log('singin')
                
            } else {
              window.location.href = 'http://recetize.test';
            }
        });

</script>
