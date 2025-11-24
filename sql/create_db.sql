CREATE DATABASE IF NOT EXISTS clinica;
USE clinica;
CREATE TABLE IF NOT EXISTS pacientes (
    cedula VARCHAR(20) PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    direccion VARCHAR(150),
    fecha_nacimiento DATE
);

INSERT INTO pacientes (cedula, nombres, apellidos, telefono, direccion, fecha_nacimiento) VALUES
('10000001', 'Andrés', 'Pérez', '3001234567', 'Cll 1 #1-01', '1980-01-10'),
('20000002', 'Luisa', 'Martínez', '3007654321', 'Carrera 5 #10-20', '1992-07-22')
ON DUPLICATE KEY UPDATE nombres=VALUES(nombres);
