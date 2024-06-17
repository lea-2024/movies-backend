<?php
require 'connect.php';
// ---------------------------------------------------------------------------------------------------
//                                            CRUD DE USUARIOS
// ---------------------------------------------------------------------------------------------------
// Crear usuario
function createUser($email, $password, $nombre, $apellido, $fecha_nac, $pais, $rol = 'usuario') {
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (email, password, nombre, apellido, fecha_nac, pais, rol) VALUES (:email, :password, :nombre, :apellido, :fecha_nac, :pais, :rol)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':fecha_nac', $fecha_nac);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':rol', $rol);

    return $stmt->execute();
}

// Obtener usuario por email
function getUserByEmail($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obtener usuario por ID
function getUserById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obtener todos los usuarios
function getAllUsers() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM usuarios");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Actualizar usuario
function updateUser($id, $email, $nombre, $apellido, $fecha_nac, $pais, $rol) {
    global $conn;
    $stmt = $conn->prepare("UPDATE usuarios SET email = :email, nombre = :nombre, apellido = :apellido, fecha_nac = :fecha_nac, pais = :pais, rol = :rol WHERE id = :id");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':fecha_nac', $fecha_nac);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':rol', $rol);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

// Eliminar usuario
function deleteUser($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

// Login de usuario
function loginUser($email, $password) {
    $user = getUserByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

// ---------------------------------------------------------------------------------------------------
//                                            CRUD DE USUARIOS
// ---------------------------------------------------------------------------------------------------
  
  // ---------------------------------------------------------------------------------------------------
  //                                          CRUD DE PELICULAS
  // ---------------------------------------------------------------------------------------------------
  
  // trae todas las peliculas
function getAllMovies(){
  global $conn;

  try {
    $stmt = $conn->query("SELECT * FROM peliculas");
    $peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $peliculas;
  } catch (PDOException $e){
    echo "Error al obtener datos: ". $e->getMessage();
  }
}

// trae las peliculas por seccion
function getMoviesBySection($seccion) {
  global $conn;

  try {
      $stmt = $conn->prepare("SELECT * FROM peliculas WHERE seccion = :seccion");
      $stmt->bindParam(':seccion', $seccion);
      $stmt->execute();
      $peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $peliculas;
  } catch (PDOException $e) {
      echo "Error al obtener datos: " . $e->getMessage();
  }
}

  // Obtener pelicula por nombre
  function searchMoviesByName($name) {
    global $conn;
  
    try {
      $stmt = $conn->prepare("SELECT * FROM peliculas WHERE nombre LIKE :name");
      $stmt->execute(['name' => '%' . $name . '%']);
      $peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $peliculas;
    } catch (PDOException $e){
      echo "Error al obtener datos: ". $e->getMessage();
    }
  }