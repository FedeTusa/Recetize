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
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio'">
          Remedio</div>
        <div class="option" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/medico'">
          Médico</div>
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
                <div class="option-select-lista divisor">
                  Cargar</div>
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/receta/buscar'">
                  Buscar</div>
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/receta/modificar'">
                  Modificar</div>
                <div class="option-lista divisor2" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/receta/eliminar'">
                  Eliminar</div>
              </div>
      </div>

    <p class="message">Aclaración: el paciente, el remedio y el médico deben haber sido cargados previamente</p> 

  <section class="main-container__form-section">
      <form class="form" id="form_receta" action="<?= base_url("/index.php/pagprincipal/remedioreceta")?>" method="post" >

          <div class=" div-center encabezado">RECETA</div>

          <div class="form__date-paciente-receta1">
            <div class="input-groupo">
              <input class="input" type="text" name="nroReceta" pattern="\d*" id="nroReceta" >
              <label for="nroReceta" class="label">Número de receta</label>
            </div>
            <div class="input-groupo">
              <input class="input" type="date" name="fechaEmision" id="fechaEmision" value="<?= set_value('fechaEmision'); ?>" required>
              <label for="fechaEmision" class="label obli fechaEmision">Fecha de emisión</label>
            </div>
          </div>

          <div class=" div-center encabezado">PACIENTE</div>

          <div class="form__date_receta1">
            <div class="input-groupo">
              <input class="input dnii" type="text" name="dni" id="dni" value="<?= set_value('dni'); ?>" required>
              <label for="dni" class="label obli">DNI paciente</label>
            </div>
            <div class="input-groupo">
              <input class="input obrasocial" type="text" name="obrasocial" id="obrasocial" value="<?= set_value('obrasocial'); ?>" required>
              <label for="obrasocial" class="label obli">Obra Social</label>
            </div>
            <div class="input-groupo">
              <input class="input nroafiliado" type="text" name="nroafiliado" id="nroafiliado" pattern="\d*" required>
              <label for="nroafiliado" class="label obli">Nro Afiliado</label>
            </div>
          </div>

          <div class=" div-center encabezado">MEDICO</div>

          <div class="form__date_receta1">
            <div class="input-groupo">
                <input class="input matri" type="text" name="matricula" id="matricula" value="<?= set_value('matricula'); ?>" required >
                <label for="matricula" class="label obli">Matrícula médico</label>
            </div>
            <div class="input-groupo">
                <input class="input nombre" type="text" name="nombre" id="nombre" value="<?= set_value('nombre'); ?>" disabled >
                <label for="nombre" class="label obli">Nombres</label>
                <div class="disable"></div>
            </div>
            <div class="input-groupo">
                <input class="input apellido" type="text" name="apellido" id="apellido" value="<?= set_value('apellido'); ?>" disabled >
                <label for="apellido" class="label obli">Apellidos</label>
                <div class="disable"></div>
            </div>
          </div>

          <input type="hidden" name="Paciente_id_hidden" id="Paciente_id_hidden">
          <input type="hidden" name="Medico_id_hidden" id="Medico_id_hidden">
          <?php if (session()->get('message2')): ?>
              <div class="form_error" role="alert">
                  <?= session()->get('message2') ?>
              </div>
          <?php endif; ?>

          <div class=" div-center encabezado">REMEDIOS</div>

              <div id="rowsContainer">
                  <div class="remedios" id="remedios">
                    <div class="input-remedios">
                          <input type="text" name="medicamento" placeholder="Medicamentos"class="input medicamentoInput" required>
                          <div class="suggestions"></div>
                    </div>
                    <div class="input-remedios">
                          <input type="text" class="input prestacionInput" placeholder="Forma Farmacologica" disabled>
                          <div class="prestaciones"></div>
                    </div>
                    <div class="input-remedios">
                          <input type="text" placeholder="Código" class="input codigoInput" disabled>
                          <input type="hidden" name="remedio_id_hidden" class="remedio_id_hidden">
                    </div>
                    <button type="button" class="removeRowBtn delete_remedio"><img src="<?= base_url('img/delete.png'); ?>" alt="logo" class="img-action""></button>
                  </div>
              </div> 
              <div class="agregar_remedio">
                  <button type="button" class="add_remedio" id="addRowBtn"><img src="<?= base_url('img/add.png'); ?>" alt="logo" class="img-action""></button>
              </div>
          <div class="label1" ></div>
          <div id="savedDataContainer"></div>
        <?php if (session()->get('message3')): ?>
            <div class="form_error" role="alert">
                <?= session()->get('message3') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('message4')): ?>
            <script>
                    alert('<?= session()->getFlashdata('message4') ?>');
            </script>
        <?php endif; ?>


          <div class="div-center guardar">
            <input class="form__submit" type="submit" value="Guardar">
          </div>
      </form>
  </section>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
