-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: rrhh
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bonificacion`
--

DROP TABLE IF EXISTS `bonificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bonificacion` (
  `ID_Bonif` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Bonif` varchar(50) NOT NULL,
  `Monto_Bonif` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_Bonif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonificacion`
--

LOCK TABLES `bonificacion` WRITE;
/*!40000 ALTER TABLE `bonificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deduccion`
--

DROP TABLE IF EXISTS `deduccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deduccion` (
  `ID_Deduc` int(11) NOT NULL AUTO_INCREMENT,
  `TipoDeduccion_Deduc` varchar(50) NOT NULL,
  `Monto_Deduc` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_Deduc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deduccion`
--

LOCK TABLES `deduccion` WRITE;
/*!40000 ALTER TABLE `deduccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `deduccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamento` (
  `ID_Dep` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Dep` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Dep`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'IT'),(2,'Recursos Humanos'),(3,'Contabilidad'),(4,'Auditoria');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleado` (
  `ID_Emp` int(11) NOT NULL AUTO_INCREMENT,
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
  `ID_Puesto` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Emp`),
  UNIQUE KEY `DPI_Emp` (`DPI_Emp`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'Monica','Gabriela','Perez','Velásquez','3017792360101','2003-03-28','zona 17','846513','monica@gmail.com','2024-12-01',NULL,'Activo',1),(2,'Axel','Jorge','Alvarado','Arana','1234567890101','2004-02-02','zona 5','45215632','axel@gmail.com','2025-02-17',NULL,'Activo',4),(3,'Lester','Ivan','Mendez','Jose','1236547890101','2000-01-06','zona 4','87569830','lester@gmail.com','2025-05-05',NULL,'Activo',7),(4,'Diego','Pablo','Perez','Velasquez','7896452190101','2000-11-22','zona 17','78541236','diego@gmail.com','2019-08-08','2025-05-11','Baja',6),(5,'Fernando','Jorge','Alvarado','Arana','222222222','2002-01-02','21 Av. A 12-61 Alameda 4 Zona 18','36707871','aranaaxel22@gmail.com','2015-06-26',NULL,'Activo',8);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nomina`
--

DROP TABLE IF EXISTS `nomina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nomina` (
  `ID_Nomina` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Emp` int(11) NOT NULL,
  `Tipo_Nomina` enum('Semanal','Quincenal','Mensual') NOT NULL,
  `Fecha_Nomina` date NOT NULL,
  `Salario_Base` decimal(10,2) NOT NULL,
  `Bono_Incentivo` decimal(10,2) DEFAULT 250.00,
  `Bono_Antiguedad` decimal(10,2) DEFAULT 0.00,
  `ISR` decimal(10,2) DEFAULT 0.00,
  `IGSS` decimal(10,2) DEFAULT 0.00,
  `Total_Neto` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_Nomina`),
  KEY `ID_Emp` (`ID_Emp`),
  CONSTRAINT `nomina_ibfk_1` FOREIGN KEY (`ID_Emp`) REFERENCES `empleado` (`ID_Emp`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nomina`
--

LOCK TABLES `nomina` WRITE;
/*!40000 ALTER TABLE `nomina` DISABLE KEYS */;
INSERT INTO `nomina` VALUES (1,2,'Mensual','2025-05-12',5800.00,250.00,0.00,0.00,280.14,5769.86),(2,1,'Quincenal','2025-05-12',2875.00,250.00,0.00,0.00,138.86,2986.14),(5,3,'Semanal','2025-05-12',7200.00,250.00,0.00,360.00,347.76,6742.24),(6,5,'Quincenal','2025-05-14',8000.00,250.00,900.00,400.00,386.40,8363.60);
/*!40000 ALTER TABLE `nomina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puesto`
--

DROP TABLE IF EXISTS `puesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puesto` (
  `ID_Puesto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Puesto` varchar(100) NOT NULL,
  `SalarioBase_Puesto` decimal(10,2) NOT NULL,
  `ID_Dep` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Puesto`),
  KEY `fk_departamento` (`ID_Dep`),
  CONSTRAINT `fk_departamento` FOREIGN KEY (`ID_Dep`) REFERENCES `departamento` (`ID_Dep`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puesto`
--

LOCK TABLES `puesto` WRITE;
/*!40000 ALTER TABLE `puesto` DISABLE KEYS */;
INSERT INTO `puesto` VALUES (1,'Analista de Datos',5750.00,1),(2,'Soporte Técnico',5000.00,1),(3,'Analista de Recursos Humanos',6000.00,2),(4,'Reclutador',5800.00,2),(5,'Contador General',7000.00,3),(6,'Auxiliar Contable',4500.00,3),(7,'Auditor Interno',7200.00,4),(8,'Supervisor de Auditoría',8000.00,4);
/*!40000 ALTER TABLE `puesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiponomina`
--

DROP TABLE IF EXISTS `tiponomina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiponomina` (
  `ID_TipoNom` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_TipoNom` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_TipoNom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiponomina`
--

LOCK TABLES `tiponomina` WRITE;
/*!40000 ALTER TABLE `tiponomina` DISABLE KEYS */;
/*!40000 ALTER TABLE `tiponomina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'rrhh'
--

--
-- Dumping routines for database 'rrhh'
--
/*!50003 DROP PROCEDURE IF EXISTS `InsertarEmpleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarEmpleado`(IN `p_PriNombre_Emp` VARCHAR(50), IN `p_SegNombre_Emp` VARCHAR(50), IN `p_PriApellido_Emp` VARCHAR(50), IN `p_SegApellido_Emp` VARCHAR(50), IN `p_DPI_Emp` VARCHAR(20), IN `p_FechaNacimiento_Emp` DATE, IN `p_Direccion_Emp` VARCHAR(255), IN `p_Telefono_Emp` VARCHAR(15), IN `p_Email_Emp` VARCHAR(50), IN `p_FechaIngreso_Emp` DATE, IN `p_FechaBaja_Emp` DATE, IN `p_Estado_Emp` VARCHAR(20), IN `p_ID_Puesto` INT)
BEGIN
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spActualizarEmpleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarEmpleado`(IN `p_ID_Emp` INT, IN `p_PriNombre_Emp` VARCHAR(50), IN `p_SegNombre_Emp` VARCHAR(50), IN `p_PriApellido_Emp` VARCHAR(50), IN `p_SegApellido_Emp` VARCHAR(50), IN `p_DPI_Emp` VARCHAR(20), IN `p_FechaNacimiento_Emp` DATE, IN `p_Direccion_Emp` VARCHAR(255), IN `p_Telefono_Emp` VARCHAR(15), IN `p_Email_Emp` VARCHAR(100), IN `p_FechaIngreso_Emp` DATE, IN `p_FechaBaja_Emp` DATE, IN `p_Estado_Emp` VARCHAR(20), IN `p_ID_Puesto` INT)
BEGIN
    START TRANSACTION;
    
    IF (SELECT COUNT(*) FROM Empleado WHERE ID_Emp = p_ID_Emp) = 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'El empleado no existe';
    END IF;
    
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
    
    IF p_Estado_Emp = 'Baja' AND p_FechaBaja_Emp IS NULL THEN
        UPDATE Empleado
        SET FechaBaja_Emp = CURRENT_DATE()
        WHERE ID_Emp = p_ID_Emp;
    END IF;
    
    COMMIT;
    
    SELECT ID_Emp 
    FROM Empleado 
    WHERE ID_Emp = p_ID_Emp;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spCalcularB14_Agui` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCalcularB14_Agui`()
BEGIN
	SELECT 
        Emp.ID_Emp,
        CONCAT(Emp.PriNombre_Emp, ' ', Emp.SegNombre_Emp, ' ', Emp.PriApellido_Emp, ' ', Emp.SegApellido_Emp) AS Nombre,
        -- Emp.DPI_Emp,
        Emp.FechaIngreso_Emp,
        Emp.FechaBaja_Emp,
        Emp.Estado_Emp,
        Pue.Nombre_Puesto,
        Pue.SalarioBase_Puesto,

        -- DATEDIFF(LEAST(COALESCE(Emp.FechaBaja_Emp, '2025-06-30'), '2025-06-30'), GREATEST(Emp.FechaIngreso_Emp, '2024-07-01')) + 1 AS Dias_Laborados_Bono,
        ROUND(((DATEDIFF(LEAST(COALESCE(Emp.FechaBaja_Emp, '2025-06-30'), '2025-06-30'), 
				GREATEST(Emp.FechaIngreso_Emp, '2024-07-01')) + 1) * Pue.SalarioBase_Puesto)/365, 2) AS Bono14,
		
        -- DATEDIFF(LEAST(COALESCE(Emp.FechaBaja_Emp, '2025-11-30'), '2025-11-30'), GREATEST(Emp.FechaIngreso_Emp, '2024-12-01')) + 1 AS Dias_Laborados_Ag,
        ROUND(((DATEDIFF(LEAST(COALESCE(Emp.FechaBaja_Emp, '2025-11-30'), '2025-11-30'), 
				GREATEST(Emp.FechaIngreso_Emp, '2024-12-01')) + 1) * Pue.SalarioBase_Puesto)/365, 2) AS Aguinaldo
        
        
    FROM empleado Emp
    INNER JOIN puesto Pue ON Emp.ID_Puesto = Pue.ID_Puesto;
    -- WHERE Emp.ID_Emp = p_id_emp;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spCalcularNomina` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCalcularNomina`(
    IN emp_id INT,
    IN Tipo_Nomina ENUM('Semanal', 'Quincenal', 'Mensual')
)
BEGIN
    DECLARE salario_mensual DECIMAL(10,2);
    DECLARE salario_prorrateado DECIMAL(10,2);
    DECLARE fecha_ingreso DATE;
    DECLARE antiguedad INT;
    DECLARE bono_antiguedad DECIMAL(10,2);
    DECLARE isr DECIMAL(10,2);
    DECLARE igss DECIMAL(10,2);
    DECLARE bono_incentivo DECIMAL(10,2) DEFAULT 250.00;
    DECLARE total_neto_mensual DECIMAL(10,2);

    -- Verificar si ya existe
    IF NOT EXISTS (
        SELECT 1 FROM nomina 
        WHERE ID_Emp = emp_id 
        AND MONTH(Fecha_Nomina) = MONTH(CURDATE())
        AND YEAR(Fecha_Nomina) = YEAR(CURDATE())
        AND Tipo_Nomina = tipo_nomina
    ) THEN

        -- Obtener salario mensual y fecha de ingreso
        SELECT p.SalarioBase_Puesto, e.FechaIngreso_Emp
        INTO salario_mensual, fecha_ingreso
        FROM empleado e
        JOIN puesto p ON e.ID_Puesto = p.ID_Puesto
        WHERE e.ID_Emp = emp_id;

        -- Calcular salario proporcional (para referencia)
        SET salario_prorrateado = CASE 
            WHEN tipo_nomina = 'Semanal' THEN ROUND(salario_mensual / 4, 2)
            WHEN tipo_nomina = 'Quincenal' THEN ROUND(salario_mensual / 2, 2)
            ELSE salario_mensual
        END;

        -- Calcular antigüedad
        SET antiguedad = TIMESTAMPDIFF(YEAR, fecha_ingreso, CURDATE());
        SET bono_antiguedad = antiguedad * 100;

        -- Deducciones sobre salario mensual real
        SET igss = salario_mensual * 0.0483;
        SET isr = IF(salario_mensual > 6000, salario_mensual * 0.05, 0);

        -- Total neto mensual (informativo)
        SET total_neto_mensual = salario_mensual + bono_antiguedad + bono_incentivo - isr - igss;

        -- Insertar en nómina: guarda salario mensual, no fraccionado
        INSERT INTO nomina (
            ID_Emp, Tipo_Nomina, Fecha_Nomina,
            Salario_Base, Bono_Incentivo, Bono_Antiguedad,
            ISR, IGSS, Total_Neto
        )
        VALUES (
            emp_id, tipo_nomina, CURDATE(),
            salario_mensual, bono_incentivo, bono_antiguedad,
            isr, igss, total_neto_mensual
        );
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spDistribucionNomina` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spDistribucionNomina`(IN nomina_id INT)
BEGIN
    DECLARE tipo ENUM('Semanal','Quincenal','Mensual');
    DECLARE base DECIMAL(10,2);
    DECLARE bonos DECIMAL(10,2);
    DECLARE neto DECIMAL(10,2);
    DECLARE semana1 DECIMAL(10,2);
    DECLARE semana2 DECIMAL(10,2);
    DECLARE semana3 DECIMAL(10,2);
    DECLARE semana4 DECIMAL(10,2);
    DECLARE quincena1 DECIMAL(10,2);
    DECLARE quincena2 DECIMAL(10,2);

    SELECT Tipo_Nomina, Salario_Base, 
           Bono_Incentivo + Bono_Antiguedad, 
           Total_Neto
    INTO tipo, base, bonos, neto
    FROM nomina
    WHERE ID_Nomina = nomina_id;

    IF tipo = 'Semanal' THEN
        SET semana1 = ROUND(base / 4, 2);
        SET semana2 = semana1 + bonos;
        SET semana3 = semana1;
        SET semana4 = ROUND(neto - (semana1 + semana2 + semana3), 2);

        SELECT 'Semana 1' AS periodo, semana1 AS monto
        UNION SELECT 'Semana 2 (con bonos)', semana2
        UNION SELECT 'Semana 3', semana3
        UNION SELECT 'Semana 4 (ajuste final)', semana4;

    ELSEIF tipo = 'Quincenal' THEN
        SET quincena1 = ROUND(base * 0.30 + bonos, 2);
        SET quincena2 = ROUND(neto - quincena1, 2);

        SELECT 'Primera Quincena (30% + bonos)' AS periodo, quincena1 AS monto
        UNION SELECT 'Fin de Mes (ajuste final)', quincena2;

    ELSE -- Mensual
        SELECT 'Pago Mensual Completo' AS periodo, neto AS monto;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spEmpleadosSinNominaMesActual` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmpleadosSinNominaMesActual`()
BEGIN
    SELECT 
        e.ID_Emp,
        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_completo,
        p.Nombre_Puesto,
        p.SalarioBase_Puesto,
        e.FechaIngreso_Emp
    FROM empleado e
    INNER JOIN puesto p ON e.ID_Puesto = p.ID_Puesto
    WHERE e.Estado_Emp = 'Activo'
    AND NOT EXISTS (
        SELECT 1
        FROM nomina n
        WHERE n.ID_Emp = e.ID_Emp
        AND MONTH(n.Fecha_Nomina) = MONTH(CURDATE())
        AND YEAR(n.Fecha_Nomina) = YEAR(CURDATE())
    );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerDepartamentos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerDepartamentos`()
BEGIN
    SELECT ID_Dep, Nombre_Dep FROM Departamento;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerEmpleados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerEmpleados`()
BEGIN
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
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerEmpleado_ID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerEmpleado_ID`(IN `p_ID_Emp` INT)
SELECT Emp.ID_Emp,
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
    WHERE Emp.ID_Emp = p_ID_Emp ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerNominaPorId` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerNominaPorId`(IN nomina_id INT)
BEGIN
    SELECT 
        n.*, 
        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado
    FROM nomina n
    JOIN empleado e ON n.ID_Emp = e.ID_Emp
    WHERE n.ID_Nomina = nomina_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerNominas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerNominas`()
BEGIN
    SELECT 
        n.*, 
        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado
    FROM nomina n
    JOIN empleado e ON n.ID_Emp = e.ID_Emp
    ORDER BY n.Fecha_Nomina DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerPuestos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerPuestos`()
BEGIN
    SELECT ID_Puesto, Nombre_Puesto FROM Puesto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spResumenNomina` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spResumenNomina`(IN nomina_id INT)
BEGIN
    SELECT 
        n.ID_Nomina,
        n.Salario_Base AS salario_base,
        n.Bono_Incentivo AS bono_incentivo,
        n.Bono_Antiguedad AS bono_antiguedad,
        (n.Bono_Incentivo + n.Bono_Antiguedad) AS total_bonos,
        n.ISR,
        n.IGSS,
        (n.ISR + n.IGSS) AS total_deducciones,
        n.Total_Neto AS total_neto
    FROM nomina n
    WHERE n.ID_Nomina = nomina_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-14  1:55:26
