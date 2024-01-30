<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recetize</title>
  <!-- Agregar el enlace al archivo de Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    body {
      background-color: #f0f0f0;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #f0f0f0;
      padding: 20px;
    }

    .recetize {
      writing-mode: vertical-lr;
      transform: rotate(180deg);
      font-size: 110px;
      font-weight: bold;
      padding: 20px;
      border-right: 2px solid #555;
    }

    .options {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .row {
      display: flex;
      gap: 20px;
    }

    .option {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 250px;
      height: 250px;
      background-color: #c0e7c8;
      border: none;
      color: #000;
      font-weight: bold;
      font-size: 24px;
      border-radius: 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-decoration: none; /* Quitamos la subrayado */
    }

    .option:hover {
      background-color: #a5d8b9;
    }
  </style>
</head>
<body>
<div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">RECETIZE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="salir">Salir</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
  </div>  

  <div class="container">
    <div class="recetize">Recetize</div>
    <div class="options">
      <div class="row">
        <!-- Quitamos el estilo por defecto de Bootstrap y agregamos un evento onclick -->
        <div class="col-md-4 option" onclick="window.location.href='http://recetize.test/PacienteController/new'">
          <!-- <img src="carga.jpg" alt="Cargar" style="width: 80px; height: 80px;"> -->
          Cargar
      </div>

      <div class="col-md-4 option" onclick="window.location.href='http://recetize.test/RecetaController/show'">
          <!-- <img src="carga.jpg" alt="Cargar" style="width: 80px; height: 80px;"> -->
          Buscar
      </div>
        <div class="col-md-4 option">Modificar</div>
      </div>
      <div class="row">
        <div class="col-md-6 option" onclick="window.location.href='http://recetize.test//pagprincipal/consulta'">Consultar</div>
        <div class="col-md-6 option">Eliminar</div>
      </div>
    </div>
  </div>
  <!-- Agregar el enlace al archivo de Bootstrap JS (opcional, pero necesario para algunos componentes de Bootstrap) -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
 -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

  <script type="module">

        import {
                    initializeApp
                } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js";

        import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, signOut, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-auth.js";

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyAFyFdKQ6HyrUxmFcxiNQbIi6xjHPFKKNE",
            authDomain: "recetize.firebaseapp.com",
            projectId: "recetize",
            storageBucket: "recetize.appspot.com",
            messagingSenderId: "725014354320",
            appId: "1:725014354320:web:8ab09ce96d38044e15fb15"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);

        // Initialize Firebase Authentication and get a reference to the service
        const auth = getAuth(app);

        /* const autentic = auth(); */

        //const auth = firebase.auth(); 

    

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
                    consolo.log('singin')
                
            } else {
              window.location.href = 'http://recetize.test';
            }
        });

    </script>
</body>
</html>





