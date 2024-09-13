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
        <div class="option-select" >
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
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/receta/nuevo'">
                  Cargar</div>
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/receta/buscar'">
                  Buscar</div>
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/receta/modificar'">
                  Modificar</div>
                <div class="option-select-lista divisor2" >
                  Eliminar</div>
              </div>
      </div>

      <div id="search-form1">
        <form class="form-container">
                <div class="form-grupo">
                  <div class="input-groupo">
                    <input type="text" id="nroReceta" name="nroReceta" class="input">
                    <label for="nroReceta" class="label">Nro Receta:</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="fechaRango" name="fechaRango" class="input">
                    <label for="fechaRango" class="label obli fechaEmision">Rango de Fecha</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="Paciente_DNI" name="Paciente_DNI" class="input">
                    <label for="Paciente_DNI" class="label">DNI del Paciente:</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="nroafiliado" name="nroafiliado" class="input">
                    <label for="nroafiliado" class="label">Nro de Afiliado:</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="obrasocial" name="obrasocial" class="input ">
                    <label for="obrasocial" class="label ">Obra Social:</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="Matricula" name="Matricula" class="input">
                    <label for="Matricula" class="label">Matricula Medico:</label>
                  </div>
                  <button type="submit" class="busqueda">
                      <img src="<?= base_url('img/lupa.png'); ?>" alt="logo" class="lupa">
                  </button>
                </div>
        </form>
  </div>

    <div id="muestra-recetas" class="tabla"></div>
    <div id="pagination-controls" class="pagination-container"></div>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

        $(document).ready(function() {

            let currentPage = 1;
            cargarRecetas();
                  // Configurar el evento submit para el formulario de filtrado
                  $('.form-container').on('submit', function(e) {
                      e.preventDefault();
                      const recetanroReceta = $('#nroReceta').val();
                      const fechaRango = $('#fechaRango').data('daterangepicker');
                      const fechaInicio = fechaRango ? fechaRango.startDate.format('YYYY-MM-DD') : '';
                      const fechaFin = fechaRango ? fechaRango.endDate.format('YYYY-MM-DD') : '';
                      const recetaPaciente_DNI = $('#Paciente_DNI').val();
                      const recetaNroafiliado = $('#nroafiliado').val();
                      const recetaObrasocial = $('#obrasocial').val();
                      const recetaMatricula = $('#Matricula').val();
                      cargarRecetas(recetanroReceta, fechaInicio, fechaFin, recetaPaciente_DNI, recetaNroafiliado, recetaObrasocial, recetaMatricula );
                  });

            $('#Paciente_DNI').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/receta', // Asegúrate de que la URL sea correcta
                        dataType: 'json',
                        data: {
                            paciente_id: request.term
                        },
                        success: function(data) {
                            // Extraer los DNIs de la estructura de datos
                            let dnIs = [];
                            data.forEach(function(item) {
                                if (item.paciente && item.paciente.dni) {
                                    dnIs.push(item.paciente.dni);
                                }
                            });

                            // Filtrar los DNIs únicos
                            let uniqueDnis = [...new Set(dnIs)];

                            // Formatear los datos para el autocompletado
                            response($.map(uniqueDnis, function(item) {
                                return {
                                    label: item, // DNI del paciente
                                    value: item  // DNI del paciente
                                };
                            }));
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                minLength: 1, // Número mínimo de caracteres para iniciar la búsqueda
                select: function(event, ui) {
                    // Acción a tomar cuando se selecciona un valor
                    $('#Paciente_DNI').val(ui.item.label);
                    return false;
                }
            });

            $('#nroReceta').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/receta',
                        dataType: 'json',
                        data: {
                            nroReceta: request.term
                        },
                        success: function(data) {
                            // Filtrar resultados para eliminar duplicados
                            let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.nroReceta]) {
                                return false;
                            } else {
                                uniqueItems[item.nroReceta] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 10);

                            response($.map(filteredData, function(item) {
                            return {
                                label: item.nroReceta,
                                nroReceta: item.nroReceta,
                            };
                        }));
                      },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#nroReceta').val(ui.item.nroReceta);
                    return false;
                }
            });

            $('#Matricula').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/receta',
                        dataType: 'json',
                        data: {
                            medico_id: request.term
                        },
                        success: function(data) {
                            let matriculas = [];
                            data.forEach(function(item) {
                                if (item.medico && item.medico.matricula) {
                                    matriculas.push(item.medico.matricula);
                                }
                            });

                            let uniquematriculas = [...new Set(matriculas)];

                            response($.map(uniquematriculas, function(item) {
                                return {
                                    label: item,
                                    value: item 
                                };
                            }));
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    $('#Matricula').val(ui.item.label);
                    return false;
                }
            });

            $('#nroafiliado').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/receta',
                        dataType: 'json',
                        data: {
                            nroafiliado: request.term
                        },
                        success: function(data) {
                            // Filtrar resultados para eliminar duplicados
                            let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.nroafiliado]) {
                                return false;
                            } else {
                                uniqueItems[item.nroafiliado] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 10);

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
                        url: 'http://localhost:8000/api/receta',
                        dataType: 'json',
                        data: {
                            obrasocial: request.term
                        },
                        success: function(data) {
                            // Filtrar resultados para eliminar duplicados
                            let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.obrasocial]) {
                                return false;
                            } else {
                                uniqueItems[item.obrasocial] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 10);

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


            function cargarRecetas(nroReceta = '', fechaInicio = '', fechaFin = '', paciente_id = '', nroafiliado = '', obrasocial = '', medico_id = '', receta_id = '') {
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost:8000/api/recetapag',
                    dataType: 'json',
                    data: {
                        nroReceta: nroReceta,
                        fechaInicio: fechaInicio,
                        fechaFin: fechaFin,
                        paciente_id: paciente_id,
                        nroafiliado: nroafiliado,
                        obrasocial: obrasocial,
                        medico_id: medico_id,
                        receta_id: receta_id,
                        limit: 5, // Número de registros por página
                        page: currentPage // Página actual
                    },
                    success: function(data) {
                        mostrarRecetas(data.data); // Muestra las recetas en la interfaz
                        mostrarPaginacion(data.total, data.per_page, nroReceta, fechaInicio, fechaFin, paciente_id, nroafiliado, obrasocial, medico_id, receta_id); // Muestra la paginación
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error en la solicitud:", textStatus, errorThrown);
                    }
                });
            }

            function mostrarPaginacion(total, perPage, nroReceta, fechaEmision, paciente_id, nroafiliado, obrasocial, medico_id, receta_id) {
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

                    // Recargar las recetas manteniendo los términos de búsqueda
                    cargarRecetas(nroReceta, fechaEmision, paciente_id, nroafiliado, obrasocial, medico_id, receta_id);
                });
            }

            function mostrarRecetas(recetas) {
                const divTabla = $('#muestra-recetas');
                divTabla.empty(); // Limpiar el contenido anterior

                if (recetas.length > 0) {
                    let tabla = `<table class="style_table">
                                    <thead>
                                        <tr>
                                            <th>Nro Receta</th>
                                            <th>Remedios</th>
                                            <th>DNI del Paciente</th>
                                            <th>Nro de Afiliado</th>
                                            <th>Obra Social</th>
                                            <th>Matricula del Medico</th>
                                            <th>Fecha de Emisión</th>
                                            <th>Fecha de Creación</th>
                                            <th>Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                    recetas.forEach(receta => {
                        let remediosInfo = receta.remedios ? receta.remedios.map(remedio => 
                            `<strong>Medicamento:</strong> ${remedio.medicamento || ''} <br> <strong>Prestación:</strong> ${remedio.prestacion || ''} <br>
                            <strong>Codigo:</strong> ${remedio.codigo || ''}`
                        ).join('<br> <br>') : '';
                        let remediosInfo2 = receta.remedios ? receta.remedios.map(remedio => 
                            `<strong><i class='custom-font' >Medicamento:</i></strong> ${remedio.medicamento || ''} <br> <strong><i class='custom-font'>Prestación:</i></strong> ${remedio.prestacion || ''} <br>
                            <strong><i class='custom-font'>Codigo:</i></strong> ${remedio.codigo || ''}`
                        ).join('<br> <br>') : '';
                        let paciente = receta.paciente || {};
                        let medico = receta.medico || {};

                        tabla += `<tr class="style_table">
                                    <td> <strong>${receta.nroReceta || '0'}</strong> </td>
                                    <td>${remediosInfo}</td>
                                    <td>${paciente.dni || ''}<br>${paciente.nombre || ''}, ${paciente.apellido || ''}</td>
                                    <td>${receta.nroafiliado || '0'}</td>
                                    <td>${receta.obrasocial || '-'}</td>
                                    <td>${medico.matricula || ''}<br>${medico.nombre || ''}, ${medico.apellido || ''}</td>
                                    <td>${receta.fechaEmision || ''}</td>
                                    <td>${receta.created_at || ''}</td>
                                    <td><a href="#" 
                                    class="img-center eliminar" 
                                    data-id="${receta.id}" 
                                    data-nroreceta="${receta.nroReceta}" 
                                    data-dni="${paciente.dni}" 
                                    data-nombre="${paciente.nombre}" 
                                    data-apellido="${paciente.apellido}" 
                                    data-matricula="${medico.matricula}" 
                                    data-nombremedico="${medico.nombre}" 
                                    data-apellidomedico="${medico.apellido}" 
                                    data-remedios="${remediosInfo2}" 
                                    data-toggle="modal" 
                                    data-target="#confirmModal">
                                    <img src="<?= base_url('img/delete.png'); ?>" alt="logo" class="img-action""></a></td>
                                </tr>`;
                    });

                    tabla += `</tbody></table>`;
                    divTabla.html(tabla);
                } else {
                    divTabla.html("<p>No se encontraron recetas.</p>");
                }
            }
              let recetaId; // Variable para almacenar el ID de la receta a eliminar
              let nroReceta;

              // Capturar el evento de clic en los botones de eliminar
              $('#muestra-recetas').on('click', '.eliminar', function() {
                  // Guardar los datos del botón clickeado en variables globales
                  recetaId = $(this).data('id');
                  nroReceta = $(this).data('nroreceta');
                  const dni = $(this).data('dni');
                  const nombre = $(this).data('nombre');
                  const apellido = $(this).data('apellido');
                  const matricula = $(this).data('matricula');
                  const nombreMedico = $(this).data('nombremedico');
                  const apellidoMedico = $(this).data('apellidomedico');
                  const remedios = $(this).data('remedios');

                  // Mostrar los datos en el modal
                  $('#confirmModal .modal-body').html(`¿Estás seguro de que deseas eliminar la receta? :
                      <br><strong>Nro de Receta:</strong> ${nroReceta}
                      <br><strong>DNI:</strong> ${dni}
                      <br><strong>Nombre:</strong> ${nombre}
                      <br><strong>Apellido:</strong> ${apellido}
                      <br><strong>Matricula:</strong> ${matricula}
                      <br><strong>Nombre del medico:</strong> ${nombreMedico}
                      <br><strong>Apellido del medico:</strong> ${apellidoMedico}
                      <br><strong>Remedios:</strong> 
                      <br>${remedios}
                  `);

                  $('#confirmModal').modal('show'); // Mostrar el modal de confirmación
              });

              // Capturar el evento de clic en el botón de confirmación
              $('#confirmDelete').on('click', function() {
                  // Buscar la receta por ID
                  $.ajax({
                          url: `http://localhost:8000/api/receta/busqueda`,  // Ruta de tu API de búsqueda
                          type: 'GET',
                          data: { id: recetaId },  // Pasar el ID de la receta
                          success: function(response) {
                              if (response) {
                                  // Suponiendo que la respuesta es un objeto, tomamos la respuesta directamente
                                  const deletedData = response;
                                  const remedios = deletedData["Remedios"];

                                  // Formatear la lista de remedios
                                  const remediosList = remedios.map(remedio => 
                                      `Medicamento: ${remedio.medicamento}, Codigo: ${remedio.codigo}`
                                  ).join(', <br> ');

                                  // Acceder a nombre y apellido del paciente y del médico
                                  const pacienteNombre = deletedData["Paciente"].nombre;
                                  const pacienteApellido = deletedData["Paciente"].apellido;
                                  const medicoNombre = deletedData["Medico"].nombre;
                                  const medicoApellido = deletedData["Medico"].apellido;

                                  // Construir la cadena de infoReceta
                                  const infoReceta = `Nro de receta: ${deletedData["Nro de receta"]}, DNI: ${deletedData["DNI"]}, ` +
                                      `Paciente: ${pacienteNombre} ${pacienteApellido}, ` +
                                      `Nro de Afiliado: ${deletedData["Nro de afiliado"]}, ` +
                                      `Obra Social: ${deletedData["Obra social"]}, ` +
                                      `Matricula: ${deletedData["Matricula"]}, ` +
                                      `Medico: ${medicoNombre} ${medicoApellido}, ` +
                                      `Remedios: <br> ${remediosList}`;

                                  // Procede con la eliminación
                                  deleteReceta(recetaId, infoReceta);
                              } else {
                                  console.error('No se encontró la receta.');
                              }
                          },
                          error: function(error) {
                              console.error('Error buscando la receta:', error);
                          }
                      });
              });

              // Función para eliminar la receta
              function deleteReceta(recetaId, infoReceta) {
                  // Primero, eliminar el nroReceta
                  $.ajax({
                      url: `http://localhost:8000/api/remedioreceta/delete/${recetaId}`,  // Ruta para eliminar el recetaId
                      type: 'DELETE',
                      success: function(response) {
                          // Después de eliminar el nroReceta, eliminar la receta por recetaId
                          $.ajax({
                              url: `http://localhost:8000/api/receta/${recetaId}`,  // Ruta para eliminar la receta por recetaId
                              type: 'DELETE',
                              success: function(response) {
                                  console.log(infoReceta);
                                  saveToHistorial(infoReceta);
                                  alert('Receta eliminada con éxito');
                                  $('#confirmModal').modal('hide'); // Ocultar el modal de confirmación
                                  location.reload();
                              },
                              error: function(jqXHR) {
                                      // Mostrar el mensaje de error en el formulario si falla la segunda solicitud
                                      if (jqXHR.status === 400) {
                                          const errorMessage = jqXHR.responseJSON.error;
                                          $('.form_error_delete').text(errorMessage).addClass('show');
                                      } else {
                                          alert('Error al eliminar el segundo remedio');
                                      }
                                  }
                              });
                          },
                          error: function(jqXHR) {
                              // Mostrar el mensaje de error en el formulario si falla la primera solicitud
                              if (jqXHR.status === 400) {
                                  const errorMessage = jqXHR.responseJSON.error;
                                  $('.form_error_delete').text(errorMessage).addClass('show');
                              } else {
                                  alert('Error al eliminar el primer remedio');
                              }
                          }
                  });
              }

              // Función para guardar en el historial
              function saveToHistorial(infoReceta) {
                console.log(infoReceta);
                  $.ajax({
                      url: `http://localhost:8000/api/historial`,  // Ruta para guardar en historial
                      type: 'POST',
                      contentType: 'application/json',
                      data: JSON.stringify({
                          datosPaciente: infoReceta
                      }),
                      success: function(response) {
                          console.log('Datos guardados en el historial:', response);
                      },
                      error: function(error) {
                          console.error('Error guardando en el historial:', error);
                      }
                  });
              }

              // Limpiar los errores de eliminación cuando se oculta el modal
              $('#confirmModal').on('hidden.bs.modal', function() {
                  $('.form_error_delete').removeClass('show');
              });
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