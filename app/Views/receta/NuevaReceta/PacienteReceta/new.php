<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="<?= base_url('css/style.css?v=' . time()) ?>" rel="stylesheet">
    <title>Cargar paciente</title>
</head>

<body>

<h1>Paciente</h1>

<h2><?= $validation->listErrors() ?></h2>

    <a href="http://recetize.test/index.php/pagprincipal/receta/nuevo" class="back-button">
        <button>Atrás</button>
    </a>
     <div class="logo" >
          <img src="<?= base_url('img/logo3.png'); ?>" alt="logo" class="img-logo-form"">
    </div>

  <section class="main-container__form-section">
      <form class="form" action="<?= base_url("/index.php/pagprincipal/paciente")?>" method="post" >

        <div class="form__date">
            <label class="form__label" for="dni">DNI</label>
            <label class="form__label" for="nombre" >Nombre</label>
            <label class="form__label" for="apellido">Apellido</label>
        </div>
        <div class="form__date">
            <input class="form__input" type="text" name="dni" id="dni" pattern="\d*" placeholder="XX.XXX.XXX" required>
            <input class="form__input" type="text" name="nombre" id="nombre" value="<?= set_value('nombre'); ?>" required>
            <input class="form__input" type="text" name="apellido" id="apellido" value="<?= set_value('apellido'); ?>" required>
        </div>
        <div class="form__date_dni">
            <?php if (session()->getFlashdata('message') !== null) : ?>
              <div class="form_error" role="alert">
            <?= session()->getFlashdata('message'); ?>
            </div>
              <?php endif; ?>
        </div>
        

        <div class="form__date-obrasocial">
            <label class="form__label" for="obrasocial" >Obra Social</label>
            <label class="form__label" for="nroafiliado" >Nro De Afiliado</label>
        </div>

        <div class="form__date-obrasocial">
          <input class="form__input" type="text" name="obrasocial" id="obrasocial" value="<?= set_value('obrasocial'); ?>" required>
          <input class="form__input" type="text" name="nroafiliado" id="nroafiliado" pattern="\d*" required>
        </div>
        <?php if (session()->getFlashdata('message2') !== null) : ?>
            <div class="form_error" role="alert">
            <?= session()->getFlashdata('message2'); ?>
            </div>
              <?php endif; ?>

        <div class="form__date-telefono">
            <label class="form__label_NoObli" for="prefijo" >Prefijo</label>
            <label class="form__label_NoObli" for="celular" >Celular</label>
            <label class="form__label" for="localidad">Localidad</label>
        </div>
        <div class="form__date-telefono1">
          <div class="Separador">
          <input class="form__input" type="text" name="prefijo" id="prefijo" pattern="\d*" value="<?= set_value('prefijo'); ?>" >
          </div>
          <input class="form__input" type="text" name="celular" id="celular" pattern="\d*" value="<?= set_value('celular'); ?>" >
          <input class="form__input" type="text" name="localidad" id="localidad" value="<?= set_value('localidad'); ?>" required>
        </div>


        <div class="form__date-localidad">
            <label class="form__label_NoObli" for="calle">Calle</label>
            <label class="form__label_NoObli" for="altura">Altura</label>
        </div>
        
        <div class="form__date-localidad">
          <input class="form__input" type="text" name="calle" id="calle" value="<?= set_value('calle'); ?>" >
          <input class="form__input" type="text" name="altura" id="altura" pattern="\d*" value="<?= set_value('altura'); ?>">
        </div>
        <div class="div-center">
        <input class="form__submit" type="submit" value="Guardar">
        </div>
      </form>
  </section>
    
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
const ids = ['dni', 'nroafiliado', 'prefijo', 'celular', 'altura'];

ids.forEach(id => {
    document.getElementById(id).addEventListener('input', function (e) {
        this.value = this.value.replace(/\D/g, '');
    });
});
</script>
</body>
</html>


