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
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio/buscar'">
                  Buscar</div>
                <div class="option-select-lista divisor" >
                  Modificar</div>
                <div class="option-lista divisor2" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio/eliminar'">
                  Eliminar</div>
              </div>
      </div>
<section class="main-container__form-section">
      <form class="form" id="editar-remedio-form">

        <div class=" div-center encabezado">REMEDIO</div>

        <div class="form__date">
                  <div class="input-groupo">
                    <input class="input " type="text" name="codigo" id="codigo" pattern="\d*" required autofocus>
                    <label for="codigo" class="label obli">Código</label>
                  </div>
                  <div class="input-groupo">
                    <input class="input" type="text" name="droga" id="droga" value="<?= set_value('droga'); ?>" required>
                    <label for="droga" class="label obli">Droga</label>
                  </div>
                  <div class="input-groupo">
                    <input class="input" type="text" name="medicamento" id="medicamento" value="<?= set_value('medicamento'); ?>" required >
                    <label for="medicamento" class="label obli">Medicamento</label>
                  </div>
        </div>
        <div class="form__date_codigo">
              <?php if (session()->getFlashdata('message') !== null) : ?>
            <div class="form_error" role="alert">
            <?= session()->getFlashdata('message'); ?>
            </div>
              <?php endif; ?>
        </div>
        <div class="form__date-remedio">
                  <div class="input-groupo">
                    <input class="input" type="text" name="prestacion" id="prestacion" value="<?= set_value('prestacion'); ?>" required>
                    <label for="prestacion" class="label obli">Forma Farmacologica</label>
                  </div>
                  <div class="input-groupo">
                    <input class="input" type="text" name="farmacodinamia" id="farmacodinamia" value="<?= set_value('farmacodinamia'); ?>" required>
                    <label for="farmacodinamia" class="label obli">Farmacodinamia</label>
                  </div>
        </div>
        <div class="div-center guardar">
          <input class="form__submit" type="submit" value="Guardar">
        </div>
      </form>
  </section>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>
   <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const remedioId = urlParams.get('id');

            // Obtener los datos del remedio
            $.ajax({
                url: 'http://localhost:8000/api/remedio/' + remedioId,
                type: 'GET',
                success: function(remedio) {
                    $('#codigo').val(remedio.codigo);
                    $('#droga').val(remedio.droga);
                    $('#medicamento').val(remedio.medicamento);
                    $('#prestacion').val(remedio.prestacion);
                    $('#farmacodinamia').val(remedio.farmacodinamia);

                    $('.input').each(function() {
                      if ($(this).val()) {
                          $(this).addClass('valid');
                      } else {
                          $(this).removeClass('valid');
                      }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error al obtener el paciente:', textStatus, errorThrown);
                }
            });

            // Manejador del evento submit del formulario
            $('#editar-remedio-form').on('submit', function(e) {
                e.preventDefault();

                const data = {
                    codigo: $('#codigo').val(),
                    droga: $('#droga').val(),
                    medicamento: $('#medicamento').val(),
                    prestacion: $('#prestacion').val(),
                    farmacodinamia: $('#farmacodinamia').val(),
                };

                // Realizar la petición PUT a la API
                $.ajax({
                        url: 'http://localhost:8000/api/remedio/' + remedioId,
                        type: 'PUT',
                        data: JSON.stringify(data),
                        contentType: 'application/json',
                        success: function(response) {
                            alert('Remedio actualizado exitosamente');
                            window.location.href = '<?= base_url('index.php/pagprincipal/remedio/modificar') ?>';
                        },
                        error: function(jqXHR) {
                            $('.form_error1').removeClass('show1');

                            if (jqXHR.status === 422) {
                                const errors = jqXHR.responseJSON.errors;
                                if (errors.codigo) {
                                    $('.form_error1').text(errors.codigo[0]).addClass('show1');
                                }
                            } else {
                                console.error('Error en la solicitud:', jqXHR.statusText);
                            }
                        }
                    });
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

</html>



