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
        <div class="option-select" >
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
                <div class="option-select-lista divisor">
                  Cargar</div>
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio/buscar'">
                  Buscar</div>
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio/modificar'">
                  Modificar</div>
                <div class="option-lista divisor2" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/remedio/eliminar'">
                  Eliminar</div>
              </div>
      </div>
<section class="main-container__form-section">
      <form class="form" action="<?= base_url() ?>index.php/pagprincipal/remedio" method="post" >

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
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script>
document.getElementById('codigo').addEventListener('input', function (e) {
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