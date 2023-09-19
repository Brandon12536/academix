CREATE DATABASE academix;

-- Crear la tabla users con el campo name para nombre completo
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('Estudiante', 'Docente', 'Administrador') NOT NULL,
  avatar_url VARCHAR(255),
  active TINYINT(1) DEFAULT 0, -- Nuevo campo "activo" con valor predeterminado 0
  website VARCHAR(255),
  github VARCHAR(255),
  twitter VARCHAR(255),
  instagram VARCHAR(255),
  facebook VARCHAR(255),
  linkedin VARCHAR(255),
  phone VARCHAR(15), -- Nuevo campo "teléfono"
  accept_terms TINYINT(1) DEFAULT 0 -- Nuevo campo "aceptar términos y condiciones" con valor predeterminado 0
);