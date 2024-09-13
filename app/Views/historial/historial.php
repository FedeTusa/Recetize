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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="body_inicio">
  <!-- Modal de Confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirmar eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí se actualizará el texto con la información del paciente -->
      </div>
      <div class="form_error_delete" role="alert"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
      </div>
    </div>
  </div>
</div>
  <div class="barra-header"></div>
  <div class="barra-footer"></div>
  <div class="container_principal">
    <div class="indice">
      <div class="recetize" onclick="window.location.href='http://recetize.test/index.php/pagprincipal'">RECETIZE</div>
    </div>
    <div class="options">
      <div class="row">
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/paciente'">
          Paciente</div>
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio'">
          Remedio</div>
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/medico'">
          Medico</div>
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/receta'">
          Receta</div>
        <div class="option-select" >
          Historial</div>
        <div class="option2" id="salir" >
          Salir</div>
      </div>
    </div>
    <div class="container_inicio">
    <div id="search-form1">
        <form id="searchForm" class="form-container">
            <div class="form-grupo4">
                <div class="input-groupo">
                    <!-- <label for="fechaRango">Rango de Fechas:</label> -->
                    <input type="text" id="fechaRango" name="fechaRango" class="input" />
                </div>
                <div class="input-groupo">
                    <input type="text" id="accion" name="accion" class="input">
                    <label for="accion" class="label">Acción</label>
                </div>
                <div class="input-groupo">
                    <input type="text" id="tipo" name="tipo" class="input">
                    <label for="tipo" class="label">Tipo</label>
                </div>
                 <button type="submit" class="busqueda">
                    <img src="<?= base_url('img/lupa.png'); ?>" alt="logo" class="lupa">
                </button>
            </div>
        </form>
    </div>
    <div id="muestra-historial" class="tabla"></div>
    <div id="pagination-controls" class="pagination-controls"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
        let currentPage = 1;

        $(document).ready(function() {

          $('#accion').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/historial', // Cambia la URL según tu API
                        dataType: 'json',
                        data: {
                            busquedaAccion: request.term
                        },
                        success: function(data) {
                            let uniqueItems = {};
                            let filteredData = data.filter(item => {
                                if (uniqueItems[item.accion]) {
                                    return false;
                                } else {
                                    uniqueItems[item.accion] = true;
                                    return true;
                                }
                            });
                            filteredData = filteredData.slice(0, 6);

                            response($.map(filteredData, function(item) {
                                return {
                                    label: item.accion,
                                    value: item.accion // Puedes usar un valor diferente si es necesario
                                };
                            }));
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#accion').val(ui.item.value);
                    return false;
                }
            });

            // Autocompletado para el campo de Tipo
          $('#tipo').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/historial', // Cambia la URL según tu API
                        dataType: 'json',
                        data: {
                            busquedaTipo: request.term
                        },
                        success: function(data) {
                            let uniqueItems = {};
                            let filteredData = data.filter(item => {
                                if (uniqueItems[item.tipo]) {
                                    return false;
                                } else {
                                    uniqueItems[item.tipo] = true;
                                    return true;
                                }
                            });
                            filteredData = filteredData.slice(0, 6);

                            response($.map(filteredData, function(item) {
                                return {
                                    label: item.tipo,
                                    value: item.tipo // Puedes usar un valor diferente si es necesario
                                };
                            }));
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#tipo').val(ui.item.value);
                    return false;
                }
            });

          $.ajax({
                url: 'http://localhost:8000/api/recetafechamin', // Endpoint de tu API para obtener la fecha más antigua
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    const fechaMinima = response.fechaMinima; // Suponiendo que la API devuelve un objeto con la fecha más antigua

                    // Inicializar el daterangepicker con la fecha mínima como fecha de inicio
                    const fechaMinimaFormateada = moment(fechaMinima).format('DD-MM-YYYY');
                    $('#fechaRango').daterangepicker({
                        locale: {
                            format: 'DD-MM-YYYY',
                            separator: ' - ',
                            applyLabel: 'Aplicar',
                            cancelLabel: 'Cancelar',
                            fromLabel: 'De',
                            toLabel: 'Hasta',
                            customRangeLabel: 'Rango personalizado',
                            weekLabel: 'Sem',
                            daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                            firstDay: 1
                        },
                        startDate: fechaMinimaFormateada, // Fecha de inicio predeterminada
                        endDate: moment().endOf('month').format('DD-MM-YYYY') // Fecha de fin predeterminada
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error en la solicitud:", textStatus, errorThrown);
                }
            });

            cargarHistorial(); // Cargar historial al iniciar

            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                const fechaRango = $('#fechaRango').data('daterangepicker');
                const fechaInicio = fechaRango ? fechaRango.startDate.format('YYYY-MM-DD') : '';
                const fechaFin = fechaRango ? fechaRango.endDate.format('YYYY-MM-DD') : '';
                cargarHistorial(
                    fechaInicio, // Fecha inicio
                    fechaFin, // Fecha fin
                    $('#accion').val(),
                    $('#tipo').val()
                );
            });
        });



        function cargarHistorial(fechaInicio = '', fechaFin = '', accion = '', tipo = '') {
            $.ajax({
                type: 'GET',
                url: 'http://localhost:8000/api/historialpag',
                dataType: 'json',
                data: {
                    busquedaFechaInicio: fechaInicio,
                    busquedaFechaFin: fechaFin,
                    busquedaAccion: accion,
                    busquedaTipo: tipo,
                    limit: 10,
                    page: currentPage
                },
                success: function(data) {
                    mostrarHistorial(data.data);
                    mostrarPaginacion(data.total, data.per_page, fechaInicio, fechaFin, accion, tipo);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error en la solicitud:", textStatus, errorThrown);
                }
            });
        }

        function mostrarHistorial(historiales) {
            const divTabla = $('#muestra-historial');
            divTabla.empty();

            if (historiales.length > 0) {
                let tabla = `<table class="style_table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Acción</th>
                                        <th>Tipo</th>
                                        <th>Datos</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                historiales.forEach(historial => {
                    tabla += `<tr class="style_table">
                                <td>${historial.fecha}</td>
                                <td>${historial.accion}</td>
                                <td>${historial.tipo}</td>
                                <td>${historial.datos}</td>
                              </tr>`;
                });

                tabla += `</tbody></table>`;
                divTabla.html(tabla);
            } else {
                divTabla.html("<p>No hay historial.</p>");
            }
        }

        function mostrarPaginacion(total, perPage, fechaInicio, fechaFin, accion, tipo) {
    const totalPages = Math.ceil(total / perPage);
    let paginationHTML = '<ul class="pagination1">';
    const maxVisiblePages = 3;
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
        paginationHTML += `<li class="page-item1">
                              <a class="page-link1" href="#"><<</a>
                           </li>`;
    }

    // Mostrar el primer enlace si es necesario
    if (startPage > 2) {
        paginationHTML += `<li class="page-item1"><a class="page-link1" href="#">1</a></li>`;
        if (startPage > 3) {
            paginationHTML += `<li class="page-item1 disabled"><span class="page-link1">|</span></li>`;
        }
    }

    // Mostrar las páginas visibles
    for (let i = startPage; i <= endPage; i++) {
        paginationHTML += `<li class="page-item1 ${i === currentPage ? 'active' : ''}">
                              <a class="page-link1" href="#">${i}</a>
                           </li>`;
    }

    // Mostrar el último enlace si es necesario
    if (endPage < totalPages - 1) {
        if (endPage < totalPages - 2) {
            paginationHTML += `<li class="page-item1 disabled"><span class="page-link1">|</span></li>`;
        }
        paginationHTML += `<li class="page-item1"><a class="page-link1" href="#">${totalPages}</a></li>`;
    }

    // Mostrar "Página Siguiente"
    if (totalPages > 10 & currentPage < totalPages - 10) {
        paginationHTML += `<li class="page-item1">
                              <a class="page-link1" href="#">>></a>
                           </li>`;
    }

    paginationHTML += '</ul>';
    $('#pagination-controls').html(paginationHTML);

    // Asignar eventos de clic a los enlaces de paginación
    $('.pagination1 a').on('click', function (e) {
        e.preventDefault();
        const clickedPage = $(this).text();

        if (clickedPage === '<<') {
            currentPage = Math.max(1, currentPage - 10);
        } else if (clickedPage === '>>') {
            currentPage = Math.min(totalPages, currentPage + 10);
        } else if (!isNaN(clickedPage)) {
            currentPage = parseInt(clickedPage);
        }


                cargarHistorial(fechaInicio, fechaFin, accion, tipo);
            });
        }
    </script>
</body>

</html>

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