document.getElementById('nroReceta').addEventListener('input', function (e) {
    this.value = this.value.replace(/\D/g, '');
});
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

$('#dni').autocomplete({
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
                        label: item.dni + ' - ' + item.nombre + ' ' + item.apellido,
                        value: item.id,
                        dni: item.dni,
                        nombre: item.nombre,
                        apellido: item.apellido,
                        obrasocial: item.obrasocial,
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
        $('#dni').val(ui.item.dni + ', ' + ui.item.nombre + " " + ui.item.apellido);
        $('#Paciente_id_hidden').val(ui.item.value);
        $('#nroafiliado').val(ui.item.nroafiliado);
        $('#obrasocial').val(ui.item.obrasocial );
                $('.input').each(function() {
                    if ($(this).val()) {
                        $(this).addClass('valid');
                    } else {
                        $(this).removeClass('valid');
                    }
                });
        return false;
    }
});

// Evento para limpiar el ID oculto cuando el campo de entrada cambia
  $('#form_receta').on('input', '.dnii', function() {
            const inputValue = $(this).val().trim();
            var $input = $(this);
            var query = $input.val();
            var $suggestions = $input.siblings('.suggestions');

                  // Esta parte se ejecuta siempre que haya un cambio en el input
            $input.closest('.form__date_receta1').find('.obrasocial').val('');
            $input.closest('.form__date_receta1').find('.nroafiliado').val('');
            $('#Paciente_id_hidden').val('');

    // Realizar búsqueda para obtener las sugerencias actuales
    $('#dni').autocomplete('search', inputValue);

    // Esperar a que la búsqueda complete para verificar el valor
    setTimeout(() => {
        // Obtener las sugerencias actuales
        const suggestions = $('#dni').autocomplete('option', 'source');

        // Comparar el valor ingresado con las sugerencias actuales
        $.ajax({
            type: 'GET',
            url: 'http://localhost:8000/api/paciente',
            dataType: 'json',
            data: {
                busquedaDNI: inputValue
            },
            success: function(data) {
                let currentSuggestions = data.map(item => item.dni);
                
                if (!currentSuggestions.includes(inputValue) && inputValue !== '') {
                    $('#Paciente_id_hidden').val('');
                    $('#nroafiliado_hidden').val('');
                    $('#obrasocial_hidden').val('');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error en la solicitud:", textStatus, errorThrown);
            }
        });
    }, 100); // Timeout de 100 ms para dar tiempo a que se actualice la lista de sugerencias
});

$('#matricula').autocomplete({
    source: function(request, response) {
        $.ajax({
            type: 'GET',
            url: 'http://localhost:8000/api/medico',
            dataType: 'json',
            data: {
                busquedaMatricula: request.term
            },
            success: function(data) {
                let uniqueItems = {};
                let filteredData = data.filter(item => {
                    if (uniqueItems[item.matricula]) {
                        return false;
                    } else {
                        uniqueItems[item.matricula] = true;
                        return true;
                    }
                });
                filteredData = filteredData.slice(0, 6);

                response($.map(filteredData, function(item) {
                    return {
                        label: item.matricula + ' - ' + item.nombre + ' ' + item.apellido,
                        value: item.id,
                        matricula: item.matricula,
                        nombre: item.nombre,
                        apellido: item.apellido
                    };
                }));



            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error en la solicitud:", textStatus, errorThrown);
            }
        });
    },
    select: function(event, ui) {
        $('#matricula').val(ui.item.matricula );
        $('#nombre').val(ui.item.nombre);
        $('#apellido').val( ui.item.apellido);
        $('#Medico_id_hidden').val(ui.item.value);
                $('.input').each(function() {
                    if ($(this).val()) {
                        $(this).addClass('valid');
                    } else {
                        $(this).removeClass('valid');
                    }
                });
        return false;
    }
});

// Limpieza del ID oculto cuando el campo #matricula cambia
$('#form_receta').on('input', '.matri', function() {
            const inputValue = $(this).val().trim();
            var $input = $(this);
            var query = $input.val();
            var $suggestions = $input.siblings('.suggestions');

                  // Esta parte se ejecuta siempre que haya un cambio en el input
            $input.closest('.form__date_receta1').find('.nombre').val('');
            $input.closest('.form__date_receta1').find('.apellido').val('');
            $('#Medico_id_hidden').val('');
        // Realiza búsqueda para obtener las sugerencias actuales
        $('#matricula').autocomplete('search', inputValue);

        setTimeout(() => {
            $.ajax({
                type: 'GET',
                url: 'http://localhost:8000/api/medico',
                dataType: 'json',
                data: {
                    busquedaMatricula: inputValue
                },
                success: function(data) {
                    let currentSuggestions = data.map(item => item.matricula);

                    if (!currentSuggestions.includes(inputValue)) {
                        $('#Medico_id_hidden').val('');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error en la solicitud:", textStatus, errorThrown);
                }
            });
        }, 100); // Timeout de 100 ms para dar tiempo a que se actualice la lista de sugerencias
    
});

          $(document).ready(function() {

        function toggleRemoveButton() {
            const rowsContainer = document.getElementById('remedios'); // Asegúrate de seleccionar el contenedor correcto
            
            if ($('.remedios').length > 1) {
                $('.removeRowBtn').show(); // Mostrar el botón de eliminación
                rowsContainer.style.gridTemplateColumns = '1fr 1fr 1fr 0.1fr'; // Cambiar el grid
            } else {
                $('.removeRowBtn').hide(); // Ocultar el botón de eliminación
                rowsContainer.style.gridTemplateColumns = '1fr 1fr 1fr'; // Cambiar el grid cuando hay menos de 1 remedio
            }
        }

    // Cuando se haga clic en el botón de agregar fila
    $('#addRowBtn').on('click', function() {
        var newRow = `
        <div class="remedios" id="remedios">
            <div class="input-remedios">
                  <input type="text" name="medicamento" placeholder="Medicamentos"class="input medicamentoInput" required>
                  <div class="suggestions"></div>
            </div>
            <div class="input-remedios">
                  <input type="text" class="input prestacionInput" placeholder="Forma Farmacologica" disabled>
                  <div class="prestaciones"></div>
            </div>
            <div class="input-remedios">
                  <input type="text" placeholder="Código" class="input codigoInput" disabled>
                  <input type="hidden" name="remedio_id_hidden" class="remedio_id_hidden">
            </div>
            <!-- Botón de eliminar específico para esta fila -->
            <button type="button" class="removeRowBtn delete_remedio"><img src="<?= base_url('img/delete.png'); ?>" alt="logo" class="img-action""></button>
        </div>
        `;
        
        $('#rowsContainer').append(newRow);
        toggleRemoveButton();
    });

    // Delegar el evento de clic al documento para los botones de eliminar
    $(document).on('click', '.removeRowBtn', function() {
        $(this).closest('.remedios').remove();

        const contenedor = document.querySelector('#savedDataContainer');
        $('#savedDataContainer').empty(); // Limpiar el contenedor de datos guardados

        $('.remedios').each(function() {
            var medicamento = $(this).find('.medicamentoInput').val();
            var codigo = $(this).find('.codigoInput').val();
            var id = $(this).find('.remedio_id_hidden').val();

            if (medicamento && codigo) {
                var concatenatedData = medicamento + ' - ' + codigo;

                var inputElement2 = '<input type="hidden" name="remedio_id" class="remedio_id" value="' + id + '" disabled>';

                $('#savedDataContainer').append(inputElement2);
            }
        });

        toggleRemoveButton();
    });

                  const inputs = document.querySelectorAll('.remedio_id');

                  // Crear un array para almacenar los valores
                  const valores = [];

                  // Iterar sobre los inputs y guardar sus valores en el array
                  inputs.forEach(input => {
                      valores.push(input.value);
                  });

                  // Serializar el array como un JSON string
                  const jsonValores = JSON.stringify(valores);

                  // Crear el input hidden con el valor serializado
                  var inputElement3 = '<input type="hidden" name="array_remedio_id" id="array_remedio_id" value=\'' + jsonValores + '\'>'; // Use single quotes for the value to handle JSON with double quotes

                  // Agregar el input hidden al formulario o al contenedor deseado
                  $('#savedDataContainer').append(inputElement3);

                  toggleRemoveButton();
              });

              // Delegar eventos para el autocomplete
              $('#rowsContainer').on('input', '.medicamentoInput', function() {
                  var $input = $(this);
                  var query = $input.val();
                  var $suggestions = $input.siblings('.suggestions');

                  // Esta parte se ejecuta siempre que haya un cambio en el input
                  $input.closest('.remedios').find('.codigoInput').val('');
                  $input.closest('.remedios').find('.prestacionInput').val('').prop('disabled', true);
                  $input.closest('.remedios').find('.prestaciones').empty();
                  $suggestions.empty();
                  $('#savedDataContainer').empty();

                  // Solo si hay texto en el input, se realiza la solicitud AJAX
                  if (query.length > 0) {
                      $.ajax({
                          url: 'http://localhost:8000/api/remedio1',
                          type: 'GET',
                          dataType: 'json',
                          data: { query: query },
                          success: function(data) {
                              $suggestions.empty();
                              var uniqueMedications = [];
                              var seenMedications = new Set();

                              data.forEach(function(item) {
                                  if (!seenMedications.has(item.medicamento)) {
                                      seenMedications.add(item.medicamento);
                                      uniqueMedications.push(item);
                                  }
                              });

                              uniqueMedications = uniqueMedications.slice(0, 6);

                              if (uniqueMedications.length > 0) {
                                  uniqueMedications.forEach(function(item) {
                                      $suggestions.append('<div class="suggestion-item">' + item.medicamento + '</div>');
                                  });
                              } else {
                                  $suggestions.append('<div class="suggestion-item">No se encontraron resultados</div>');
                              }
                          },
                          error: function(jqXHR, textStatus, errorThrown) {
                              console.error('Error en la solicitud:', textStatus, errorThrown);
                          }
                      });
                  }
              });

              // Manejar la selección de un medicamento
              $('#rowsContainer').on('click', '.suggestion-item', function() {
                  var selectedMedicamento = $(this).text();
                  var $row = $(this).closest('.remedios');
                  $row.find('.medicamentoInput').val(selectedMedicamento);
                  $row.find('.suggestions').empty();

                  $.ajax({
                      url: 'http://localhost:8000/api/remedio2',
                      type: 'GET',
                      dataType: 'json',
                      data: { medicamento: selectedMedicamento },
                      success: function(data) {
                          var $prestaciones = $row.find('.prestaciones');
                          $prestaciones.empty();

                          if (data.length > 0) {
                              data.forEach(function(item) {
                                  $prestaciones.append('<div class="prestacion-item" data-codigo="' + item.codigo + '" data-id="' + item.id + '">' + item.prestacion + '</div>');
                              });
                          } else {
                              $prestaciones.append('<div class="prestacion-item">No se encontraron resultados</div>');
                          }
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                          console.error('Error en la solicitud:', textStatus, errorThrown);
                      }
                  });
              });

              // Manejar la selección de una prestación
              $('#rowsContainer').on('click', '.prestacion-item', function() {
                  var selectedPrestacion = $(this).text();
                  var codigo = $(this).data('codigo');
                  var id = $(this).data('id');
                  var $row = $(this).closest('.remedios');
                  $row.find('.prestacionInput').val(selectedPrestacion);
                  $row.find('.codigoInput').val(codigo);
                  $row.find('.remedio_id_hidden').val(id);
                  $row.find('.prestaciones').empty();


                  $('#savedDataContainer').empty(); // Limpiar el contenedor de datos guardados

                  $('.remedios').each(function() {
                      var medicamento = $(this).find('.medicamentoInput').val();
                      var codigo = $(this).find('.codigoInput').val();
                      var id = $(this).find('.remedio_id_hidden').val();

                      if (medicamento && codigo) {
                          var concatenatedData = medicamento + ' - ' + codigo;

                          var inputElement2 = '<input type="hidden" name="remedio_id" class="remedio_id" value="' + id + '" disabled>';

                          $('#savedDataContainer').append(inputElement2);
                      }
                  });
                  
                  const inputs = document.querySelectorAll('.remedio_id');

                  // Crear un array para almacenar los valores
                  const valores = [];

                  // Iterar sobre los inputs y guardar sus valores en el array
                  inputs.forEach(input => {
                      valores.push(input.value);
                  });

                  // Serializar el array como un JSON string
                  const jsonValores = JSON.stringify(valores);

                  // Crear el input hidden con el valor serializado
                  var inputElement3 = '<input type="hidden" name="array_remedio_id" id="array_remedio_id" value=\'' + jsonValores + '\'>'; // Use single quotes for the value to handle JSON with double quotes

                  // Agregar el input hidden al formulario o al contenedor deseado
                  $('#savedDataContainer').append(inputElement3);
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
</body>

</html>


