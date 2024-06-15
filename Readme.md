# Proyecto Movies CAC - 2024

[Sitio Web CAC-Movie](https://lea-2024.github.io/proyecto-movies/)

---
####  Crear la base de datos si no existe
```sql
CREATE DATABASE IF NOT EXISTS movies_db;
```
#### Seleccionar la base de datos
```sql
USE movies_db;
```
#### Crear la tabla usuarios
```sql
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_nac VARCHAR(255) NOT NULL,
    pais VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') DEFAULT 'usuario',
    CONSTRAINT chk_rol CHECK (rol IN ('admin', 'usuario'))
);
```
#### Crear la tabla peliculas
```sql
CREATE TABLE IF NOT EXISTS peliculas (
  id_pelicula int UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre varchar(200) NOT NULL,
  descripcion text NOT NULL,
  genero varchar(150) NOT NULL,
  anio int NOT NULL,
  calificacion tinyint NOT NULL,
  director varchar(255) NOT NULL,
  imagen varchar(35) NOT NULL,
  seccion varchar(100) NOT NULL,
  estado tinyint NOT NULL DEFAULT 1,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_pelicula)
);
```