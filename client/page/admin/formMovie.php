<?php
require '../../../api/crud.php';
require '../../../helpers/functions.php';
session_start();

//si existe la variable de sesion errores se almacena en el array
if (isset($_SESSION['errores'])) {
  $errores = $_SESSION['errores'];
}
// eliminamos la variable de sesion - Los datos ya quedaron almacenados en la variable
unset($_SESSION['errores']);

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $create = true;
  $movieEdit = searchMoviesById($id);
} else {
  $create = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="../../asset/css/styles.css" />

  <!-- CDN - Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- CDN sweetalert2 estilos theme dark -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> -->

  <title>Cargar Películas</title>
</head>

<body>
  <header class="header_color">
    <nav class="header_nav_links">
      <!-- Icono y logo -->
      <a href="../../../index.php" class="header_logo">
        <i class="fas fa-film"></i>
        <span>CAC-Movies</span>
      </a>
    </nav>
  </header>
  <section class="container-fluid p-5 container-api">
    <div class="d-flex align-items-center justify-content-end">
      <!--			<h1 class="fs-3">Administrador de Películas</h1>-->
      <a href="dashboard.php" class="link_movie-add"><i class="fa-solid fa-caret-left"></i>Volver</a>
    </div>
    <form action="createMovie.php" method="post" class="form-peliculas" enctype=multipart/form-data>
      <h1 class="text-center p-2 h1-form">Cargar Películas</h1>
      <input type="hidden" name="id"
        value="<?php echo isset($movieEdit['id_pelicula']) ? $movieEdit['id_pelicula'] : ''; ?>" />

      <label for="nombre">Nombre</label>
      <!-- <input type="text" name="nombre" /> -->
      <input type="text" name="nombre" value="<?php echo $create ? $movieEdit['nombre'] : ''; ?>" />

      <?php if (isset($errores['nombre'])) : ?>
      <p class="text-danger fs-6 mx-5"><?php echo $errores['nombre'] ?></p>
      <?php endif; ?>

      <label for="">Descripción</label>
      <textarea name="descripcion" id=""
        class="descripcion"><?php echo $create ? $movieEdit['descripcion'] : ''; ?></textarea>
      <?php if (isset($errores['descripcion'])) : ?>
      <p class="text-danger fs-6 mx-5"><?php echo $errores['descripcion'] ?></p>
      <?php endif; ?>

      <label for="genero">Género</label>
      <input type="text" name="genero" placeholder="separar con coma los Género"
        value="<?php echo $create ? $movieEdit['genero'] : ''; ?>" />
      <?php if (isset($errores['genero'])) : ?>
      <p class="text-danger fs-6 mx-5"><?php echo $errores['genero'] ?></p>
      <?php endif; ?>

      <!-- SELECT CALIFICACION -->
      <label for="calificacion">Calificación</label>
      <select name="calificacion" id="calificacion">
        <option value="" disabled <?php echo !$create ? 'selected' : ''; ?>>Selecciona una calificación</option>
        <?php
        $selectedCalificacion = $create ? (int) $movieEdit['calificacion'] : null;  // Solo el primer dígito

        for ($i = 1; $i <= 10; $i++) {
            $selected = $selectedCalificacion === $i ? 'selected' : '';
            echo "<option value='$i' $selected>$i</option>";
        }
        ?>
      </select>
      <?php if (isset($errores['calificacion'])) : ?>
      <p class="text-danger fs-6 mx-5"><?php echo $errores['calificacion'] ?></p>
      <?php endif; ?>

      <!-- SELECT SECCION -->
      <label for=" seccion">Sección</label>
      <select name="seccion" id="seccion">
        <option value="" disabled <?php echo !$create || empty($movieEdit['seccion']) ? 'selected' : ''; ?>>Selecciona
          una sección</option>
        <option value="list" <?php echo $create && $movieEdit['seccion'] === 'list' ? 'selected' : ''; ?>>List</option>
        <option value="tendencias" <?php echo $create && $movieEdit['seccion'] === 'tendencias' ? 'selected' : ''; ?>>
          Tendencias</option>
        <option value="aclamadas" <?php echo $create && $movieEdit['seccion'] === 'aclamadas' ? 'selected' : ''; ?>>
          Aclamadas</option>
      </select>
      <?php if (isset($errores['seccion'])) : ?>
      <p class="text-danger fs-6 mx-5"><?php echo $errores['seccion'] ?></p>
      <?php endif; ?>

      <label for="anio">Año</label>
      <input type="number" name="anio" value="<?php echo $create ? $movieEdit['anio'] : ''; ?>" />
      <?php if (isset($errores['anio'])) : ?>
      <p class="text-danger fs-6 mx-5"><?php echo $errores['anio'] ?></p>
      <?php endif; ?>

      <label for="director">Director</label>
      <input type="text" name="director" value="<?php echo $create ? $movieEdit['director'] : ''; ?>" />
      <?php if (isset($errores['director'])) : ?>
      <p class="text-danger fs-6 mx-5"><?php echo $errores['director'] ?></p>
      <?php endif; ?>

      <!-- SUBIR IMAGEN -->
      <?php if (!empty($movieEdit['imagen']) ):?>
      <img
        src="<?php echo !empty($movieEdit['imagen']) || file_exists('../uploads/image/'.$movieEdit['imagen']) ? $movieEdit['imagen'] : '../../asset/images/no-disponible.jpg' ?>"
        class="card-img-top img-card" alt="imagen pelicula">
      <?php endif; ?>

      <input type="file" name="imagen">
      <?php if (isset($errores['imagen'])) : ?>
      <p class="text-danger fs-6 mx-5"><?php echo $errores['imagen'] ?></p>
      <?php endif; ?>
      <input type="submit" value="enviar" class="mt-3" />
    </form>
    <!--		<footer class="container-fluid">-->
    <!--			 links de navagación - footer -->
    <!--			<div class="container-fluid py-5 text-center position-relative">-->
    <!--				<div class="row mb-2 mb-md-0">-->
    <!--					<div class="col-12">-->
    <!--						<nav class="footer_links d-flex justify-content-center">-->
    <!--							<ul-->
    <!--								class="footer_list_links d-flex row-gap-3 w-100 flex-md-row flex-column justify-content-md-evenly align-items-center p-0">-->
    <!--								<li class="footer_item">-->
    <!--									<a href="#" class="footer_link">Términos y condiciones</a>-->
    <!--								</li>-->
    <!--								<li class="footer_item">-->
    <!--									<a href="#" class="footer_link">Preguntas frecuentes</a>-->
    <!--								</li>-->
    <!--								<li class="footer_item">-->
    <!--									<a href="#" class="footer_link">Ayuda</a>-->
    <!--								</li>-->
    <!--								<li class="footer_item">-->
    <!--									<a href="#" class="footer_link">Contacto</a>-->
    <!--								</li>-->
    <!--							</ul>-->
    <!--						</nav>-->
    <!--					</div>-->
    <!--				</div>-->
    <!---->
    <!--				CopyRight -->
    <!--				<div class="row w-100 text-center bottom-0 position-absolute">-->
    <!--					<div class="col">-->
    <!--						<p class="footer_copyRight">-->
    <!--							&copy; CAC - PHP-ERROR 404 - 2024-->
    <!--						</p>-->
    <!--					</div>-->
    <!--				</div>-->
    <!--			</div>-->
    <!--		</footer>-->
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
  </script>


  <!-- CDN sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- helper para mostrar modal sweetalert2 enviandole los datos necesarios -->
  <?php
    if(isset($_SESSION['messages'])){
      echo modalSweetAlert($_SESSION['messages']['title'], $_SESSION['messages']['message'], $_SESSION['messages']['icon']);
    }
    unset($_SESSION['messages']);
  ?>

</body>

</html>