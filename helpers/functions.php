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
  ?>