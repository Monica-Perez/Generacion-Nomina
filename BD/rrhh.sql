-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2025 a las 23:53:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rrhh`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarEmpleado` (IN `p_PriNombre_Emp` VARCHAR(50), IN `p_SegNombre_Emp` VARCHAR(50), IN `p_PriApellido_Emp` VARCHAR(50), IN `p_SegApellido_Emp` VARCHAR(50), IN `p_DPI_Emp` VARCHAR(20), IN `p_FechaNacimiento_Emp` DATE, IN `p_Direccion_Emp` VARCHAR(255), IN `p_Telefono_Emp` VARCHAR(15), IN `p_Email_Emp` VARCHAR(50), IN `p_FechaIngreso_Emp` DATE, IN `p_FechaBaja_Emp` DATE, IN `p_Estado_Emp` VARCHAR(20), IN `p_ID_Puesto` INT)   BEGIN
    INSERT INTO Empleado (
        PriNombre_Emp,
        SegNombre_Emp,
        PriApellido_Emp,
        SegApellido_Emp,
        DPI_Emp,
        FechaNacimiento_Emp,
        Direccion_Emp,
        Telefono_Emp,
        Email_Emp,
        FechaIngreso_Emp,
        FechaBaja_Emp,
        Estado_Emp,
        ID_Puesto
    )
    VALUES (
        p_PriNombre_Emp,
        p_SegNombre_Emp,
        p_PriApellido_Emp,
        p_SegApellido_Emp,
        p_DPI_Emp,
        p_FechaNacimiento_Emp,
        p_Direccion_Emp,
        p_Telefono_Emp,
        p_Email_Emp,
        p_FechaIngreso_Emp,
        p_FechaBaja_Emp,
        p_Estado_Emp,
        p_ID_Puesto
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarEmpleado` (IN `p_ID_Emp` INT, IN `p_PriNombre_Emp` VARCHAR(50), IN `p_SegNombre_Emp` VARCHAR(50), IN `p_PriApellido_Emp` VARCHAR(50), IN `p_SegApellido_Emp` VARCHAR(50), IN `p_DPI_Emp` VARCHAR(20), IN `p_FechaNacimiento_Emp` DATE, IN `p_Direccion_Emp` VARCHAR(255), IN `p_Telefono_Emp` VARCHAR(15), IN `p_Email_Emp` VARCHAR(100), IN `p_FechaIngreso_Emp` DATE, IN `p_FechaBaja_Emp` DATE, IN `p_Estado_Emp` VARCHAR(20), IN `p_ID_Puesto` INT)   BEGIN
    -- Declarar una variable para manejar errores
    DECLARE exit handler for sqlexception
    BEGIN
        -- Revertir transacción en caso de error
        ROLLBACK;
        -- Señal de error para informar al cliente
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Error al actualizar el empleado';
    END;

    -- Iniciar transacción para asegurar integridad
    START TRANSACTION;
    
    -- Verificar que el empleado existe
    IF (SELECT COUNT(*) FROM Empleado WHERE ID_Emp = p_ID_Emp) = 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'El empleado no existe';
    END IF;
    
    -- Actualizar la información del empleado
    UPDATE Empleado 
    SET 
        PriNombre_Emp = p_PriNombre_Emp,
        SegNombre_Emp = p_SegNombre_Emp,
        PriApellido_Emp = p_PriApellido_Emp,
        SegApellido_Emp = p_SegApellido_Emp,
        DPI_Emp = p_DPI_Emp,
        FechaNacimiento_Emp = p_FechaNacimiento_Emp,
        Direccion_Emp = p_Direccion_Emp,
        Telefono_Emp = p_Telefono_Emp,
        Email_Emp = p_Email_Emp,
        FechaIngreso_Emp = p_FechaIngreso_Emp,
        FechaBaja_Emp = p_FechaBaja_Emp,
        Estado_Emp = p_Estado_Emp,
        ID_Puesto = p_ID_Puesto
    WHERE 
        ID_Emp = p_ID_Emp;
    
    -- Si se cambia el estado a "Baja" y no se proporcionó fecha de baja, establecerla a la fecha actual
    IF p_Estado_Emp = 'Baja' AND p_FechaBaja_Emp IS NULL THEN
        UPDATE Empleado
        SET FechaBaja_Emp = CURRENT_DATE()
        WHERE ID_Emp = p_ID_Emp;
    END IF;
    
    -- Confirmar la transacción
    COMMIT;
    
    -- Devolver el ID del empleado actualizado para confirmar
    SELECT ID_Emp 
    FROM Empleado 
    WHERE ID_Emp = p_ID_Emp;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerDepartamentos` ()   BEGIN
    SELECT ID_Dep, Nombre_Dep FROM Departamento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerEmpleados` ()   BEGIN
    SELECT 
		Emp.ID_Emp,
		Emp.PriNombre_Emp,
        Emp.SegNombre_Emp,
        Emp.PriApellido_Emp,
        Emp.SegApellido_Emp,
        Emp.DPI_Emp,
        Emp.FechaNacimiento_Emp,
        Emp.Direccion_Emp,
        Emp.Telefono_Emp,
        Emp.Email_Emp,
        Emp.FechaIngreso_Emp,
        Emp.FechaBaja_Emp,
        Emp.Estado_Emp,
        Pue.Nombre_Puesto
	FROM empleado Emp INNER JOIN PUESTO Pue ON Emp.ID_Puesto = Pue.ID_Puesto;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerEmpleado_ID` (IN `p_ID_Emp` INT)   SELECT Emp.ID_Emp,
	Emp.PriNombre_Emp,
        Emp.SegNombre_Emp,
        Emp.PriApellido_Emp,
        Emp.SegApellido_Emp,
        Emp.DPI_Emp,
        Emp.FechaNacimiento_Emp,
        Emp.Direccion_Emp,
        Emp.Telefono_Emp,
        Emp.Email_Emp,
        Emp.FechaIngreso_Emp,
        Emp.FechaBaja_Emp,
        Emp.Estado_Emp,
        Pue.Nombre_Puesto
	FROM empleado Emp LEFT JOIN PUESTO Pue ON Emp.ID_Puesto = Pue.ID_Puesto
    WHERE Emp.ID_Emp = p_ID_Emp$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerPuestos` ()   BEGIN
    SELECT ID_Puesto, Nombre_Puesto FROM Puesto;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonificacion`
--

CREATE TABLE `bonificacion` (
  `ID_Bonif` int(11) NOT NULL,
  `Nombre_Bonif` varchar(50) NOT NULL,
  `Monto_Bonif` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deduccion`
--

CREATE TABLE `deduccion` (
  `ID_Deduc` int(11) NOT NULL,
  `TipoDeduccion_Deduc` varchar(50) NOT NULL,
  `Monto_Deduc` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `ID_Dep` int(11) NOT NULL,
  `Nombre_Dep` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`ID_Dep`, `Nombre_Dep`) VALUES
(1, 'IT'),
(2, 'Recursos Humanos'),
(3, 'Contabilidad'),
(4, 'Auditoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `ID_Emp` int(11) NOT NULL,
  `PriNombre_Emp` varchar(50) NOT NULL,
  `SegNombre_Emp` varchar(50) NOT NULL,
  `PriApellido_Emp` varchar(50) NOT NULL,
  `SegApellido_Emp` varchar(50) NOT NULL,
  `DPI_Emp` varchar(20) NOT NULL,
  `FechaNacimiento_Emp` date NOT NULL,
  `Direccion_Emp` varchar(255) DEFAULT NULL,
  `Telefono_Emp` varchar(15) DEFAULT NULL,
  `Email_Emp` varchar(100) DEFAULT NULL,
  `FechaIngreso_Emp` date NOT NULL,
  `FechaBaja_Emp` date DEFAULT NULL,
  `Estado_Emp` varchar(10) DEFAULT 'Activo',
  `ID_Puesto` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ID_Emp`, `PriNombre_Emp`, `SegNombre_Emp`, `PriApellido_Emp`, `SegApellido_Emp`, `DPI_Emp`, `FechaNacimiento_Emp`, `Direccion_Emp`, `Telefono_Emp`, `Email_Emp`, `FechaIngreso_Emp`, `FechaBaja_Emp`, `Estado_Emp`, `ID_Puesto`) VALUES
(1, 'Monica', 'Gabriela', 'Perez', 'Velásquez', '3017792360101', '2003-03-28', 'zona 17', '846513', 'monica@gmail.com', '2024-12-01', NULL, 'Activo', 1),
(2, 'Axel', 'Jorge', 'Alvarado', 'Arana', '1234567891023', '2004-02-02', 'zona 5', '45215632', 'axel@gmail.com', '2025-02-17', NULL, 'Activo', 4),
(3, 'Lester', 'Ivan', 'Mendez', 'Jose', '1236547890101', '2000-01-06', 'zona 4', '87569830', 'lester@gmail.com', '2025-05-05', NULL, 'Activo', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `ID_Puesto` int(11) NOT NULL,
  `Nombre_Puesto` varchar(100) NOT NULL,
  `SalarioBase` decimal(10,2) NOT NULL,
  `ID_Dep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`ID_Puesto`, `Nombre_Puesto`, `SalarioBase`, `ID_Dep`) VALUES
(1, 'Analista de Datos', 5750.00, 1),
(2, 'Soporte Técnico', 5000.00, 1),
(3, 'Analista de Recursos Humanos', 6000.00, 2),
(4, 'Reclutador', 5800.00, 2),
(5, 'Contador General', 7000.00, 3),
(6, 'Auxiliar Contable', 4500.00, 3),
(7, 'Auditor Interno', 7200.00, 4),
(8, 'Supervisor de Auditoría', 8000.00, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiponomina`
--

CREATE TABLE `tiponomina` (
  `ID_TipoNom` int(11) NOT NULL,
  `Tipo_TipoNom` varchar(20) NOT NULL
) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bonificacion`
--
ALTER TABLE `bonificacion`
  ADD PRIMARY KEY (`ID_Bonif`);

--
-- Indices de la tabla `deduccion`
--
ALTER TABLE `deduccion`
  ADD PRIMARY KEY (`ID_Deduc`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`ID_Dep`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`ID_Emp`),
  ADD UNIQUE KEY `DPI_Emp` (`DPI_Emp`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`ID_Puesto`),
  ADD KEY `fk_departamento` (`ID_Dep`);

--
-- Indices de la tabla `tiponomina`
--
ALTER TABLE `tiponomina`
  ADD PRIMARY KEY (`ID_TipoNom`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bonificacion`
--
ALTER TABLE `bonificacion`
  MODIFY `ID_Bonif` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deduccion`
--
ALTER TABLE `deduccion`
  MODIFY `ID_Deduc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `ID_Dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `ID_Emp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `ID_Puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tiponomina`
--
ALTER TABLE `tiponomina`
  MODIFY `ID_TipoNom` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `fk_departamento` FOREIGN KEY (`ID_Dep`) REFERENCES `departamento` (`ID_Dep`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
