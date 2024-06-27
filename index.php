<?php
include 'conexion.php';

require './api/crud.php';
session_start();

// Comprobar si el usuario ha iniciado sesión
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CDN - Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Fuente Nunito - Google Fonts -->
  <link rel="pre<connect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet" />

  <!-- Animate CSS - animaciones -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!-- Link estilos -->
  <!-- Estilos Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

  <!-- Estilos personalizados-->
  <link rel="stylesheet" href="./client/asset/css/styles.css" />

  <!-- Icono Pestaña -->
  <link rel="shortcut icon" href="./client/asset/images/film.ico" type="image/x-icon" />
  <!-- Título de la Pestaña -->
  <title>CAC-MOVIES | Inicio</title>
</head>

<body>
  <!-- Encabezado - logo - nombre y menú -->
  <header>
    <nav class="header_nav_links">
      <!-- Icono y logo -->
      <a href="index.php" class="header_logo">
        <i class="fas fa-film"></i>
        <span>CAC-Movies</span>
      </a>
      <!--botón toggle menú responsive-->
      <div class="btn_menu_toggle">
        <i class="fa-solid fa-bars btn_menu_toggle-open btn_menu-active" id="btnMenuOpen"></i>
        <i class="fa-solid fa-xmark btn_menu_toggle-close" id="btnMenuClose"></i>
      </div>
      <!-- Links de navegación -->
      <ul class="header_list_links mt-md-3" id="headerListLinks">
        <li class="header_items">
          <a href="#trends" class="header_link">Tendencias</a>
        </li>
        <li class="header_items">
          <a href="#acclaimeds" class="header_link">Aclamadas</a>
        </li>
        <li class="header_items">
          <a href="./client/page/rick_y_morty.html" class="header_link-login header_link-api">Rick y Morty</a>
        </li>

        <?php if ($user) : ?>
          <?php if ($user['rol'] == 'admin') : ?>
            <li class="header_items">
              <a href="./client/page/admin/dashboard.php" class="header_link-login header_link-api">Panel Admin</a>
            </li>
          <?php endif; ?>
          <li class="header_items">
            <a href="./api/logout.php" class="header_link-login">Cerrar sesión</a>
          </li>
          <span class="bienvenido">Bienvenido, <?php echo htmlspecialchars($user['nombre']); ?></span>
        <?php else : ?>
          <li class="header_items">
            <a href="./client/page/register.php" class="header_link-login">Iniciar Sesión</a>
          </li>
        <?php endif; ?>

        <!-- <li class="header_items">
            <a href="./client/page/register.php" class="header_link">Registrarse</a>
          </li> -->

      </ul>
    </nav>
  </header>
  <!-- Fin encabezado-->

  <!-- Contenido principal del sitio -->
  <main class="container-fluid main_container" id="mainContainer">
    <!-- Registrarse -->
    <div class="row text-center">
      <div class="col p-0">
        <section class="main_register animate__animated animate__zoomIn animate_faster">
          <h1 class="main_register-title">
            Películas y series ilimitadas
            <br />
            en un solo lugar
          </h1>
          <h2 class="main_register-subTitle no-margin">
            Disfruta donde quieras.
          </h2>
          <h2 class="main_register-subTitle">
            Cancela en cualquier momento.
          </h2>
          <?php if (!$user) : ?>
            <a href="./client/page/register.php" class="main_register_btn">Registrate</a>
          <?php endif; ?>
        </section>
      </div>
    </div>

    <!-- Buscar películas -->
    <section class="container text-center main_search_container" id="searchContainer">
      <div class="row">
        <div class="col">
          <h2 class="main_search_title">¿Qué estas buscando para ver?</h2>
          <!-- Formulario para buscar películas -->
          <div class="row">
            <div class="col-md-8 col-12 offset-md-2 col-lg-6 offset-lg-3 offset-0">
              <!-- <form class="d-flex flex-column flex-sm-row mt-4 align-items-center justify-content-center gap-2 main_search_form"> -->

              <form id="searchForm" method="GET" action="#searchContainer" class="d-flex flex-column flex-sm-row mt-4 align-items-center justify-content-center gap-2 main_search_form">

                <input type="search" name="search" id="search" placeholder="Buscar..." class="h-50 main_search_input" />
                <input type="submit" value="Buscar" class="main_search_btn" />

                <button type="button" id="clearButton" onclick="clearSearch()" class="main_search_btn"">Limpiar</button>

              </form>

              <div id="searchAncla">
              </div>
               
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Separar sección con línea -->
    <hr class="line_divisor" />
    <div id="resultados" class="mt-5">
      <h2>Resultados</h2>
      <div class="row mt-5">
        <div class="col d-flex flex-wrap justify-content-center align-items-center column-gap-sm-3 gap-5 gap-lg-5">
          <?php
          if (isset($_GET['search'])) {
            $name = $_GET['search'];
            $resultados = searchMoviesByName($name);

            if (!empty($resultados)) {
              foreach ($resultados as $pelicula) {
                echo '<div class="trend_container">';
                echo '<a href="pelicula.php?id=' . $pelicula["id_pelicula"] . '" class="trend_container_link">';
                echo '<img src="' . htmlspecialchars($pelicula['imagen']) . '" alt="' . htmlspecialchars($pelicula['nombre']) . '" class="trend_image" />';
                echo '<div class="trend_container-hover">';
                echo '<h4 class="trend_title-hover" title="' . htmlspecialchars($pelicula['nombre']) . '">';
                echo htmlspecialchars($pelicula['nombre']);
                echo '</h4>';
                echo '<p class="trend_review-hover">⭐⭐⭐</p>';
                echo '<img src="./client/asset/images/film.ico" alt="icono pelicula" class="trend_image-hover" />';
                echo '</div>';
                echo '</a>';
                echo '</div>';
              }
            } else {
              echo "No se encontraron películas.";
            }
          }
          ?>
        </div>
      </div>
      <div class="mb-5"></div>
    </div>


    <!-- Separar sección con línea -->
    <hr class="line_divisor" />

    <!-- Sección de películas Tendencias-->
    <!-- Contenedor Tendencias -->
    <section class="container p-5 trends_container" id="trends">
      <div class="row">
        <div class="col">
          <h3 class="text-center fs-2">Las tendencias de hoy</h3>
        </div>
      </div>

      <!-- Contenedor Películas    -->
      <?php
      // query de insercion
      $query = "SELECT * FROM movies_db.peliculas WHERE seccion='tendencias'";
      $consulta = mysqli_query($conexion, $query);
      ?>
      <div class="row mt-5">
        <div class="col d-flex flex-wrap justify-content-center align-items-center column-gap-sm-3 gap-5 gap-lg-5">

          <!-- Tendencias -->
          <?php while ($registro = mysqli_fetch_array($consulta)) { ?>

            <div class="trend_container">
              <a href="pelicula.php?id=<?php echo $registro['id_pelicula'] ?>" class="trend_container_link">
                <img src="<?php echo $registro['imagen'] ?>" alt="The Beekeeper" class="trend_image" />
                <div class="trend_container-hover">
                  <h4 class="trend_title-hover" title="The Beekeeper"><?php echo $registro['nombre'] ?></h4>
                  <p class="trend_review-hover">
                    <?php for ($i = 0; $i < $registro['calificacion']; $i = $i + 2) {
                      echo '⭐';
                    }
                    ?>
                  </p>
                  <img src="./client/asset/images/film.ico" alt="icono pelicula" class="trend_image-hover" />
                </div>
              </a>
            </div>

          <?php } ?>

        </div>
      </div>
      <!-- Fin peliculas tendencias-->
      <!-- Botones anterior - siguiente -->
      <div class="row text-center mt-5">
        <div class="col d-flex gap-4 justify-content-center align-items-center">
          <button class="main_trends_btn" id="btnTrendPrev">Anterior</button>
          <button class="main_trends_btn" id="btnTrendNext">Siguiente</button>
        </div>
      </div>
    </section>
    <!-- Fin contenedor tendencias -->

    <!-- Separar sección con línea -->
    <hr class="line_divisor" />

    <!-- Las más aclamadas -->
    <section class="container p-5 main_acclaimed" id="acclaimeds">
      <div class="row">
        <div class="col">
          <h3 class="text-center fs-2">Las más aclamadas</h3>
        </div>
      </div>
      <!-- Contenedor aclamadas -->
      <?php
      // query de insercion
      $query = "SELECT * FROM movies_db.peliculas WHERE seccion='aclamadas'";
      $consulta = mysqli_query($conexion, $query);
      ?>
      <div class="row acclaimeds">
        <div class="col position-relative p-md-5">
          <section class="d-flex gap-md-5 gap-3 mt-5 mt-md-0 px-md-3 align-items-center acclaimeds_container" id="acclaimedsContainer">
            <button class="position-absolute start-0 fs-2 acclaimed_btn" id="acclaimedBtnPrev">
              <i class="fa-solid fa-angle-left"></i>
            </button>
            <button class="position-absolute end-0 fs-2 acclaimed_btn" id="acclaimedBtnNext">
              <i class="fa-solid fa-angle-right"></i>
            </button>

            <?php while ($registro = mysqli_fetch_array($consulta)) { ?>
              <div class="acclaimed_container">
                <a href="pelicula.php?id=<?php echo $registro['id_pelicula'] ?>">
                  <img src="<?php echo $registro['imagen'] ?>" alt="aclamada 1" class="acclaimed_image" />
                </a>
              </div>
            <?php } ?>

          </section>
        </div>
      </div>
      <!-- Fin contenedor aclamadas-->
    </section>
    <!-- Fin peliculas aclamadas -->
  </main>
  <!-- Fin contenido principal -->
  <!-- Footer - Links de navegación - Botón ir a top  -->
  <footer class="container-fluid">
    <!-- links de navagación - footer -->
    <div class="container-fluid py-5 text-center position-relative">
      <div class="row mb-2 mb-md-0">
        <div class="col-12">
          <nav class="footer_links d-flex justify-content-center">
            <ul class="footer_list_links d-flex row-gap-3 w-100 flex-md-row flex-column justify-content-md-evenly align-items-center p-0">
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
          <p class="footer_copyRight">&copy; CAC - PHP-ERROR 404 - 2024</p>
        </div>
      </div>
    </div>

    <!-- Botón ir arriba-->
    <a class="btn_top" id="btnTop">
      <img src="./client/asset/images/flecha-hacia-arriba.svg" alt="Ir arriba flecha" class="btn_top_image" />
    </a>
  </footer>
  <!-- Fin footer-->
  <!-- Enlace script index.js-->
  <script src="./client/asset/js/index.js"></script>
  <script src="./client/asset/js/search.js"></script>
</body>

</html>