CREATE DATABASE  IF NOT EXISTS `rrhh` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `rrhh`;
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
  `Horas_Extras` decimal(5,2) DEFAULT 0.00,
  PRIMARY KEY (`ID_Emp`),
  UNIQUE KEY `DPI_Emp` (`DPI_Emp`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'Monica','Gabriela','Perez','Velásquez','3017792360101','2003-03-28','zona 17','846513','monica@gmail.com','2024-12-01',NULL,'Activo',3,0.00),(2,'Axel','Jorge','Alvarado','Arana','1234567890101','2004-02-02','zona 5','45215632','axel@gmail.com','2025-02-17',NULL,'Activo',4,0.00),(3,'Lester','Ivan','Mendez','Jose','1236547890101','2000-01-06','zona 4','87569830','lester@gmail.com','2025-05-05',NULL,'Activo',7,0.00),(4,'Diegoa','Pablo','Perez','Velasquez','7896452190101','2000-11-22','zona 17','78541236','diego@gmail.com','2019-08-08','2025-05-23','Baja',6,0.00),(5,'Fernando','Jorge','Alvaradoa','Arana','222222222','2002-01-02','21 Av. A 12-61 Alameda 4 Zona 18','36707871','aranaaxel22@gmail.com','2015-06-26',NULL,'Activo',8,0.00),(6,'Isabel','Merly','Chavez','Lopez','789645210101','1993-02-10','zona 8','78965234','isa@gmail.com','2023-08-01',NULL,'Activo',3,0.00),(7,'Prueba','0','0','0','123456789123','2003-01-15','21 Av. A 12-61 Alameda 4 Zona 18','36707871','asdasdasdf@asdasdasda','2021-01-01',NULL,'Activo',3,0.00);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_ActualizarEstadoUsuario
AFTER UPDATE ON empleado
FOR EACH ROW
BEGIN
    IF OLD.Estado_Emp != NEW.Estado_Emp THEN
        UPDATE usuario
        SET Estado = 
            CASE 
                WHEN NEW.Estado_Emp = 'Activo' THEN 'activo'
                ELSE 'inactivo'
            END
        WHERE ID_Emp = NEW.ID_Emp;
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `historialvacaciones`
--

