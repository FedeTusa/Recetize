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
        <div class="option-select">
          Médico</div>
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
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/medico/buscar'">
                  Buscar</div>
                <div class="option-lista divisor" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/medico/modificar'">
                  Modificar</div>
                <div class="option-lista divisor2" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/medico/eliminar'">
                  Eliminar</div>
              </div>
      </div>
      <section class="main-container__form-section">
        <form class="form" action="<?= base_url("/index.php/pagprincipal/medico")?>" method="post" >

        <div class=" div-center encabezado">MÉDICO</div>

          <div class="form__date-especialidad">
                  <div class="input-groupo">
                    <input class="input" type="text" name="matricula" id="matricula" pattern="\d*" required autofocus>
                    <label for="matricula" class="label obli">Matrícula Nacional</label>
                  </div>
                  <div class="input-groupo">
                    <input class="input" type="text" name="especialidad" id="especialidad" value="<?= set_value('especialidad'); ?>" required>
                    <label for="especialidad" class="label obli">Especialidad</label>
                  </div>
          </div>

          <div class="form__date_dni">
              <?php if (session()->getFlashdata('message') !== null) : ?>
                <div class="form_error" role="alert">
              <?= session()->getFlashdata('message'); ?>
              </div>
                <?php endif; ?>
          </div>
          
          <div class="form__date-medico">
                  <div class="input-groupo">
                    <input class="input" type="text" name="nombre" id="nombre" value="<?= set_value('nombre'); ?>" required>
                    <label for="nombre" class="label obli">Nombres</label>
                  </div>
                  <div class="input-groupo">
                    <input class="input" type="text" name="apellido" id="apellido" value="<?= set_value('apellido'); ?>" required >
                    <label for="apellido" class="label obli">Apellidos</label>
                  </div>
          </div>

          <?php if (session()->getFlashdata('message2') !== null) : ?>
              <div class="form_error" role="alert">
              <?= session()->getFlashdata('message2'); ?>
              </div>
                <?php endif; ?>
          <div class=" div-center encabezado">CONTACTO</div>

          <div class="form__date-telefono1">
              <div class="Separador">
              <div class="input-groupo">
                    <input class="input" type="text" name="prefijo" id="prefijo" pattern="\d*" value="<?= set_value('prefijo'); ?>">
                    <label class="label" for="prefijo" >Prefijo</label>
              </div>
              </div>
              <div class="input-groupo">
                    <input class="input" type="text" name="celular" id="celular" pattern="\d*" value="<?= set_value('celular'); ?>" >
                    <label class="label" for="celular" >Celular</label>
              </div>
              <div class="input-groupo">
                    <input name="email" class="input" type="email" name="email" id="email" value="<?= set_value('email'); ?>" >
                    <label for="email" class="label">Email</label>
              </div>
          </div>

          <div class=" div-center encabezado">DOMICILIO</div>

          <div class="form__date-localidad">
              <div class="input-groupo">
                  <input class="input" type="text" name="calle" id="calle" value="<?= set_value('calle'); ?>" >
                  <label class="label" for="calle">Calle</label>
              </div>
              <div class="input-groupo">
                  <input class="input" type="text" name="altura" id="altura" pattern="\d*" value="<?= set_value('altura'); ?>">
                  <label class="label" for="altura">Altura</label>
              </div>
              <div class="input-groupo">
                  <input class="input" type="text" id="cp" name="cp" required>
                  <label for="cp" class="label obli">C.P.</label>
              </div>
              <div class="input-groupo">
                  <input class="input" type="text" id="provincia" name="provincia" value="<?= set_value('provincia'); ?>" required>
                  <label for="provincia" class="label obli">Provincia</label>
              </div>
              <div class="input-groupo">
                  <input class="input" type="text" id="localidad" name="localidad" required>
                  <label for="localidad" class="label obli">Localidad</label>
              </div>
          </div>
          <div class="div-center guardar">
            <input class="form__submit" type="submit" value="Guardar">
          </div>
        </form>
    <?php if (session()->getFlashdata('message3')): ?>
        <script>
            alert('<?= session()->getFlashdata('message3') ?>');
        </script>
    <?php endif; ?>
      </section>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
const ids = ['matricula', 'prefijo', 'celular', 'altura'];

ids.forEach(id => {
    document.getElementById(id).addEventListener('input', function (e) {
        this.value = this.value.replace(/\D/g, '');
    });
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