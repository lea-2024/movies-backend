<?php
  
  // Convertir el numero de calificación en estrellas
  function convert_ratings($number){
    $stars;
    
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
  ?>
