-- Script de creación de base de datos para DS6-Proyecto2

CREATE TABLE Categorias (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion TEXT
);

CREATE TABLE Productos (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion TEXT,
    Precio DECIMAL(10,2) NOT NULL,
    ID_categorias INT,
    FOREIGN KEY (ID_categorias) REFERENCES Categorias(Id)
);

CREATE TABLE Usuarios (
    NombreUsuario VARCHAR(50) PRIMARY KEY,
    Contrasena VARCHAR(255) NOT NULL,
    Rol ENUM('Admin', 'Consulta') NOT NULL
);
