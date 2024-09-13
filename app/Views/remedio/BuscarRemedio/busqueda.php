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
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/paciente'">
          Paciente</div>
        <div class="option-select">
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
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio/nuevo'">
                  Cargar</div>
                <div class="option-select-lista divisor" >
                  Buscar</div>
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio/modificar'">
                  Modificar</div>
                <div class="option-lista divisor2" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio/eliminar'">
                  Eliminar</div>
              </div>
      </div>

      <div id="search-form1">
        <form class="form-container">
                <div class="form-grupo2">
                  <div class="input-groupo">
                    <input type="text" id="Codigo" name="Codigo" class="input">
                    <label for="Codigo" class="label">Codigo</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="Droga" name="Droga" class="input" >
                    <label for="Droga" class="label">Droga</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="Medicamento" name="Medicamento" class="input">
                    <label for="Medicamento" class="label">Medicamento</label>
                  </div>
                  <div class="input-groupo">
                    <input type="text" id="Farmacodinamia" name="Farmacodinamia" class="input">
                    <label for="Farmacodinamia" class="label">Farmacodinamia</label>
                  </div>
                  <button type="submit" class="busqueda">
                      <img src="<?= base_url('img/lupa.png'); ?>" alt="logo" class="lupa">
                  </button>
                </div>
        </form>
  </div>


    <div id="muestra-remedios" class="tabla"></div>
    <div id="pagination-controls" class="pagination-container"></div>

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
            cargarRemedios();

            $('#Codigo').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/remedio',
                        dataType: 'json',
                        data: {
                            busquedaCodigo: request.term
                        },
                        success: function(data) {
                          let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.codigo]) {
                                return false;
                            } else {
                                uniqueItems[item.codigo] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 10);

                            response($.map(filteredData, function(item) {
                                return {
                                    label: item.codigo,
                                    value: item.id,
                                    codigo: item.codigo,
                                };
                            }));
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#Codigo').val(ui.item.codigo);
                    $('#Codigo_hidden').val(ui.item.value);
                    return false;
                }
            });

            $('#Droga').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/remedio',
                        dataType: 'json',
                        data: {
                            busquedaDroga: request.term
                        },
                        success: function(data) {
                            // Filtrar resultados para eliminar duplicados
                            let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.droga]) {
                                return false;
                            } else {
                                uniqueItems[item.droga] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 10);

                            response($.map(filteredData, function(item) {
                            return {
                                label: item.droga,
                                value: item.id,
                                droga: item.droga,
                            };
                        }));
                      },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#Droga').val(ui.item.droga);
                    $('#Droga_hidden').val(ui.item.value);
                    return false;
                }
            });

            $('#Medicamento').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/remedio',
                        dataType: 'json',
                        data: {
                            busquedaMedicamento: request.term
                        },
                        success: function(data) {
                            // Filtrar resultados para eliminar duplicados
                            let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.medicamento]) {
                                return false;
                            } else {
                                uniqueItems[item.medicamento] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 10);

                        response($.map(filteredData, function(item) {
                            return {
                                label: item.medicamento,
                                value: item.id,
                                medicamento: item.medicamento,
                            };
                        }));
                      },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#Medicamento').val(ui.item.medicamento);
                    $('#Medicamento_hidden').val(ui.item.value);
                    return false;
                }
            });

            $('#Farmacodinamia').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8000/api/remedio',
                        dataType: 'json',
                        data: {
                            busquedaFarmacodinamia: request.term
                        },
                        success: function(data) {
                            // Filtrar resultados para eliminar duplicados
                            let uniqueItems = {};
                            let filteredData = data.filter(item => {
                            if (uniqueItems[item.farmacodinamia]) {
                                return false;
                            } else {
                                uniqueItems[item.farmacodinamia] = true;
                                return true;
                            }
                            });
                            filteredData = filteredData.slice(0, 10);

                        response($.map(filteredData, function(item) {
                            return {
                                label: item.farmacodinamia,
                                value: item.id,
                                farmacodinamia: item.farmacodinamia,
                            };
                        }));
                      },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error en la solicitud:", textStatus, errorThrown);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#Farmacodinamia').val(ui.item.farmacodinamia);
                    $('#Farmacodinamia_hidden').val(ui.item.value);
                    return false;
                }
            });

            // Manejador del evento submit del formulario
            $('.form-container').on('submit', function(e) {
                e.preventDefault();
                const remedioCodigo = $('#Codigo').val();
                const remedioDroga = $('#Droga').val();
                const remedioMedicamento = $('#Medicamento').val();
                const remedioFarmacodinamia = $('#Farmacodinamia').val();
                cargarRemedios(remedioCodigo, remedioDroga, remedioMedicamento, remedioFarmacodinamia);
            });


              function cargarRemedios(codigo = '', droga = '', medicamento = '', farmacodinamia = '') {
                  $.ajax({
                      type: 'GET',
                      url: 'http://localhost:8000/api/remediopag',
                      dataType: 'json',
                      data: {
                          busquedaCodigo: codigo,
                          busquedaDroga: droga,
                          busquedaMedicamento: medicamento,
                          busquedaFarmacodinamia: farmacodinamia,
                          limit: 8, // Número de registros por página
                          page: currentPage // Página actual
                      },
                      success: function(data) {
                          mostrarRemedios(data.data); // Muestra los remedios
                          mostrarPaginacion(data.total, data.per_page, codigo, droga, medicamento, farmacodinamia); // Muestra la paginación
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                          console.error("Error en la solicitud:", textStatus, errorThrown);
                      }
                  });
              }

              function mostrarPaginacion(total, perPage, codigo, droga, medicamento, farmacodinamia) {
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

                      // Recargar los remedios manteniendo los términos de búsqueda
                      cargarRemedios(codigo, droga, medicamento, farmacodinamia);
                  });
              }

            function mostrarRemedios(remedios) {
                const divTabla = $('#muestra-remedios');
                divTabla.empty(); // Limpiar el contenido anterior

                if (remedios.length > 0) {
                    let tabla = `<table class="style_table">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Droga</th>
                                            <th>Medicamento</th>
                                            <th>Forma Farmacologica</th>
                                            <th>Farmacodinamia</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                    remedios.forEach(remedio => {
                        tabla += `<tr class="style_table">
                                    <td>${remedio.codigo}</td>
                                    <td>${remedio.droga}</td>
                                    <td>${remedio.medicamento}</td>
                                    <td>${remedio.prestacion || ''}</td>
                                    <td>${remedio.farmacodinamia || ''}</td>
                                </tr>`;
                    });

                    tabla += `</tbody></table>`;
                    divTabla.html(tabla);
                } else {
                    divTabla.html("<p>No se encontraron remedios.</p>");
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