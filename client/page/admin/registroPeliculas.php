<?php
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
    $rutaDestino = 'C:\xampp\htdocs\movies-backend\client\asset\upload\img_';

    // Verificar si se cargó correctamente la imagen
    if ($imagen['error'] === UPLOAD_ERR_OK) {
        // Obtener la ruta completa de la imagen
        $rutaImagen = $rutaDestino . $imagen['name'];
    
        // Verificar si la imagen existe en la carpeta de destino
        if (file_exists($rutaImagen)) {
            echo 'La imagen ya existe en la carpeta de destino'.'<br>';
        } else {
            // Verificar el tamaño de la imagen
            if ($_FILES['imagen']['size'] <= 1000000) {
                // Verificar la extensión de la imagen
                if(in_array($imagen['type'], ['image/png', 'image/jpeg'])) {
                    // Si no existe, mover el archivo a la carpeta de destino
                    if (move_uploaded_file($imagen['tmp_name'], $rutaImagen)) {
                        echo 'La imagen se movió correctamente a la carpeta de destino'.'<br>';
                    } else {
                        // Error al mover la imagen
                        echo 'Error al mover la imagen a la carpeta de destino'.'<br>';
                    }
                } else {
                    echo 'La imagen no tiene la extensión correcta!!'.'<br>';
                }
            } else {
                echo 'La imagen es demasiado grande'.'<br>';
            }
        }
    } else {
        echo 'Error al cargar la imagen';
    }
        
    




    /*
    !================CONEXION A LA BASE DE DATOS=========== 
    */

    //conexion a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "movies_db";

    // Crear la conexión
    $conexion = new mysqli($servername, $username, $password, $dbname);
    // Verificar la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }


    // Validar si la imagen ya existe en la base de datos

    $existeImg= 'SELECT * FROM peliculas WHERE imagen = "'.$rutaImagen.'"';

    $result = mysqli_query($conexion, $existeImg);

    if (mysqli_num_rows($result) > 0) {
        $errores['imagen'] = 'La imagen ya existe, porfavor cargue nuevamente la pelicula o cambie la imagen';
        
    }

    
  
    // si contiene errores el array
    if (count($errores) > 0) {
      session_start();
      $_SESSION['errores'] = $errores; // guarda el array errores en la session con el nombre errores
      header('Location:cargarPelicula.php');
      
    }

    // si no hay errores, inserto los datos

    if (empty($errores)) {
    
    /*
    ?======================iNSERTAR DATOS====================
    */

    // Verificar si ya existe un registro con los mismos valores
    $sqlCheck = "SELECT * FROM peliculas WHERE nombre = '$nombre' AND descripcion = '$descripcion' AND genero = '$genero'
    AND calificacion = '$calificacion' AND seccion = '$seccion' AND anio = '$anio' AND director = '$director'";
    $resultCheck = mysqli_query($conexion, $sqlCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        echo '<script type="text/javascript">
        alert("ya existe un registro con estos datos.Porfavor cargue nuevamente la pelicula o cambie los datos");
        window.location.href="cargarPelicula.php";
        </script>';
    } else {
        // si no existe insertar los datos
        $sql = "INSERT INTO peliculas (nombre, descripcion, genero, calificacion, seccion, anio, director,imagen) VALUES ('$nombre', '$descripcion', '$genero', '$calificacion', '$seccion', '$anio', '$director','$rutaImagen')";

        // Ejecutar la consulta
        if (mysqli_query($conexion, $sql) ) {
        echo '<script type="text/javascript">
            alert("Pelicula cargada con exito");
            window.location.href="dashboard.php";
            </script>';

        
        } else {
            echo "Error al insertar los datos: " . mysqli_error($conexion);
        }
    }


    //!!===Cerrar la conexión===
    mysqli_close($conexion);



};

?>