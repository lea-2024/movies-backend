# Proyecto Movies CAC - 2024

[Sitio Web CAC-Movie](https://lea-2024.github.io/proyecto-movies/)

---

# Tecnología

| HTML5 |CSS3   |JavaScript   | PHP   |Bootstrap   | MySql   |
| ------------ | ------------ | ------------ | ------------ | ------------ || ------------ |
| <img src ="./client/asset/images/tecnologias/html5.png"/>|<img src ="./client/asset/images/tecnologias/css3.png">|<img src ="./client/asset/images/tecnologias/js.png"/>|<img src ="./client/asset/images/tecnologias/php.png"/>|<img src ="./client/asset/images/tecnologias/bootstrap4.png"/>|<img src ="./client/asset/images/tecnologias/mysql.png"/> |





---

#### Crear la base de datos si no existe

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

#### Crear la tabla peliculas

```sql
CREATE TABLE IF NOT EXISTS peliculas (
  id_pelicula INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(200) NOT NULL,
  descripcion TEXT NOT NULL,
  genero VARCHAR(150) NOT NULL,
  anio INT NOT NULL,
  calificacion DECIMAL(4,3) NOT NULL DEFAULT 1,
  director VARCHAR(255) NOT NULL,
  imagen VARCHAR(255) NOT NULL,
  seccion VARCHAR(100),
  estado TINYINT NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_pelicula)
);
```

---

#### Pegar esta direccion en la url y crea las peliculas en la base de datos

```markdown
localhost/movies-backend/api/unload/uploadmovies
```

---
