<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recetize</title>
  <!-- Agregar el enlace al archivo de Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="recetize">Recetize</div>
    <div class="options">
      <div class="row">
        <!-- Quitamos el estilo por defecto de Bootstrap y agregamos un evento onclick -->
        <div class="col-md-4 option" onclick="window.location.href='http://recetize.test/PacienteController/new'">Cargar</div>
        <div class="col-md-4 option">Buscar</div>
        <div class="col-md-4 option">Modificar</div>
      </div>
      <div class="row">
        <div class="col-md-6 option">Consultar</div>
        <div class="col-md-6 option">Eliminar</div>
      </div>
    </div>
  </div>
  <!-- Agregar el enlace al archivo de Bootstrap JS (opcional, pero necesario para algunos componentes de Bootstrap) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>





