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
---