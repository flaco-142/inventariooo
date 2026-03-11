-- Crear base de datos
CREATE DATABASE IF NOT EXISTS inventariooo;
USE inventariooo;

-- ==========================================
-- Tabla de usuarios
-- ==========================================
DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(100) UNIQUE NOT NULL,
    clave VARCHAR(255) NOT NULL,
    rol ENUM('admin','empleado') DEFAULT 'empleado'
);

-- Usuario de prueba (contraseña: 12345)
-- Genera el hash en PHP con: password_hash("12345", PASSWORD_BCRYPT)
INSERT INTO usuarios (correo, clave, rol) VALUES
('usuario@valledechalco.gob.mx', '$2y$10$Y5bR8tTL6Pw3j7OhQMpdp.FAycKVpLo3jv/iC5jORSPF4lO8rMSQ6', 'admin');

-- ==========================================
-- Tabla de bienes inmuebles
-- ==========================================
DROP TABLE IF EXISTS bienes;
CREATE TABLE bienes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_registro DATE NOT NULL DEFAULT (CURDATE()),
    no_inventario VARCHAR(50) NOT NULL,
    ubicacion VARCHAR(255) NOT NULL,
    estado ENUM('Bueno','Regular','Malo') NOT NULL,
    valor DECIMAL(15,2) NOT NULL
);

-- Datos de prueba
INSERT INTO bienes (nombre, descripcion, fecha_registro, no_inventario, ubicacion, estado, valor) VALUES
('Terreno municipal', 'Terreno ubicado en zona centro', CURDATE(), 'BI-0001', 'Zona Centro', 'Bueno', 5000000.00),
('Edificio administrativo', 'Oficinas de gobierno', CURDATE(), 'BI-0002', 'Av. Alfredo del Mazo', 'Regular', 2000000.00),
('Parque público', 'Área verde registrada', CURDATE(), 'BI-0003', 'Col. Centro', 'Bueno', 1500000.00);

-- ==========================================
-- Tabla de equipos de cómputo
-- ==========================================
DROP TABLE IF EXISTS equipos;
CREATE TABLE equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    fecha_registro DATE NOT NULL DEFAULT (CURDATE())
);

-- Datos de prueba
INSERT INTO equipos (nombre, marca, modelo, fecha_registro) VALUES
('Laptop HP', 'HP', 'ProBook 450', CURDATE()),
('PC Dell', 'Dell', 'Optiplex 7010', CURDATE()),
('Impresora Canon', 'Canon', 'G3110', CURDATE());

-- ==========================================
-- Tabla de almacén
-- ==========================================
DROP TABLE IF EXISTS almacen;
CREATE TABLE almacen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    articulo VARCHAR(100) NOT NULL,
    cantidad INT DEFAULT 0,
    fecha_registro DATE NOT NULL DEFAULT (CURDATE())
);

-- Datos de prueba
INSERT INTO almacen (articulo, cantidad, fecha_registro) VALUES
('Sillas', 50, CURDATE()),
('Mesas', 30, CURDATE()),
('Cables de red', 85, CURDATE());
