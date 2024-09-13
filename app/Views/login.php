<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- BOOTSTRAP CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="<?= base_url('css/style.css?v=' . time()) ?>" rel="stylesheet">
</head>

<body class="body_inicio2">
    <div class="navbar1">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" onclick="abrirNuevaVentana()">RECETIZE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#ingresarModal">Ingresar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registrarseModal">Registrarse</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="containera text-center mt-5">
        <p class="mt-4 fs-4 text-white">
            <strong>¡Bienvenido a RECETIZE!</strong> Regístrese o ingrese en caso de estar registrado para entrar a la aplicación.
        </p>
        <img src="<?= base_url('img/logo_white_text.png'); ?>" alt="logo" style="max-width: 700px;">
    </div>

    <!-- Modal -->
<div class="modal fade" id="registrarseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white"> <!-- bg-dark for dark background and text-white for white text -->
            <div class="modal-header border-secondary"> <!-- border-secondary for a subtle border -->
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registro</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrarse-form">
                    <div class="form-group">
                        <input type="text" id="registrarse-mail" class="form-control bg-secondary text-white border-0 shadow-none" placeholder="Email" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="Password" id="registrarse-password" class="form-control bg-secondary text-white border-0 shadow-none" placeholder="Clave" required>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-custom">Guardar y registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ingresarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-secondary">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ingreso</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ingresar-form">
                    <div class="form-group">
                        <input type="text" id="ingresar-mail" class="form-control bg-secondary text-white border-0 shadow-none" placeholder="Email" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="Password" id="ingresar-password" class="form-control bg-secondary text-white border-0 shadow-none" placeholder="Clave" required>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-custom">Ingresar</button>
                        <button type="button" onclick="sendPasswordReset()" class="btn btn-danger btn-custom">Restablecer Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

    <!-- BOOTSTRAP SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

    <script type="module">
      

        import {
                    initializeApp
                } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js";

        import { getAuth, sendPasswordResetEmail, createUserWithEmailAndPassword, signInWithEmailAndPassword, signOut, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-auth.js";

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBakDzF3H0gku4gD--uUU2K-30BIpiT1Yo",
            authDomain: "recetize-8673b.firebaseapp.com",
            projectId: "recetize-8673b",
            storageBucket: "recetize-8673b.appspot.com",
            messagingSenderId: "785480675848",
            appId: "1:785480675848:web:fa6aaa899d8f66f56917bd"
        };
//  apiKey: "AIzaSyBakDzF3H0gku4gD--uUU2K-30BIpiT1Yo",
//  authDomain: "recetize-8673b.firebaseapp.com",
//  projectId: "recetize-8673b",
//  storageBucket: "recetize-8673b.appspot.com",
//  messagingSenderId: "785480675848",
//  appId: "1:785480675848:web:fa6aaa899d8f66f56917bd",
//  measurementId: "G-67CB5DBHEX
        // Initialize Firebase
        const app = initializeApp(firebaseConfig);

        // Initialize Firebase Authentication and get a reference to the service
        const auth = getAuth(app);

        /* const autentic = auth(); */

        //const auth = firebase.auth(); 

    

   // <!-- CUSTOM CODE -->
// REGISTRO____________________________________________________________________
        console.log('hello word')
        const singupForm = document.querySelector('#registrarse-form');

        singupForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const singupEmail = document.querySelector('#registrarse-mail').value;
            const singupPassword = document.querySelector('#registrarse-password').value;

            //console.log(singupEmail, singupPassword)

            
            createUserWithEmailAndPassword(auth, singupEmail, singupPassword)
                .then((userCredential) => {
                    //limpia el formulario
                    singupForm.reset();

                    //cerrar el modal(NO FUNCIONA)
                    $('#registrarseModal').modal('hide');

                    console.log('registrado')
                })

                  .catch((error) => {
                    const errorCode = error.code;
                    const errorMessage = error.message;
                    console.log(errorMessage)

                    if(errorMessage == 'Firebase: Error (auth/invalid-email).'){
                        alert('mail invalido');
                    } else if(errorMessage == 'Firebase: Error (auth/email-already-in-use).') {
                        alert('mail ya en uso');
                    } else if(errorMessage == 'Firebase: Password should be at least 6 characters (auth/weak-password).') {
                        alert('La contraseña debe tener al menos 6 caracteres');
                    }
                });
        })

//RESTABLECER CONTRASEÑA
          window.sendPasswordReset = function() {
            const email = document.querySelector('#ingresar-mail').value; // Obtén el correo del input del usuario
            sendPasswordResetEmail(auth, email)
            .then(() => {
                // Correo de restablecimiento enviado
               alert("Correo de restablecimiento enviado a " + email + "\n(Porfavor revise correo no deseado)");
             })
            .catch((error) => {
                // Manejo de errores
                const errorCode = error.code;
                const errorMessage = error.message;
                console.error("Error al enviar el correo de restablecimiento:", error);
                alert("Error al enviar el correo de restablecimiento,\nMail incorrecto o inexistente.");
            });
    };

// INGRESO____________________________________________________________
        const signinForm = document.querySelector('#ingresar-form');

        signinForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const singinEmail = document.querySelector('#ingresar-mail').value;
            const singinPassword = document.querySelector('#ingresar-password').value;

            //console.log(singinEmail, singinPassword)  
            
            signInWithEmailAndPassword(auth, singinEmail, singinPassword)
                .then((userCredential) => {
                    //limpia el formulario
                    singupForm.reset();

                    //cerrar el modal(NO FUNCIONA)
                    $('#registrarseModal').modal('hide');

                    //console.log('ingreso exitoso')
                })

                .catch((error) => {
                const errorCode = error.code;
                const errorMessage = error.message;
                //console.log(errorCode)
                //console.log(errorMessage)
                if (errorMessage === 'Firebase: Error (auth/invalid-login-credentials).') {
                    alert('Usuario o Contraseña incorrectos');
                }

                });

        })

        

        onAuthStateChanged(auth, (user) => {
            if (user) {

                window.location.href = 'http://recetize.test/index.php/pagprincipal'; //debe dirigir a la pag principal
                
            } else {
                console.log('usuario no registrado')
            }
        });

    </script>
    <h3></h3>



</html>