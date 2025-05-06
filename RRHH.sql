CREATE DATABASE RRHH;
USE RRHH;

/*------------------- TABLAS FUERTES -------------------*/
-- Tabla de Departamento
CREATE TABLE Departamento (
    ID_Dep INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Dep VARCHAR(100) NOT NULL
);

-- Tabla de Puesto
CREATE TABLE Puesto (
    ID_Puesto INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Puesto VARCHAR(100) NOT NULL,
    SalarioBase DECIMAL(10,2) NOT NULL
);

-- Tabla de Empleado
CREATE TABLE Empleado (
    ID_Emp INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Emp VARCHAR(100) NOT NULL,
    Apellido_Emp VARCHAR(100) NOT NULL,
    DPI_Emp VARCHAR(20) UNIQUE NOT NULL,
    FechaNacimiento_Emp DATE NOT NULL,
    Direccion_Emp VARCHAR(255),
    Telefono_Emp VARCHAR(15),
    Email_Emp VARCHAR(100),
    FechaIngreso_Emp DATE NOT NULL,
    FechaBaja_Emp DATE NULL,
    Estado_Emp VARCHAR(20) DEFAULT 'Activo',
    ID_Puesto INT,
    ID_Dep INT,
    CONSTRAINT chk_Estado_Emp CHECK (Estado_Emp IN ('Activo', 'Baja'))
);

-- Tipos de Nómina
CREATE TABLE TipoNomina (
    ID_TipoNom INT PRIMARY KEY AUTO_INCREMENT,
    Tipo_TipoNom VARCHAR(20) NOT NULL,
    CONSTRAINT chk_Tipo_TipoNom CHECK (Tipo_TipoNom IN ('Mensual', 'Quincenal', 'Semanal'))
);

-- Tabla de Deducciones
CREATE TABLE Deducciones (
    ID_Deduc INT PRIMARY KEY AUTO_INCREMENT,
    TipoDeduccion_Deduc VARCHAR(50) NOT NULL, -- ISR, Seguro Social, Préstamos, etc.
    Monto_Deduc DECIMAL(10,2) NOT NULL,
    Motivo_Deduc VARCHAR(255)
);

-- Tabla de Bonificaciones
CREATE TABLE Bonificaciones (
    ID_Bonif INT PRIMARY KEY AUTO_INCREMENT,
    TipoBonificacion_Bonif VARCHAR(50) NOT NULL, -- Horas extras, comisiones, bonos
    Monto_Bonif DECIMAL(10,2) NOT NULL,
    Motivo_Bonif VARCHAR(255)
);

-- Tabla de Nóminas (creada antes para resolver dependencias)
CREATE TABLE Nomina (
    ID_Nom INT PRIMARY KEY AUTO_INCREMENT,
    ID_Emp INT NOT NULL,
    ID_TipoNom INT NOT NULL,
	ID_Bonif INT NOT NULL,
	ID_Deduc INT NOT NULL,
    HorasExtras DECIMAL(5,2) DEFAULT 0,
    TotalBonificaciones_Nom DECIMAL(10,2) DEFAULT 0,
    TotalDeducciones_Nom DECIMAL(10,2) DEFAULT 0,
    SalarioNeto_Nom DECIMAL(10,2) NOT NULL,
    FechaPago_Nom DATE NOT NULL DEFAULT (CURRENT_DATE)
);