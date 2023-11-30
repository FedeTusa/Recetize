<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- BOOTSTRAP CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


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
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#ingresarModal">Ingresar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registrarseModal">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="salir">Salir</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container text-center mt-5">
        <p class="mt-4 fs-4">
            <strong>¡Bienvenido a RECETIZE!</strong> Regístrese o ingrese en caso de estar registrado para entrar a la aplicación.
        </p>
        <img src="logo.png" alt="Logo" class="img-fluid" style="max-width: 300px;">
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registrarseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrarse-form">
                        <div class="form-group">
                            <input type="text" id="registrarse-mail" class="form-control" placeholder="Email" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="Password" id="registrarse-password" class="form-control" placeholder="Password" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar y registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ingresarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingreso</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ingresar-form">
                        <div class="form-group">
                            <input type="text" id="ingresar-mail" class="form-control" placeholder="Email" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="Password" id="ingresar-password" class="form-control" placeholder="Password" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- BOOTSTRAP SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

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

        const logout = document.querySelector('#salir');

        logout.addEventListener('click', (e) => {
            e.preventDefault();

            signOut(auth).then(() => {
                console.log('sing out')
            })

        })

        onAuthStateChanged(auth, (user) => {
            if (user) {

                window.location.href = 'http://recetize.test/pagprincipal'; //debe dirigir a la pag principal
                
            } else {
                console.log('usuario no registrado')
            }
        });

    </script>
    <h3></h3>

</body>

</html>