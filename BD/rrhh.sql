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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-23  2:44:32
