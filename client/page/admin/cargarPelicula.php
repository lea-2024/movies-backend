<?php

session_start();

//si existe la variable de sesion errores se almacena en el array
if (isset($_SESSION['errores'])) {
  $errores = $_SESSION['errores'];
}



// eliminamos la variable de sesion - Los datos ya quedaron almacenados en la variable
unset($_SESSION['errores']);



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
	<link rel="stylesheet" href="../../asset/css/styles.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<title>Cargar Películas</title>
</head>

<body class="peliculas_contianer">
	<section>
		<form action="registroPeliculas.php" method="post" class="form-peliculas" enctype=multipart/form-data>
			<h1 class="text-center p-2 h1-form">Cargar Películas</h1>
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" />
			<?php if (isset($errores['nombre'])) : ?>
			<p class="text-danger fs-6 mx-5"><?php echo $errores['nombre'] ?></p>
			<?php endif; ?>

			<label for="">Descripción</label>
			<textarea name="descripcion" id="" class="descripcion"></textarea>
			<?php if (isset($errores['descripcion'])) : ?>
			<p class="text-danger fs-6 mx-5"><?php echo $errores['descripcion'] ?></p>
			<?php endif; ?>

			<label for="genero">Género</label>
			<input type="text" name="genero" placeholder="separar con coma los Género" />
			<?php if (isset($errores['genero'])) : ?>
			<p class="text-danger fs-6 mx-5"><?php echo $errores['genero'] ?></p>
			<?php endif; ?>

			<!-- SELECT CALIFICACION -->
			<label for="calificacion">Calificación</label>
			<select name="calificacion" id="">

				<option value="" disabled selected>
					Selecciona una calificación
				</option>
				<?php
                    for ($i = 1; $i <= 10; $i++) {
                    echo "<option value='$i'>$i</option>";
                    }
                    ?>
			</select>
			<?php if (isset($errores['calificacion'])) : ?>
			<p class="text-danger fs-6 mx-5"><?php echo $errores['calificacion'] ?></p>
			<?php endif; ?>

			<!-- SELECT SECCION -->
			<label for=" seccion">Sección</label>
			<select name="seccion" id="">
				<option value="" disabled selected>
					Selecciona una sección
				</option>
				<option value="tendencias">Tendencias</option>
				<option value="aclamadas">Aclamadas</option>
			</select>
			<?php if (isset($errores['seccion'])) : ?>
			<p class="text-danger fs-6 mx-5"><?php echo $errores['seccion'] ?></p>
			<?php endif; ?>

			<label for="anio">Año</label>
			<input type="number" name="anio" />
			<?php if (isset($errores['anio'])) : ?>
			<p class="text-danger fs-6 mx-5"><?php echo $errores['anio'] ?></p>
			<?php endif; ?>

			<label for="director">Director</label>
			<input type="text" name="director" />
			<?php if (isset($errores['director'])) : ?>
			<p class="text-danger fs-6 mx-5"><?php echo $errores['director'] ?></p>
			<?php endif; ?>

			<!-- SUBIR IMAGEN -->
			<input type="file" name="imagen">
			<?php if (isset($errores['imagen'])) : ?>
			<p class="text-danger fs-6 mx-5"><?php echo $errores['imagen'] ?></p>
			<?php endif; ?>

			<input type="submit" value="enviar" />
		</form>
		<footer class="container-fluid">
			<!-- links de navagación - footer -->
			<div class="container-fluid py-5 text-center position-relative">
				<div class="row mb-2 mb-md-0">
					<div class="col-12">
						<nav class="footer_links d-flex justify-content-center">
							<ul
								class="footer_list_links d-flex row-gap-3 w-100 flex-md-row flex-column justify-content-md-evenly align-items-center p-0">
								<li class="footer_item">
									<a href="#" class="footer_link">Términos y condiciones</a>
								</li>
								<li class="footer_item">
									<a href="#" class="footer_link">Preguntas frecuentes</a>
								</li>
								<li class="footer_item">
									<a href="#" class="footer_link">Ayuda</a>
								</li>
								<li class="footer_item">
									<a href="#" class="footer_link">Contacto</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>

				<!-- CopyRight -->
				<div class="row w-100 text-center bottom-0 position-absolute">
					<div class="col">
						<p class="footer_copyRight">
							&copy; CAC - PHP-ERROR 404 - 2024
						</p>
					</div>
				</div>
			</div>
		</footer>
	</section>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
		integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
	</script>

</body>

</html>