DROP TABLE IF EXISTS `historialvacaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historialvacaciones` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PeriodoVacaciones` int(11) NOT NULL,
  `ID_Emp` int(11) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `DiasTomados` decimal(10,2) NOT NULL,
  `Motivo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historialvacaciones`
--

LOCK TABLES `historialvacaciones` WRITE;
/*!40000 ALTER TABLE `historialvacaciones` DISABLE KEYS */;
INSERT INTO `historialvacaciones` VALUES (1,43,5,'2025-03-03','2025-03-07',5.00,'Personal'),(2,116,6,'2025-05-05','2025-05-09',5.00,'Personal'),(3,118,6,'2025-05-12','2025-05-16',5.00,'Personal 10 acumulados '),(4,120,6,'2024-10-07','2024-10-10',4.00,'Personal'),(5,122,6,'2025-05-06','2025-05-06',1.00,'Personal 15 acumulados'),(6,127,6,'2025-05-21','2025-05-21',1.00,'Personal'),(7,188,7,'2025-05-01','2025-05-15',15.00,'Weba');
/*!40000 ALTER TABLE `historialvacaciones` ENABLE KEYS */;
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
  `Bono_HorasExtras` decimal(10,2) DEFAULT 0.00,
  `ISR` decimal(10,2) DEFAULT 0.00,
  `IGSS` decimal(10,2) DEFAULT 0.00,
  `Total_Neto` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_Nomina`),
  KEY `ID_Emp` (`ID_Emp`),
  CONSTRAINT `nomina_ibfk_1` FOREIGN KEY (`ID_Emp`) REFERENCES `empleado` (`ID_Emp`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nomina`
--

LOCK TABLES `nomina` WRITE;
/*!40000 ALTER TABLE `nomina` DISABLE KEYS */;
INSERT INTO `nomina` VALUES (28,1,'Mensual','2025-01-01',6000.05,250.00,0.00,2812.50,300.00,289.80,8472.75),(29,1,'Quincenal','2025-02-01',6000.12,250.00,0.00,0.00,300.01,289.81,5660.30),(30,2,'Semanal','2025-05-01',5800.10,250.00,0.00,652.50,0.00,280.14,6422.46),(32,2,'Mensual','2025-02-01',2485.68,250.00,0.00,815.63,0.00,120.06,3431.25),(33,3,'Quincenal','2025-05-01',6271.02,250.00,0.00,135.00,313.55,302.89,6039.58),(35,7,'Mensual','2025-05-01',6000.05,250.00,400.00,562.50,300.00,289.80,6622.75);
/*!40000 ALTER TABLE `nomina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodosvacaciones`
--

DROP TABLE IF EXISTS `periodosvacaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodosvacaciones` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Emp` int(11) NOT NULL,
  `PeriodoInicial` date NOT NULL,
  `PeriodoFinal` date NOT NULL,
  `DiasLaborados` int(11) NOT NULL,
  `CantDias` decimal(10,2) NOT NULL,
  `DiasTomados` decimal(10,2) DEFAULT 0.00,
  `DiasPendientes` decimal(10,2) GENERATED ALWAYS AS (`CantDias` - `DiasTomados`) VIRTUAL,
  PRIMARY KEY (`ID`),
  KEY `ID_Emp` (`ID_Emp`),
  CONSTRAINT `periodosvacaciones_ibfk_1` FOREIGN KEY (`ID_Emp`) REFERENCES `empleado` (`ID_Emp`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodosvacaciones`
--

LOCK TABLES `periodosvacaciones` WRITE;
/*!40000 ALTER TABLE `periodosvacaciones` DISABLE KEYS */;
INSERT INTO `periodosvacaciones` (`ID`, `ID_Emp`, `PeriodoInicial`, `PeriodoFinal`, `DiasLaborados`, `CantDias`, `DiasTomados`) VALUES (11,4,'2019-08-08','2020-08-08',366,15.00,0.00),(12,4,'2020-08-08','2021-08-08',365,15.00,0.00),(13,4,'2021-08-08','2022-08-08',365,15.00,0.00),(14,4,'2022-08-08','2023-08-08',365,15.00,0.00),(15,4,'2023-08-08','2024-08-08',366,15.00,0.00),(16,4,'2024-08-08','2025-05-11',276,11.34,0.00),(168,6,'2023-08-01','2024-08-01',366,15.00,15.00),(169,6,'2024-08-01','2025-05-21',293,12.04,1.00),(170,5,'2015-06-26','2016-06-26',366,15.00,5.00),(171,5,'2016-06-26','2017-06-26',365,15.00,0.00),(172,5,'2017-06-26','2018-06-26',365,15.00,0.00),(173,5,'2018-06-26','2019-06-26',365,15.00,0.00),(174,5,'2019-06-26','2020-06-26',366,15.00,0.00),(175,5,'2020-06-26','2021-06-26',365,15.00,0.00),(176,5,'2021-06-26','2022-06-26',365,15.00,0.00),(177,5,'2022-06-26','2023-06-26',365,15.00,0.00),(178,5,'2023-06-26','2024-06-26',366,15.00,0.00),(179,5,'2024-06-26','2025-05-21',329,13.52,0.00),(181,2,'2025-02-17','2025-05-21',93,3.82,0.00),(184,3,'2025-05-05','2025-05-21',16,0.66,0.00),(187,1,'2024-12-01','2025-05-22',172,7.07,0.00),(193,7,'2021-01-01','2022-01-01',365,15.00,15.00),(194,7,'2022-01-01','2023-01-01',365,15.00,0.00),(195,7,'2023-01-01','2024-01-01',365,15.00,0.00),(196,7,'2024-01-01','2025-01-01',366,15.00,0.00),(197,7,'2025-01-01','2025-05-22',141,5.79,0.00);
/*!40000 ALTER TABLE `periodosvacaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productividad`
--

DROP TABLE IF EXISTS `productividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productividad` (
  `ID_Prod` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Emp` int(11) NOT NULL,
  `Mes` int(11) NOT NULL,
  `Anio` int(11) NOT NULL,
  `HorasTrabajadas` decimal(5,2) NOT NULL,
  `HorasExtras` decimal(5,2) DEFAULT 0.00,
  `HorasDescanso` decimal(5,2) DEFAULT 0.00,
  `TiempoProductivo` decimal(5,2) GENERATED ALWAYS AS (`HorasTrabajadas` - `HorasDescanso`) STORED,
  `PorcentajeProductividad` decimal(5,2) GENERATED ALWAYS AS (round((`HorasTrabajadas` - `HorasDescanso`) / 140 * 100,2)) STORED,
  PRIMARY KEY (`ID_Prod`),
  UNIQUE KEY `emp_mes_anio` (`ID_Emp`,`Mes`,`Anio`),
  CONSTRAINT `fk_productividad_empleado` FOREIGN KEY (`ID_Emp`) REFERENCES `empleado` (`ID_Emp`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productividad`
--

LOCK TABLES `productividad` WRITE;
/*!40000 ALTER TABLE `productividad` DISABLE KEYS */;
INSERT INTO `productividad` (`ID_Prod`, `ID_Emp`, `Mes`, `Anio`, `HorasTrabajadas`, `HorasExtras`, `HorasDescanso`) VALUES (1,1,4,2025,150.00,20.00,10.00),(2,2,4,2025,145.00,5.00,15.00),(3,3,4,2025,155.00,8.00,18.00),(4,5,4,2025,140.00,0.00,10.00),(5,2,5,2025,80.00,12.00,10.00),(12,1,5,2025,150.00,15.00,20.00),(13,3,5,2025,150.00,2.00,20.00),(15,1,1,2025,100.00,50.00,20.00),(16,1,2,2025,150.00,0.00,0.00),(18,2,2,2025,80.00,15.00,10.00),(19,7,5,2025,80.00,10.00,10.00);
/*!40000 ALTER TABLE `productividad` ENABLE KEYS */;
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
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Emp` int(11) NOT NULL,
  `Nombre_Usuario` varchar(50) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `Rol` enum('admin','rrhh') NOT NULL,
  `Pregunta1` varchar(100) NOT NULL,
  `Respuesta1` varchar(255) NOT NULL,
  `Pregunta2` varchar(100) NOT NULL,
  `Respuesta2` varchar(255) NOT NULL,
  `Pregunta3` varchar(100) NOT NULL,
  `Respuesta3` varchar(255) NOT NULL,
  `Pregunta4` varchar(100) NOT NULL,
  `Respuesta4` varchar(255) NOT NULL,
  `Estado` enum('activo','inactivo') DEFAULT 'activo',
  `Fecha_Creacion` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Usuario`),
  UNIQUE KEY `Nombre_Usuario` (`Nombre_Usuario`),
  KEY `ID_Emp` (`ID_Emp`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`ID_Emp`) REFERENCES `empleado` (`ID_Emp`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'Comadre','$2y$10$yTs2Bn390.wVBWEJPsHV1u6m2TQoOhbAQoRdGWfi8qEH7MzcaCE6q','admin','¿Restaurante de tu infancia?','Jaiva','¿Nombre de tu ingeniero favorito?','Jorge Moya','¿Nombre de tu profesor universitario más estricto?','El de Redes','¿Nombre de tu comadre?','Axel','activo','2025-05-22 22:51:30'),(2,6,'IsabelMCL','$2y$10$3uT4mSJ6HRS6mV1HGTtBgOpRZ0jxoVzQOcyim3XcvSof/NXGq8xTe','rrhh','¿Restaurante de tu infancia?','mac','¿Canción que más te marcó de adolescente?','creep','¿Nombre del primer videojuego que jugaste?','LOL','¿Nombre de tu equipo deportivo favorito?','Barcelona','activo','2025-05-22 23:00:52');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'rrhh'
--

--
-- Dumping routines for database 'rrhh'
--
/*!50003 DROP PROCEDURE IF EXISTS `spActualizarContrasenaUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarContrasenaUsuario`(
    IN p_ID_Usuario INT,
    IN p_NuevaContrasena VARCHAR(255)
)
BEGIN
    UPDATE usuario
    SET Contrasena = p_NuevaContrasena
    WHERE ID_Usuario = p_ID_Usuario;
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
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
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
		Estado_Emp = p_Estado_Emp,
		ID_Puesto = p_ID_Puesto
	WHERE 
		ID_Emp = p_ID_Emp;

	IF p_Estado_Emp = 'Baja' THEN
		UPDATE Empleado
		SET FechaBaja_Emp = IFNULL(p_FechaBaja_Emp, CURRENT_DATE())
		WHERE ID_Emp = p_ID_Emp;
	ELSE
		UPDATE Empleado
		SET FechaBaja_Emp = NULL
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
/*!50003 DROP PROCEDURE IF EXISTS `spActualizarPeriodosVacaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarPeriodosVacaciones`(IN `p_ID_Emp` INT)
BEGIN
    DECLARE v_FechaIngreso DATE;
    DECLARE v_FechaBaja DATE;
    DECLARE v_FechaActual DATE;
    DECLARE v_PeriodoInicial DATE;
    DECLARE v_PeriodoFinal DATE;
    DECLARE v_DiasLaborados INT;
    DECLARE v_CantDias DECIMAL(10,2);
    DECLARE v_DiasRestantes DECIMAL(10,2);
    DECLARE v_PeriodoID INT;
    DECLARE v_CantPeriodo DECIMAL(10,2);
    DECLARE done INT DEFAULT 0;

    -- Cursor para iterar periodos
    DECLARE cur CURSOR FOR
        SELECT ID, CantDias FROM PeriodosVacaciones
        WHERE ID_Emp = p_ID_Emp
        ORDER BY PeriodoInicial;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Obtener fechas del empleado
    SELECT FechaIngreso_Emp, FechaBaja_Emp
    INTO v_FechaIngreso, v_FechaBaja
    FROM Empleado
    WHERE ID_Emp = p_ID_Emp;

    -- Si no hay fecha de baja, usar la actual
	IF v_FechaBaja IS NULL THEN
		SET v_FechaBaja = DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY);
	END IF;

    -- Eliminar periodos anteriores
    DELETE FROM PeriodosVacaciones WHERE ID_Emp = p_ID_Emp;

    -- Generar periodos nuevos
    SET v_FechaActual = v_FechaIngreso;

    WHILE v_FechaActual < v_FechaBaja DO
        SET v_PeriodoInicial = v_FechaActual;
        SET v_PeriodoFinal = DATE_ADD(v_PeriodoInicial, INTERVAL 1 YEAR);

        IF v_PeriodoFinal > v_FechaBaja THEN
            SET v_PeriodoFinal = v_FechaBaja;
        END IF;

        SET v_DiasLaborados = DATEDIFF(v_PeriodoFinal, v_PeriodoInicial);

        IF v_DiasLaborados >= 365 THEN
            SET v_CantDias = 15;
        ELSE
            SET v_CantDias = (v_DiasLaborados * 15) / 365;
        END IF;

        INSERT INTO PeriodosVacaciones (
            ID_Emp, PeriodoInicial, PeriodoFinal, DiasLaborados, CantDias, DiasTomados
        ) VALUES (
            p_ID_Emp, v_PeriodoInicial, v_PeriodoFinal, v_DiasLaborados, v_CantDias, 0
        );

        SET v_FechaActual = v_PeriodoFinal;
    END WHILE;

    -- Calcular días tomados totales del empleado
    SELECT SUM(DiasTomados) INTO v_DiasRestantes
    FROM HistorialVacaciones
    WHERE ID_Emp = p_ID_Emp;

    IF v_DiasRestantes IS NULL OR v_DiasRestantes = 0 THEN
        SET v_DiasRestantes = 0;
    END IF;

    -- Repartir días tomados entre periodos en orden
    OPEN cur;
    read_loop: LOOP
        FETCH cur INTO v_PeriodoID, v_CantPeriodo;
        IF done = 1 THEN
            LEAVE read_loop;
        END IF;

        IF v_DiasRestantes >= v_CantPeriodo THEN
            -- Resta completa al periodo
            UPDATE PeriodosVacaciones
            SET DiasTomados = v_CantPeriodo
            WHERE ID = v_PeriodoID;

            SET v_DiasRestantes = v_DiasRestantes - v_CantPeriodo;
        ELSE
            -- Solo lo que queda
            UPDATE PeriodosVacaciones
            SET DiasTomados = v_DiasRestantes
            WHERE ID = v_PeriodoID;

            SET v_DiasRestantes = 0;
            LEAVE read_loop;
        END IF;
    END LOOP;
    CLOSE cur;

    -- Mostrar resultado
    SELECT 
        pv.ID,
        pv.ID_Emp,
        pv.PeriodoInicial,
        pv.PeriodoFinal,
        pv.DiasLaborados,
        pv.CantDias,
        pv.DiasTomados,
        (pv.CantDias - pv.DiasTomados) AS DiasPendientes,
        e.PriNombre_Emp AS Nombre
    FROM 
        PeriodosVacaciones pv
        JOIN Empleado e ON pv.ID_Emp = e.ID_Emp
    WHERE 
        pv.ID_Emp = p_ID_Emp
    ORDER BY 
        pv.PeriodoInicial;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spActualizarPeriodosVacaciones2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarPeriodosVacaciones2`(IN `p_ID_Emp` INT)
BEGIN
    DECLARE v_FechaIngreso DATE;
    DECLARE v_FechaBaja DATE;
    DECLARE v_FechaActual DATE;
    DECLARE v_PeriodoInicial DATE;
    DECLARE v_PeriodoFinal DATE;
    DECLARE v_DiasLaborados INT;
    DECLARE v_CantDias DECIMAL(10,2);
    DECLARE v_AñosTrabajados INT;
    DECLARE done INT DEFAULT FALSE;
    DECLARE cur_id INT;
    DECLARE cur_total DECIMAL(10,2);
    DECLARE cur CURSOR FOR 
        SELECT 
            ID_PeriodoVacaciones, 
            SUM(DiasTomados) AS TotalDiasTomados
        FROM 
            HistorialVacaciones
        GROUP BY 
            ID_PeriodoVacaciones;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    SELECT 
        e.FechaIngreso_Emp,
        e.FechaBaja_Emp
    INTO
        v_FechaIngreso,
        v_FechaBaja
    FROM 
        Empleado e
    WHERE 
        e.ID_Emp = p_ID_Emp;
    
	-- Si no hay fecha de baja, calcular hasta el último aniversario
	IF v_FechaBaja IS NULL THEN
		SET v_FechaBaja = DATE_ADD(v_FechaIngreso, INTERVAL TIMESTAMPDIFF(YEAR, v_FechaIngreso, CURRENT_DATE()) YEAR);
	END IF;

    
    SET v_FechaActual = v_FechaIngreso;
    SET v_AñosTrabajados = 0;
    
    -- Calcular cuántos años completos ha trabajado el empleado
    WHILE v_FechaActual < v_FechaBaja DO
        SET v_PeriodoInicial = v_FechaActual;
        SET v_PeriodoFinal = DATE_ADD(v_PeriodoInicial, INTERVAL 1 YEAR);
        
        -- Ajustar el período final si es mayor a la fecha de baja
        IF v_PeriodoFinal > v_FechaBaja THEN
            SET v_PeriodoFinal = v_FechaBaja;
        END IF;
        
        -- Calcular días laborados en este período
        SET v_DiasLaborados = DATEDIFF(v_PeriodoFinal, v_PeriodoInicial);
        
        -- Calcular días de vacaciones proporcionales
        IF v_DiasLaborados >= 365 THEN
            SET v_CantDias = 15; -- Un año completo
        ELSE
            SET v_CantDias = (v_DiasLaborados * 15) / 365; 
        END IF;
        
        -- Verificar si este período ya existe
        IF NOT EXISTS (
            SELECT 1 FROM PeriodosVacaciones 
            WHERE ID_Emp = p_ID_Emp 
            AND PeriodoInicial = v_PeriodoInicial 
            AND PeriodoFinal = v_PeriodoFinal
        ) THEN
            -- Insertar nuevo período
            INSERT INTO PeriodosVacaciones (
                ID_Emp, 
                PeriodoInicial, 
                PeriodoFinal, 
                DiasLaborados, 
                CantDias, 
                DiasTomados
            ) VALUES (
                p_ID_Emp,
                v_PeriodoInicial,
                v_PeriodoFinal,
                v_DiasLaborados,
                v_CantDias,
                0
            );
        END IF;
        
        -- Avanzar al siguiente período
        SET v_FechaActual = v_PeriodoFinal;
        SET v_AñosTrabajados = v_AñosTrabajados + 1;
    END WHILE;
    
    -- Primero, resetear todos los días tomados a 0 para este empleado
    UPDATE PeriodosVacaciones 
    SET DiasTomados = 0 
    WHERE ID_Emp = p_ID_Emp;
    
    -- Actualizar los días tomados usando un cursor (para actualizar fila por fila)
    OPEN cur;
    read_loop: LOOP
        FETCH cur INTO cur_id, cur_total;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        -- Actualizar por ID (clave primaria)
        UPDATE PeriodosVacaciones 
        SET DiasTomados = cur_total 
        WHERE ID = cur_id;
    END LOOP;
    CLOSE cur;
    
    -- Devolver los períodos actualizados
    SELECT 
        pv.ID,
        pv.ID_Emp,
        pv.PeriodoInicial,
        pv.PeriodoFinal,
        pv.DiasLaborados,
        pv.CantDias,
        pv.DiasTomados,
        pv.DiasPendientes,
        e.PriNombre_Emp AS Nombre
    FROM 
        PeriodosVacaciones pv
        JOIN Empleado e ON pv.ID_Emp = e.ID_Emp
    WHERE 
        pv.ID_Emp = p_ID_Emp
    ORDER BY 
        pv.PeriodoInicial;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spActualizarProductividad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarProductividad`(IN `p_ID_Prod` INT, IN `p_HorasTrabajadas` DECIMAL(5,2), IN `p_HorasExtras` DECIMAL(5,2), IN `p_HorasDescanso` DECIMAL(5,2))
BEGIN

    DECLARE tiempo DECIMAL(5,2);

    DECLARE porcentaje DECIMAL(5,2);



    SET tiempo = p_HorasTrabajadas + p_HorasExtras;



    SET porcentaje = CASE 

        WHEN (p_HorasTrabajadas + p_HorasDescanso) = 0 THEN 0

        ELSE ROUND((p_HorasTrabajadas / (p_HorasTrabajadas + p_HorasDescanso)) * 100, 2)

    END;



    UPDATE productividad

    SET HorasTrabajadas = p_HorasTrabajadas,

        HorasExtras = p_HorasExtras,

        HorasDescanso = p_HorasDescanso,

        TiempoProductivo = tiempo,

        PorcentajeProductividad = porcentaje

    WHERE ID_Prod = p_ID_Prod;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spActualizarTipoNominaYRecalcular` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarTipoNominaYRecalcular`(
    IN p_ID_Nomina INT,
    IN p_Tipo_Nomina VARCHAR(20)
)
BEGIN
    DECLARE v_ID_Emp INT;

    SELECT ID_Emp INTO v_ID_Emp
    FROM nomina
    WHERE ID_Nomina = p_ID_Nomina;

    IF v_ID_Emp IS NOT NULL THEN
        UPDATE nomina
        SET Tipo_Nomina = p_Tipo_Nomina
        WHERE ID_Nomina = p_ID_Nomina;

        CALL spCalcularNomina(v_ID_Emp, p_Tipo_Nomina);
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spActualizarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarUsuario`(
    IN p_ID_Usuario INT,
    IN p_Nombre_Usuario VARCHAR(50),
    IN p_Rol VARCHAR(20),
    IN p_Contrasena VARCHAR(255),
    IN p_Pregunta1 VARCHAR(100), IN p_Respuesta1 VARCHAR(255),
    IN p_Pregunta2 VARCHAR(100), IN p_Respuesta2 VARCHAR(255),
    IN p_Pregunta3 VARCHAR(100), IN p_Respuesta3 VARCHAR(255),
    IN p_Pregunta4 VARCHAR(100), IN p_Respuesta4 VARCHAR(255)
)
BEGIN
    UPDATE usuario
    SET Nombre_Usuario = p_Nombre_Usuario,
        Rol = p_Rol,
        Contrasena = IFNULL(p_Contrasena, Contrasena),
        Pregunta1 = p_Pregunta1, Respuesta1 = p_Respuesta1,
        Pregunta2 = p_Pregunta2, Respuesta2 = p_Respuesta2,
        Pregunta3 = p_Pregunta3, Respuesta3 = p_Respuesta3,
        Pregunta4 = p_Pregunta4, Respuesta4 = p_Respuesta4
    WHERE ID_Usuario = p_ID_Usuario;
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
    INNER JOIN puesto Pue ON Emp.ID_Puesto = Pue.ID_Puesto
    WHERE Emp.Estado_Emp = 'Activo';
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
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCalcularNomina`(IN `emp_id` INT, IN `Tipo_Nomina` ENUM('Semanal','Quincenal','Mensual'))
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

    DECLARE Bono_HorasExtras DECIMAL(10,2) DEFAULT 0.00;

    DECLARE pago_Bono_HorasExtras DECIMAL(10,2) DEFAULT 0.00;

    DECLARE salario_hora DECIMAL(10,2);

    DECLARE mes_anterior INT;

    DECLARE anio_anterior INT;



    -- Verificar si ya existe la nómina

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



        -- Calcular salario por hora (asumiendo 160h/mes)

        SET salario_hora = salario_mensual / 160;



        -- Calcular mes y año anterior

		SET mes_anterior = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH));

		SET anio_anterior = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH));



		-- Obtener horas extras del mes anterior desde productividad

		SELECT COALESCE(HorasExtras, 0)

		INTO Bono_HorasExtras

		FROM productividad

		WHERE ID_Emp = emp_id

			AND Mes = mes_anterior

			AND Anio = anio_anterior;



        -- Calcular pago de horas extras a 1.5x

        SET pago_Bono_HorasExtras = ROUND(Bono_HorasExtras * salario_hora * 1.5, 2);



        -- Calcular antigüedad

        SET antiguedad = TIMESTAMPDIFF(YEAR, fecha_ingreso, CURDATE());

        SET bono_antiguedad = antiguedad * 100;



        -- Deducciones sobre salario mensual

        SET igss = salario_mensual * 0.0483;

        SET isr = IF(salario_mensual > 6000, salario_mensual * 0.05, 0);



        -- Total neto mensual

        SET total_neto_mensual = salario_mensual + bono_antiguedad + bono_incentivo + pago_Bono_HorasExtras - isr - igss;



        -- Insertar en la tabla nómina

        INSERT INTO nomina (

            ID_Emp, Tipo_Nomina, Fecha_Nomina,

            Salario_Base, Bono_Incentivo, Bono_Antiguedad,

            ISR, IGSS, Bono_HorasExtras, Total_Neto

        )

        VALUES (

            emp_id, tipo_nomina, CURDATE(),

            salario_mensual, bono_incentivo, bono_antiguedad,

            isr, igss, pago_Bono_HorasExtras, total_neto_mensual

        );

    END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spCalculoIndemnizacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCalculoIndemnizacion`()
BEGIN
WITH DatosEmpleado AS (
	SELECT
		e.ID_Emp,
		CONCAT(e.PriNombre_Emp, ' ', e.PriApellido_Emp) AS Nombre,
		e.Estado_Emp AS Estado,
		e.FechaIngreso_Emp AS Ingreso,
		e.FechaBaja_Emp AS Baja,
		p.SalarioBase_Puesto AS SalarioBase,
		(p.SalarioBase_Puesto / 30) AS SDiario,
		TIMESTAMPDIFF(DAY, e.FechaIngreso_Emp, e.FechaBaja_Emp) AS DiasLaborados,
		DATEDIFF(
			LEAST(e.FechaBaja_Emp, '2025-06-30'), -- Se toma en cuenta la fecha de baja, siempre que sea menor a -> 30/06/25, si es mayor se toma 30/06/25
			GREATEST(e.FechaIngreso_Emp, '2024-07-01') -- Se toma en cuenta la fecha de ingreso, siempre que sea menor a -> 1/07/24, si es mayor se toma 1/07/24
		) + 1 AS Dias_Laborados_Bono,
		DATEDIFF(
			LEAST(e.FechaBaja_Emp, '2025-11-30'), -- Se toma en cuenta la fecha de baja, siempre que sea menor a -> 30/11/25, si es mayor se toma 30/11/25
			GREATEST(e.FechaIngreso_Emp, '2024-12-01') -- Se toma en cuenta la fecha de ingreso, siempre que sea menor a -> 1/12/24, si es mayor se toma 1/12/24
		) + 1 AS Dias_Laborados_Ag
	  FROM Empleado e
	  LEFT JOIN Puesto p ON e.ID_Puesto = p.ID_Puesto
	  WHERE e.Estado_Emp = 'Baja'
	),

	DiasTomados AS(
		SELECT 
			pv.ID_Emp,
			SUM(pv.DiasTomados) AS DiasTomados,
			SUM(pv.DiasPendientes) AS DiasPendientesV
		FROM periodosvacaciones pv
		INNER JOIN Empleado e ON pv.ID_Emp = e.ID_Emp
		GROUP BY pv.ID_Emp
	)
	SELECT
		de.ID_Emp,
		de.Nombre,
		de.Estado,
		de.Ingreso,
		de.Baja,
		de.SalarioBase,
		-- de.DiasLaborados,
		-- ROUND(de.DiasLaborados / 365.25, 2) AS AniosLaborados,
		ROUND((de.SalarioBase * de.Dias_Laborados_Bono) / 365, 2) AS Bono14, 
		ROUND((de.SalarioBase * de.Dias_Laborados_Ag) / 365, 2) AS Aguinaldo,
		ROUND(de.SalarioBase * de.DiasLaborados / 365.25, 2) AS Indemnizacion,
		-- ROUND(de.SDiario) AS SalarioDiario,
		-- dt.DiasTomados,
		dt.DiasPendientesV, -- Dias de vacaciones que no tomo el empleado
		ROUND(de.SDiario * dt.DiasPendientesV, 2) AS PagoVacaciones
	FROM DatosEmpleado de
	LEFT JOIN DiasTomados dt ON de.ID_Emp = dt.ID_Emp;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spCrearEmpleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCrearEmpleado`(IN `p_PriNombre_Emp` VARCHAR(50), IN `p_SegNombre_Emp` VARCHAR(50), IN `p_PriApellido_Emp` VARCHAR(50), IN `p_SegApellido_Emp` VARCHAR(50), IN `p_DPI_Emp` VARCHAR(20), IN `p_FechaNacimiento_Emp` DATE, IN `p_Direccion_Emp` VARCHAR(255), IN `p_Telefono_Emp` VARCHAR(15), IN `p_Email_Emp` VARCHAR(50), IN `p_FechaIngreso_Emp` DATE, IN `p_FechaBaja_Emp` DATE, IN `p_Estado_Emp` VARCHAR(20), IN `p_ID_Puesto` INT)
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
/*!50003 DROP PROCEDURE IF EXISTS `spCrearProductividad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCrearProductividad`(IN `p_ID_Emp` INT, IN `p_Mes` INT, IN `p_Anio` INT, IN `p_HorasTrabajadas` DECIMAL(5,2), IN `p_HorasExtras` DECIMAL(5,2), IN `p_HorasDescanso` DECIMAL(5,2))
BEGIN

    DECLARE existe INT;



    IF p_Mes < 1 OR p_Mes > 12 THEN

        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Mes no válido.';

    END IF;



    IF p_HorasTrabajadas > 744 THEN

        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Horas trabajadas exceden el límite mensual.';

    END IF;



    SELECT COUNT(*) INTO existe

    FROM productividad

    WHERE ID_Emp = p_ID_Emp AND Mes = p_Mes AND Anio = p_Anio;



    IF existe > 0 THEN

        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Ya existe un registro de productividad para este empleado en este mes.';

    END IF;



    -- Insertar productividad (las columnas calculadas se generan automáticamente)

    INSERT INTO productividad (

        ID_Emp, Mes, Anio,

        HorasTrabajadas, HorasExtras, HorasDescanso

    )

    VALUES (

        p_ID_Emp, p_Mes, p_Anio,

        p_HorasTrabajadas, p_HorasExtras, p_HorasDescanso

    );

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spCrearUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCrearUsuario`(
    IN p_ID_Emp INT,
    IN p_Nombre_Usuario VARCHAR(50),
    IN p_Contrasena VARCHAR(255),
    IN p_Rol ENUM('admin', 'rrhh'),
    IN p_Pregunta1 VARCHAR(100),
    IN p_Respuesta1 VARCHAR(255),
    IN p_Pregunta2 VARCHAR(100),
    IN p_Respuesta2 VARCHAR(255),
    IN p_Pregunta3 VARCHAR(100),
    IN p_Respuesta3 VARCHAR(255),
    IN p_Pregunta4 VARCHAR(100),
    IN p_Respuesta4 VARCHAR(255)
)
BEGIN
    DECLARE v_Puesto VARCHAR(100);

    SELECT p.Nombre_Puesto INTO v_Puesto
    FROM empleado e
    JOIN puesto p ON e.ID_Puesto = p.ID_Puesto
    WHERE e.ID_Emp = p_ID_Emp;

    IF v_Puesto = 'Analista de Recursos Humanos' THEN
        INSERT INTO usuario (
            ID_Emp, Nombre_Usuario, Contrasena, Rol,
            Pregunta1, Respuesta1,
            Pregunta2, Respuesta2,
            Pregunta3, Respuesta3,
            Pregunta4, Respuesta4
        ) VALUES (
            p_ID_Emp, p_Nombre_Usuario, p_Contrasena, p_Rol,
            p_Pregunta1, p_Respuesta1,
            p_Pregunta2, p_Respuesta2,
            p_Pregunta3, p_Respuesta3,
            p_Pregunta4, p_Respuesta4
        );
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El puesto del empleado debe ser: Analista de Recursos Humanos.';
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
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spDistribucionNomina`(IN `nomina_id` INT)
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
/*!50003 DROP PROCEDURE IF EXISTS `spEliminarNomina` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarNomina`(IN p_ID_Nomina INT)
BEGIN
    DELETE FROM nomina WHERE ID_Nomina = p_ID_Nomina;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spEliminarNominasMultiples` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarNominasMultiples`(IN `lista_ids` TEXT)
BEGIN

    SET @sql = CONCAT('DELETE FROM nomina WHERE ID_Nomina IN (', lista_ids, ')');

    PREPARE stmt FROM @sql;

    EXECUTE stmt;

    DEALLOCATE PREPARE stmt;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spEliminarProductividad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarProductividad`(IN `p_ID_Prod` INT)
BEGIN

    DELETE FROM productividad WHERE ID_Prod = p_ID_Prod;

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
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmpleadosSinNominaMesActual`()
BEGIN
    DECLARE mes_actual INT;
    DECLARE anio_actual INT;

    SET mes_actual = MONTH(CURDATE());
    SET anio_actual = YEAR(CURDATE());

    SELECT 
        e.ID_Emp,
        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado
    FROM empleado e
    WHERE NOT EXISTS (
        SELECT 1
        FROM nomina n
        WHERE n.ID_Emp = e.ID_Emp
        AND MONTH(n.Fecha_Nomina) = mes_actual
        AND YEAR(n.Fecha_Nomina) = anio_actual
    ) AND e.Estado_Emp = 'Activo';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spGenerarNominaIndividualPorMes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGenerarNominaIndividualPorMes`(
    IN p_ID_Emp INT,
    IN p_TipoNomina ENUM('Semanal','Quincenal','Mensual'),
    IN p_Mes INT,
    IN p_Anio INT
)
BEGIN
    DECLARE salario_base_mensual DECIMAL(10,2);
    DECLARE salario_diario DECIMAL(10,2);
    DECLARE salario_calculado DECIMAL(10,2);
    DECLARE fecha_ingreso DATE;
    DECLARE fecha_objetivo DATE;
    DECLARE primer_dia_mes DATE;
    DECLARE ultimo_dia_mes DATE;
    DECLARE dias_del_mes INT;
    DECLARE dias_trabajados INT;
    DECLARE antiguedad INT;
    DECLARE bono_antiguedad DECIMAL(10,2);
    DECLARE bono_incentivo DECIMAL(10,2) DEFAULT 250.00;
    DECLARE igss DECIMAL(10,2);
    DECLARE isr DECIMAL(10,2);
    DECLARE total_neto DECIMAL(10,2);
    DECLARE horas_extras DECIMAL(5,2) DEFAULT 0.00;
    DECLARE pago_horas_extras DECIMAL(10,2);
    DECLARE salario_hora DECIMAL(10,2);
    DECLARE existe INT DEFAULT 0;

    SET fecha_objetivo = STR_TO_DATE(CONCAT(p_Anio, '-', LPAD(p_Mes,2,'0'), '-01'), '%Y-%m-%d');
    SET primer_dia_mes = fecha_objetivo;
    SET ultimo_dia_mes = LAST_DAY(fecha_objetivo);
    SET dias_del_mes = DAY(ultimo_dia_mes);

    SELECT e.FechaIngreso_Emp, p.SalarioBase_Puesto
    INTO fecha_ingreso, salario_base_mensual
    FROM empleado e
    JOIN puesto p ON e.ID_Puesto = p.ID_Puesto
    WHERE e.ID_Emp = p_ID_Emp;

    IF YEAR(fecha_objetivo) < YEAR(fecha_ingreso)
	    OR (YEAR(fecha_objetivo) = YEAR(fecha_ingreso) AND MONTH(fecha_objetivo) < MONTH(fecha_ingreso)) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La fecha seleccionada no es valida.';
	END IF;


    SELECT COUNT(*) INTO existe
    FROM nomina
    WHERE ID_Emp = p_ID_Emp AND MONTH(Fecha_Nomina) = p_Mes AND YEAR(Fecha_Nomina) = p_Anio;

    IF existe > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe una nomina para este mes y año.';
    END IF;

    IF fecha_ingreso > primer_dia_mes THEN
        SET dias_trabajados = DATEDIFF(ultimo_dia_mes, fecha_ingreso) + 1;
    ELSE
        SET dias_trabajados = dias_del_mes;
    END IF;
    
    SET salario_diario = salario_base_mensual / dias_del_mes;
    SET salario_calculado = ROUND(salario_diario * dias_trabajados, 2);

    SET salario_hora = salario_base_mensual / 160;

    SELECT COALESCE(HorasExtras, 0)
    INTO horas_extras
    FROM productividad
    WHERE ID_Emp = p_ID_Emp AND Mes = p_Mes AND Anio = p_Anio
    LIMIT 1;

    SET pago_horas_extras = ROUND(horas_extras * salario_hora * 1.5, 2);

    SET antiguedad = TIMESTAMPDIFF(YEAR, fecha_ingreso, fecha_objetivo);
    SET bono_antiguedad = antiguedad * 100;

    SET igss = salario_calculado * 0.0483;
    SET isr = IF(salario_calculado > 6000, salario_calculado * 0.05, 0);

    SET total_neto = salario_calculado + bono_incentivo + bono_antiguedad + pago_horas_extras - igss - isr;

    INSERT INTO nomina (
        ID_Emp, Tipo_Nomina, Fecha_Nomina,
        Salario_Base, Bono_Incentivo, Bono_Antiguedad,
        ISR, IGSS, Bono_HorasExtras, Total_Neto
    ) VALUES (
        p_ID_Emp, p_TipoNomina, fecha_objetivo,
        salario_calculado, bono_incentivo, bono_antiguedad,
        isr, igss, pago_horas_extras, total_neto
    );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spHistorialProductividadEmpleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spHistorialProductividadEmpleado`(IN `p_ID_Emp` INT)
BEGIN

    SELECT 

        p.*, 

        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado

    FROM productividad p

    JOIN empleado e ON p.ID_Emp = e.ID_Emp

    WHERE p.ID_Emp = p_ID_Emp

    ORDER BY Anio DESC, Mes DESC;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spIngresarVacaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spIngresarVacaciones`(IN `p_ID_PeriodoVacaciones` INT, `p_ID_Emp` INT, IN `p_FechaInicio` DATE, IN `p_FechaFin` DATE, IN `p_DiasTomados` DECIMAL(10,2), IN `p_Motivo` VARCHAR(255))
BEGIN
	DECLARE v_DiasPendientes DECIMAL(10,2);
    
    -- Verificar disponibilidad de días
    SELECT DiasPendientes
    INTO v_DiasPendientes
    FROM PeriodosVacaciones
    WHERE ID = p_ID_PeriodoVacaciones;
    
    IF v_DiasPendientes >= p_DiasTomados THEN
        -- Iniciar transacción
        START TRANSACTION;
        
        -- Actualizar días tomados en el periodo
        UPDATE PeriodosVacaciones
        SET DiasTomados = DiasTomados + p_DiasTomados
        WHERE ID = p_ID_PeriodoVacaciones;
        
        -- Registrar en el historial
        INSERT INTO HistorialVacaciones (
            ID_PeriodoVacaciones,
            ID_Emp,
            FechaInicio,
            FechaFin,
            DiasTomados,
            Motivo
        ) VALUES (
            p_ID_PeriodoVacaciones,
            p_ID_Emp,
            p_FechaInicio,
            p_FechaFin,
            p_DiasTomados,
            p_Motivo
        );
        
        -- Confirmar cambios
        COMMIT;
        
        SELECT 'Vacaciones registradas correctamente' AS Mensaje;
    ELSE
        SELECT 'Error: Días solicitados superan los días disponibles' AS Mensaje;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spLoginUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spLoginUsuario`(IN p_Nombre_Usuario VARCHAR(50))
BEGIN
    SELECT 
        u.ID_Usuario,
        u.Nombre_Usuario,
        u.Contrasena,
        u.Rol,
        u.Estado,
        u.ID_Emp,
        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS Nombre_Empleado,
        e.Estado_Emp
    FROM usuario u
    JOIN empleado e ON u.ID_Emp = e.ID_Emp
    WHERE u.Nombre_Usuario = p_Nombre_Usuario
    LIMIT 1;
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
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerEmpleadoActivo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerEmpleadoActivo`()
BEGIN

    SELECT 

        ID_Emp, 

        CONCAT(PriNombre_Emp, ' ', SegNombre_Emp, ' ', PriApellido_Emp, ' ', SegApellido_Emp) AS nombre_completo, 

        FechaIngreso_Emp

    FROM empleado

    WHERE Estado_Emp = 'Activo';

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
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerEmpleados`()
BEGIN

    SELECT 
        Emp.ID_Emp,
        CONCAT_WS(' ',
            Emp.PriNombre_Emp,
            Emp.SegNombre_Emp,
            Emp.PriApellido_Emp,
            Emp.SegApellido_Emp
        ) AS nombre_empleado,
        Emp.DPI_Emp,
        Emp.FechaNacimiento_Emp,
        Emp.Direccion_Emp,
        Emp.Telefono_Emp,
        Emp.Email_Emp,
        Emp.FechaIngreso_Emp,
        Emp.FechaBaja_Emp,
        Emp.Estado_Emp,
        Pue.Nombre_Puesto
    FROM empleado Emp
    INNER JOIN puesto Pue ON Emp.ID_Puesto = Pue.ID_Puesto;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerEmpleadosPuesto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerEmpleadosPuesto`()
BEGIN

    SELECT e.ID_Emp, CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS Nombre
            FROM empleado e
            JOIN puesto p ON e.ID_Puesto = p.ID_Puesto
            WHERE p.Nombre_Puesto = 'Analista de Recursos Humanos';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerEmpleadosSinUsuarioRH` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerEmpleadosSinUsuarioRH`()
BEGIN
    SELECT e.ID_Emp,
           CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS Nombre
    FROM empleado e
    JOIN puesto p ON e.ID_Puesto = p.ID_Puesto
    WHERE p.Nombre_Puesto = 'Analista de Recursos Humanos'
      AND e.ID_Emp NOT IN (SELECT ID_Emp FROM usuario);
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
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerNominaPorId`(IN `nomina_id` INT)
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
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
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
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerPeriodosVacaciones_ID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerPeriodosVacaciones_ID`(IN `p_ID_Emp` INT)
BEGIN
	SELECT
		pv.ID,
        e.ID_Emp,
        CONCAT(e.PriNombre_Emp, ' ', e.PriApellido_Emp) AS Nombre,
        pv.PeriodoInicial,
        pv.PeriodoFinal,
        pv.DiasLaborados,
        pv.CantDias,
        pv.DiasTomados,
        pv.DiasPendientes
    FROM PeriodosVacaciones pv
    LEFT JOIN Empleado e ON pv.ID_Emp = e.ID_Emp
    WHERE pv.ID_Emp = p_ID_Emp 
    ORDER BY PeriodoInicial;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerPeriodo_ID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerPeriodo_ID`(IN `p_ID` INT)
BEGIN
	SELECT 
		pv.ID,
        CONCAT(e.PriNombre_Emp, ' ', e.PriApellido_Emp) AS Nombre,
        pv.PeriodoInicial,
        pv.PeriodoFinal,
        pv.DiasLaborados,
        pv.CantDias,
        pv.DiasTomados,
        pv.DiasPendientes
    FROM PeriodosVacaciones pv
    LEFT JOIN Empleado e ON pv.ID_Emp = e.ID_Emp
    WHERE ID = p_ID
    ORDER BY ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerPreguntasUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerPreguntasUsuario`(IN p_Nombre_Usuario VARCHAR(50))
BEGIN
    SELECT 
        ID_Usuario,
        Pregunta1, Pregunta2, Pregunta3, Pregunta4,
        Respuesta1, Respuesta2, Respuesta3, Respuesta4
    FROM usuario
    WHERE Nombre_Usuario = p_Nombre_Usuario
    LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerPreguntasYRespuestas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerPreguntasYRespuestas`(IN p_Nombre_Usuario VARCHAR(50))
BEGIN
    SELECT 
        ID_Usuario,
        Estado,
        Pregunta1, Respuesta1,
        Pregunta2, Respuesta2,
        Pregunta3, Respuesta3,
        Pregunta4, Respuesta4
    FROM usuario
    WHERE Nombre_Usuario = p_Nombre_Usuario
    LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerProductivdadEmpleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerProductivdadEmpleado`()
BEGIN

    SELECT 

        e.ID_Emp,

        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado,

        pu.Nombre_Puesto AS Puesto,

        e.FechaIngreso_Emp,

        p.Mes,

        p.Anio,

        p.HorasTrabajadas,

        p.HorasExtras,

        p.HorasDescanso,

        p.TiempoProductivo,

        p.PorcentajeProductividad

    FROM empleado e

    LEFT JOIN puesto pu ON e.ID_Puesto = pu.ID_Puesto

    LEFT JOIN (

        SELECT p1.*

        FROM productividad p1

        INNER JOIN (

            SELECT ID_Emp, MAX(CONCAT(Anio, LPAD(Mes, 2, '0'))) AS UltimaFecha

            FROM productividad

            GROUP BY ID_Emp

        ) ult 

        ON p1.ID_Emp = ult.ID_Emp 

        AND CONCAT(p1.Anio, LPAD(p1.Mes, 2, '0')) = ult.UltimaFecha

    ) p ON e.ID_Emp = p.ID_Emp

    WHERE e.Estado_Emp = 'Activo';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerProductividadActual` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerProductividadActual`()
BEGIN

    SELECT 

        p.*, 

        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado

    FROM productividad p

    JOIN empleado e ON p.ID_Emp = e.ID_Emp

    WHERE p.Mes = MONTH(CURDATE()) AND p.Anio = YEAR(CURDATE());

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
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerUsuarioPorId` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerUsuarioPorId`(IN id_usuario INT)
BEGIN
    SELECT 
        u.ID_Usuario, u.Nombre_Usuario, u.Rol, u.Estado,
        u.Pregunta1, u.Respuesta1,
        u.Pregunta2, u.Respuesta2,
        u.Pregunta3, u.Respuesta3,
        u.Pregunta4, u.Respuesta4,
        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS Nombre_Empleado,
        e.Estado_Emp
    FROM usuario u
    JOIN empleado e ON u.ID_Emp = e.ID_Emp
    WHERE u.ID_Usuario = id_usuario;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spObtenerUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerUsuarios`()
BEGIN
	SELECT 
		u.ID_Usuario,
		u.Nombre_Usuario,
		u.Rol,
		u.Estado,
		u.Pregunta1,
		u.Pregunta2,
		u.Pregunta3,
		u.Pregunta4,
		CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS Nombre_Empleado
	FROM usuario u
	JOIN empleado e ON u.ID_Emp = e.ID_Emp
	ORDER BY u.ID_Usuario DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spRecuperarContrasena` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spRecuperarContrasena`(
    IN p_Nombre_Usuario VARCHAR(50),
    IN p_Respuesta1 VARCHAR(255),
    IN p_Respuesta2 VARCHAR(255),
    IN p_Respuesta3 VARCHAR(255),
    IN p_Respuesta4 VARCHAR(255),
    IN p_NuevaContrasena VARCHAR(255)
)
BEGIN
    DECLARE v_ID_Usuario INT;
    DECLARE v_Estado ENUM('activo', 'inactivo');

    SELECT ID_Usuario, Estado INTO v_ID_Usuario, v_Estado
    FROM usuario
    WHERE Nombre_Usuario = p_Nombre_Usuario
      AND Respuesta1 = p_Respuesta1
      AND Respuesta2 = p_Respuesta2
      AND Respuesta3 = p_Respuesta3
      AND Respuesta4 = p_Respuesta4
    LIMIT 1;

    IF v_ID_Usuario IS NOT NULL AND v_Estado = 'activo' THEN
        UPDATE usuario
        SET Contrasena = p_NuevaContrasena
        WHERE ID_Usuario = v_ID_Usuario;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Respuestas incorrectas o usuario inactivo.';
    END IF;

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
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spResumenNomina`(IN `nomina_id` INT)
BEGIN

    SELECT 

        n.ID_Nomina,

        n.Salario_Base AS salario_base,

        n.Bono_Incentivo AS bono_incentivo,

        n.Bono_Antiguedad AS bono_antiguedad,

        n.Bono_HorasExtras AS bono_horas_extras,

        (n.Bono_Incentivo + n.Bono_Antiguedad + n.Bono_HorasExtras) AS total_bonos,

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

-- Dump completed on 2025-05-23  2:47:01
