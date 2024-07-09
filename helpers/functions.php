<?php
  // Convertir el numero de calificación en estrellas
  function convert_ratings($number){
    $stars=null;
    
    if($number >= 0 && $number < 2){
      $stars = str_repeat('⭐',1);
    } elseif($number >= 2 && $number < 4){
      $stars = str_repeat('⭐',2);
    } elseif($number >= 4 && $number < 6){
      $stars = str_repeat('⭐',3);
    } elseif ($number >= 6 && $number < 8){
      $stars = str_repeat('⭐',4);
    } elseif ($number >= 8 && $number < 10){
      $stars = str_repeat('⭐',5);
    }
    return $stars;
  }
  
  // Convertir string de generos , para mostralos separados por un '|'
  function convert_genre($genero){
    $generos = explode(',',$genero);
    foreach ($generos as $indice => $genero){
      echo $genero, $indice < count($generos) -1 ? ' | ' : '';
    }
  }
  
  // Verificar si una pelicula ya existe en la base de datos
  function movie_exists($nombre, $descripcion, $genero, $calificacion, $seccion, $anio, $director){
    global $conn;
    $sqlCheck = "SELECT * FROM peliculas WHERE nombre = :nombre AND descripcion = :descripcion AND genero = :genero AND calificacion = :calificacion AND seccion = :seccion AND anio = :anio AND director = :director";
    $register_exists = $conn->prepare($sqlCheck);
    $register_exists->bindParam(':nombre', $nombre);
    $register_exists->bindParam(':descripcion', $descripcion);
    $register_exists->bindParam(':genero', $genero);
    $register_exists->bindParam(':calificacion', $calificacion);
    $register_exists->bindParam(':seccion', $seccion);
    $register_exists->bindParam(':anio', $anio);
    $register_exists->bindParam(':director', $director);
    
    try {
      $register_exists->execute();
      if ($register_exists->rowCount() > 0){
        return true;
      } else{
        return false;
      }
    } catch (PDOException $e){
      echo "Error al obtener datos de la DB ".$e->getMessage();
    }
  }

  // Mostrar modal de sweetAlert según el título, mensaje e icono que se requiera
  function modalSweetAlert($title, $message, $icon)
  {    
    return "
      <script>
        Swal.fire({
          title: '$title',
          text: '$message',
          icon: '$icon',
          color:'#fff',
          background:'#333333',
        });
      </script>
    ";
  }

  function generate_linkedin($name, $url)
  {
    return '<a href="'. $url .'" class="link-linkedin nav-link fs-5 text-black d-flex align-items-center my-3" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" fill="#0000FF" class="me-2" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/></svg>'. $name .'</a>';
  }