<?php
  require '../../../api/crud.php';
  
if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method']=='DELETE'){
  $id = $_POST['id'];
  $messages=[];
  try{
    $deleteMovie = deleteMoviePermanently($id);
    if ($deleteMovie > 0){
      $messages['title'] = "Pelicula eliminada";
      $messages['message'] = 'La película se eliminó correctamente';
      $messages['icon'] = "success";
      session_start();
      $_SESSION['messages'] = $messages;
      header('Location:dashboard.php');
    }
  } catch (PDOException $e){
//    var_dump($e->getMessage());
    $messages['title'] = "Error al eliminar";
    $messages['message'] = 'No se pudo eliminar la película';
    $messages['icon'] = "error";
    session_start();
    $_SESSION['messages'] = $messages;
    header('Location:dashboard.php');
  }
}