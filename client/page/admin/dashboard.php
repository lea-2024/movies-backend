<?php
	require '../../../api/crud.php';
	require '../../../helpers/functions.php';
	session_start();
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

	if (!$user) {
		header('Location: ../../../index.php');
		exit; // Detén la ejecución del script
	}
	
	// Verifica si el usuario tiene el rol de administrador
	if ($user['rol'] !== 'admin') {
		// Si el usuario no es administrador, redirige al índice
		header('Location: ../../../index.php');
		exit; // Detén la ejecución del script
	}


	$peliculas = getAllMoviesBack();
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CDN - Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Fuente Nunito - Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet" />

  <!-- Animate CSS - animaciones -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- Link estilos -->
  <!-- Estilos Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <!--Estilos Pikaday-->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css" />

  <!-- Estilos datatables	-->
  <link rel="stylesheet" href="../../asset/css/datatables_2.css">
  <link rel="stylesheet" href="../../asset/css/datatables.css">

  <!-- Estilos personalizados-->
  <link rel="stylesheet" href="../../asset/css/styles.css" />

  <!-- Icono Pestaña -->
  <link rel="shortcut icon" href="../../asset/images/film.ico" type="image/x-icon" />

  <!-- Título de la Pestaña -->
  <title>CAC-movies | Panel-Admin</title>
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

  <?php if ($user) : ?>
  <?php if ($user['rol'] == 'admin') : ?>
  <main class="container-fluid p-5 container-api">
    <div class="d-flex align-items-center justify-content-between">
      <h1 class="fs-3">Administrador de Películas</h1>
      <a href="formMovie.php" class="link_movie-add"><i class="fa-regular fa-file"></i>Agregar</a>
    </div>
    <section class="mt-5">
      <?php if (count($peliculas) == 0) : ?>
      <h3 class="fs-5 text-center">No hay ninguna pelicula en el sistema</h3>
      <?php else : ?>
      <div class="row">
        <div class="col">
          <div class="table-responsive">
            <table class="table table-dark table-hover table-bordered my-4" id="myTable">
              <thead>
                <tr class="text-center">
                  <th style="background-color:#00000025">COD</th>
                  <!--									<th style="background-color:#00000025">Imágen</th>-->
                  <th style="background-color:#00000025">Nombre</th>
                  <!--									<th style="background-color:#00000025">Descripción</th>-->
                  <th style="background-color:#00000025">Género</th>
                  <!--									<th style="background-color:#00000025">Calificación</th>-->
                  <th style="background-color:#00000025">Año</th>
                  <th style="background-color:#00000025">Director</th>
                  <th style="background-color:#00000025">Sección</th>
                  <th style="background-color:#00000025">Activo</th>
                  <th style="background-color:#00000025">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($peliculas as $indice => $pelicula) : ?>
                <tr>
                  <td class="text-center align-middle"><?php echo $pelicula['id_pelicula'] ?></td>
                  <td class="align-middle"><?php echo $pelicula['nombre'] ?></td>
                  <td class="align-middle"><?php echo $pelicula['genero'] ?></td>
                  <td class="text-center align-middle"><?php echo $pelicula['anio'] ?></td>
                  <td class="align-middle"><?php echo $pelicula['director'] ?></td>
                  <td class="align-middle"><?php echo $pelicula['seccion'] ?></td>
                  <td class="text-center align-middle"><input type="checkbox"
                      id="estado<?php echo $pelicula['id_pelicula'] ?>"
                      onchange="changeStatus(<?php echo $pelicula['id_pelicula'] ?>)" name="estado"
                      <?php echo $pelicula['estado'] == 1 ? 'checked' : '' ?>></td>
                  <td class="align-middle">
                    <div class="d-flex justify-content-center align-items-center gap-3">
                      <a role="button" data-bs-toggle="modal"
                        data-bs-target="#pelicula<?php echo $pelicula['id_pelicula'] ?>">
                        <i class="fa-regular fa-eye bg-none text-light text-hover" title="Vista Previa"></i>
                      </a>


                      <a href="formMovie.php?id=<?php echo $pelicula['id_pelicula'] ?>">
                        <i class="fa-regular fa-pen-to-square text-pink text-hover" title="Editar"></i>
                      </a>
											<!-- Eliminar película -->
                      <form action="deleteMovie.php" method="POST" id="formDelete<?php echo $pelicula['id_pelicula']?>">
                        <input type="hidden" name="id" value="<?php echo $pelicula['id_pelicula'] ?>">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" onclick="confirmDelete('formDelete', <?php echo $pelicula['id_pelicula']?>)" class="link-delete text-hover">
	                        <i class="fa-regular fa-trash-can text-danger text-hover" title="Eliminar"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                <!-- archivo para mostrar el modal de vista previa-->
                <?php include '../../components/modal-preview.php' ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div id="message" data-active="<?php echo $active ?>" data-message="<?php echo $message ?>"></div>
      <?php endif ?>
    </section>
  </main>
  <?php endif; ?>
  <?php endif; ?>


  <!-- CDN sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- helper para mostrar modal sweetalert2 enviandole los datos necesarios -->
  <?php
    if(isset($_SESSION['messages'])){
      echo modalSweetAlert($_SESSION['messages']['title'], $_SESSION['messages']['message'], $_SESSION['messages']['icon']);
    }

    unset($_SESSION['messages']);
  ?>


  <!--	JQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!--Script Bootstrap  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>

  <!--	script datatables -->
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>

  <!--	Custom Script  -->
  <script src="../../asset/js/api_movies.js"></script>
  <!-- Cargar Script para la actualicación de estado: activo / inactivo -->
  <script src="../../asset/js/change_status.js"></script>
</body>

</html>