<?php
require '../../../api/connect.php';
require '../../../api/crud.php';
require '../../../helpers/functions.php';
global $conn;
  
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$genero = $_POST['genero'];
$calificacion = floatval($_POST['calificacion']);
$seccion = $_POST['seccion'];
$anio = intval($_POST['anio']);
$director = $_POST['director'];
$imagen = $_FILES['imagen'];

// validar si los campos no estan vacios

if ($_SERVER['REQUEST_METHOD'] === "POST") {
// array de errores
$errores = [];

  if (empty($_POST['nombre'])) {
      $errores['nombre'] = 'El nombre es obligatorio';
  }
  if (empty($_POST['descripcion'])) {
      $errores['descripcion'] = 'La descripción es obligatoria';
  }
  if (empty($_POST['genero'])) {
      $errores['genero'] = 'El género es obligatorio';
  }
  if (empty($_POST['calificacion'])) {
      $errores['calificacion'] = 'La calificación es obligatoria';
  }
  if (empty($_POST['seccion'])) {
      $errores['seccion'] = 'La sección es obligatoria';
  }
  if (empty($_POST['anio'])) {
      $errores['anio'] = 'El año es obligatorio';
  }
  if (empty($_POST['director'])) {
      $errores['director'] = 'El director es obligatorio';
  }
  // VALIDAR IMAGEN
  if (empty($_FILES['imagen']['name'])) {
    $errores['imagen'] = 'La imagen es obligatoria';
  }
  elseif($_FILES['imagen']['size'] >= 1000000) {
    $errores['imagen'] = 'La imagen es muy grande';
  }
  elseif($_FILES['imagen']['type'] !== 'image/png' && $_FILES['imagen']['type'] !== 'image/jpeg') {
    $errores['imagen'] = 'La imagen no tiene la extensión correcta';
  }
}
 /*
?======================GUARDAR IMAGEN======================
*/

// Definir la carpeta de destino
$rutaDestino = '../../asset/uploads/img_';

// Verificar si se cargó correctamente la imagen
if ($imagen['error'] === UPLOAD_ERR_OK) {
  // Obtener la ruta completa de la imagen
  $rutaImagen = $rutaDestino . $imagen['name'];

  // Verificar si la imagen existe en la carpeta de destino
  if (file_exists($rutaImagen)) {
    echo 'La imagen ya existe en la carpeta de destino'.'<br>';
    echo '<script>alert("La imagen ya existe")</script>';
  } else {
    // Verificar el tamaño de la imagen
    if ($_FILES['imagen']['size'] <= 1000000) {
      // Verificar la extensión de la imagen
      if(!in_array($imagen['type'], ['image/png', 'image/jpeg'])) {
          echo 'La imagen no tiene la extensión correcta!!'.'<br>';
      }
    } else {
      echo 'La imagen es demasiado grande'.'<br>';
    }
  }
}

// Validar si la imagen ya existe en la base de datos

$sql_check_image = 'SELECT * FROM peliculas WHERE imagen = :rutaImagen';

$result = $conn->prepare($sql_check_image);
$result->bindParam(':rutaImagen', $rutaImagen);
$result->execute();
if($result->rowCount() > 0){
  $errores['imagen'] = 'La imagen ya existe, por favor cargue nuevamente la pelicula o cambie la imagen';
}

// si contiene errores el array
if (count($errores) > 0) {
  session_start();
  $_SESSION['errores'] = $errores; // guarda el array errores en la session con el nombre errores
  header('Location:formMovies.php');
  
}

// si no hay errores, inserto los datos

if (empty($errores)) {
  /*
  ?======================iNSERTAR DATOS====================
  */
  // Verificar si ya existe un registro con los mismos valores
  $movie_exists = movie_exists($nombre,$descripcion,$genero, $calificacion, $seccion, $anio, $director);
  
  if ($movie_exists) {
      echo '<script type="text/javascript">
      alert("ya existe un registro con estos datos.Por favor cargue nuevamente la pelicula o cambie los datos");
      window.location.href="formMovies.php";
      </script>';
  } else {
    // si no existe insertar los datos y guarda la imágen en uploads
    $tempURL = $imagen['tmp_name'];
    $movie = storeMovie($nombre, $descripcion, $genero, $calificacion, $seccion, $anio, $director, $rutaImagen, $tempURL);
    
    // si el proceso fue correcto muestra mensaje
    if($movie){
      echo
      '<script type="text/javascript">
        alert("Pelicula cargada con exito");
        window.location.href="formMovies.php";
      </script>';
    } else {
    echo
    '<script type="text/javascript">
      alert("Error al cargar la pelicula");
      window.location.href="formMovies.php";
      </script>';
    }
  }
};
?>