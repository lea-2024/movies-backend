<?php
require '../../api/crud.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $action = $_POST['action']; // Campo oculto para diferenciar entre registro y login

  if ($action == 'register') {
    // Registro de usuario
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'] ?? null;
    $apellido = $_POST['apellido'] ?? null;
    $fecha_nac = $_POST['fecha_nac'] ?? null;
    $pais = $_POST['pais'] ?? null;

    if (createUser($email, $password, $nombre, $apellido, $fecha_nac, $pais)) {
      echo "Usuario creado exitosamente";
    } else {
      echo "Error al crear el usuario";
    }
  } elseif ($action == 'login') {
    // Inicio de sesión
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user = loginUser($email, $password)) {
      // Asume que loginUser devuelve un array con los datos del usuario, incluyendo el rol
      $_SESSION['user'] = $user;
      $rol = $user['rol']; // Obtener el rol del usuario desde el array

      if ($rol == 'admin') {
        header('Location: ../page/admin/dashboard.php'); // Ajuste de la ruta para redirigir a admin
      } else {
        header('Location: ../../index.php'); // Ajuste de la ruta para redirigir al índice
      }
      exit; // Detener la ejecución del script
    } else {
      echo "Email o contraseña incorrectos";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
	<!-- Estilos personalizados-->
	<link rel="stylesheet" href="../asset/css/styles.css" />

	<!-- Icono Pestaña -->
	<link rel="shortcut icon" href="./images/film.ico" type="image/x-icon" />

	<!-- Título de la Pestaña -->
	<title>CAC-movies | Registro</title>
</head>

<body class="register_container">
	<!-- Encabezado - logo - nombre y menú -->
	<header class="header_color">
		<nav class="header_nav_links">
			<!-- Icono y logo -->
			<a href="../../index.php" class="header_logo">
				<i class="fas fa-film"></i>
				<span>CAC-Movies</span>
			</a>
		</nav>
	</header>
	<!-- Fin encabezado-->


	<main class="register_main_container">
		<!-- Formulario de login -->
		<section class="container mb-5" id="loginSection">
			<div class="row align-items-center px-2 px-md-0">
				<div
					class="col-md-6 offset-md-3 px-md-5 px-3 px-0 py-3 mt-5 rounded-3 register_form_container animate__animated animate__fadeIn animate__slow">
					<h1 class="fs-md-3 fs-4 mt-2">Iniciar Sesión</h1>

					<form action="register.php" method="POST" class="mt-5" id="formLogin">
						<div class="col my-4">
							<input type="text" autocomplete="off" placeholder="Email" name="email" id="email"
								class="form_input w-100" />
							<div id="errorEmail"></div>
						</div>
						<div class="col my-4">
							<input type="password" autocomplete="off" name="password" id="password"
								placeholder="Contraseña" class="form_input w-100" />
							<div id="errorPassword"></div>
						</div>
						<div class="col my-4">
							<input type="hidden" name="action" value="login">
							<input type="submit" value="Ingresar" class="form_btn w-100" />
						</div>
						<div class="col my-3">
							<a href="#" id="signUpLink" class="form_link w-100">No tienes una cuenta?</a>
						</div>
					</form>
				</div>
			</div>
		</section>
		<!-- fin formulario de login  -->

		<!-- formulario de registro  -->
		<section class="container mb-5" id="signUpSection" style="display: none;">
			<div class="row align-items-center px-2 px-md-0">
				<div
					class="col-md-6 offset-md-3 px-md-5 px-3 px-0 py-3 mt-5 rounded-3 register_form_container animate__animated animate__fadeIn animate__slow">
					<h1 class="fs-md-3 fs-4 mt-2">Nuevo Usuario</h1>
					<form method="POST" action="register.php" class="mt-5">
						<div class="col my-4">
							<input type="text" name="nombre" autocomplete="off" class="form_input w-100"
								placeholder="Nombre" required />
						</div>
						<div class="col my-4">
							<input type="text" name="apellido" autocomplete="off" placeholder="Apellido"
								class="form_input w-100" required />
						</div>
						<div class="col my-4">
							<input type="email" name="email" autocomplete="off" placeholder="Email"
								class="form_input w-100" required />
						</div>
						<div class="col my-4">
							<input type="password" name="password" autocomplete="off" placeholder="Contraseña"
								class="form_input w-100" required />
						</div>
						<div class="col my-4">
							<input type="text" class="form_input w-100" id="datepicker" name="fecha_nac"
								placeholder="Seleccione una fecha" required />
						</div>
						<div class="col my-4">
							<select class="w-100 form_input form_select" required name="pais">
								<option value="" selected disabled>Seleccione un País</option>
								<option value="argentina">Argentina</option>
								<option value="colombia">Colombia</option>
								<option value="espania">España</option>
								<option value="italia">Italia</option>
								<option value="uruguay">Uruguay</option>
							</select>
						</div>
						<div class="col my-4">
							<div class="form_container_terms ms-1">
								<input type="checkbox" autocomplete="off" id="terms" required />
								<label for="terms" class="form_terms_text">Acepto términos y condiciones</label>
							</div>
						</div>
						<div class="col my-4">
							<input type="hidden" name="action" value="register">
							<input type="submit" value="Registrarse" class="form_btn w-100">
						</div>
						<div class="col my-3">
							<a href="#" class="form_link w-100" id="loginLink">Ya estás registrado?</a>
						</div>
					</form>
				</div>
			</div>
		</section>
		<!-- fin formulario de registro  -->
	</main>
	<!--enlace script index.js-->
	<script>
	document.getElementById('loginLink').addEventListener('click', function(event) {
		event.preventDefault();
		document.getElementById('loginSection').style.display = 'block';
		document.getElementById('signUpSection').style.display = 'none';
	});

	document.getElementById('signUpLink').addEventListener('click', function(event) {
		event.preventDefault();
		document.getElementById('signUpSection').style.display = 'block';
		document.getElementById('loginSection').style.display = 'none';
	});
	</script>
	<!-- Manejo de fechas - Pikaday -->
	<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
	<script src="../asset/js/register.js"></script>
	<script src="../asset/js/login.js"></script>
</body>

</html>