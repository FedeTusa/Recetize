<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/style.css?v=' . time()) ?>" rel="stylesheet">
    <title>carga receta</title>
</head>
<body>
  <div class="titulo-exito">
    <h1>LA RECETA SE HA CARGADO CON ÉXITO</h1>
    </div>
    <div class="options">
      <div class="row">
        <!-- Quitamos el estilo por defecto de Bootstrap y agregamos un evento onclick -->
        <div class="col-md-4 option boton-exito" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/receta/nuevo'">
          Cargar Nueva Receta</div>
        <div class="col-md-4 option2 boton-exito" onclick="window.location.href='http://recetize.test/index.php/pagprincipal/receta'">
          Atrás</div>
        <div class="col-md-4 option3" >
          <img src="<?= base_url('img/logo2.png'); ?>" alt="logo" class="img-logo"">
          </div>
      </div>

  </div>
</body>
</html>