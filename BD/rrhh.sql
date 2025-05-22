-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2025 a las 05:06:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarPeriodosVacaciones` (IN `p_ID_Emp` INT)   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarPeriodosVacaciones2` (IN `p_ID_Emp` INT)   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spCalcularB14_Agui` ()   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spCalcularNomina` (IN `emp_id` INT, IN `Tipo_Nomina` ENUM('Semanal','Quincenal','Mensual'))   BEGIN

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

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spCalculoIndemnizacion` ()   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spDistribucionNomina` (IN `nomina_id` INT)   BEGIN

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

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarNominasMultiples` (IN `lista_ids` TEXT)   BEGIN

    SET @sql = CONCAT('DELETE FROM nomina WHERE ID_Nomina IN (', lista_ids, ')');

    PREPARE stmt FROM @sql;

    EXECUTE stmt;

    DEALLOCATE PREPARE stmt;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarProductividad` (IN `p_ID_Prod` INT)   BEGIN

    DELETE FROM productividad WHERE ID_Prod = p_ID_Prod;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEmpleadosSinNominaMesActual` ()   BEGIN

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

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetEmpActivo` ()   BEGIN

    SELECT 

        ID_Emp, 

        CONCAT(PriNombre_Emp, ' ', SegNombre_Emp, ' ', PriApellido_Emp, ' ', SegApellido_Emp) AS nombre_completo, 

        FechaIngreso_Emp

    FROM empleado

    WHERE Estado_Emp = 'Activo';

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetProduEmp` ()   BEGIN

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

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spHistProduEmp` (IN `p_ID_Emp` INT)   BEGIN

    SELECT 

        p.*, 

        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado

    FROM productividad p

    JOIN empleado e ON p.ID_Emp = e.ID_Emp

    WHERE p.ID_Emp = p_ID_Emp

    ORDER BY Anio DESC, Mes DESC;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spIngresarVacaciones` (IN `p_ID_PeriodoVacaciones` INT, `p_ID_Emp` INT, IN `p_FechaInicio` DATE, IN `p_FechaFin` DATE, IN `p_DiasTomados` DECIMAL(10,2), IN `p_Motivo` VARCHAR(255))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerNominaPorId` (IN `nomina_id` INT)   BEGIN

    SELECT 

        n.*, 

        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado

    FROM nomina n

    JOIN empleado e ON n.ID_Emp = e.ID_Emp

    WHERE n.ID_Nomina = nomina_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerNominas` ()   BEGIN

    SELECT 

        n.*, 

        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado

    FROM nomina n

    JOIN empleado e ON n.ID_Emp = e.ID_Emp

    ORDER BY n.Fecha_Nomina DESC;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerPeriodosVacaciones_ID` (IN `p_ID_Emp` INT)   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerPeriodo_ID` (IN `p_ID` INT)   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerProductividadActual` ()   BEGIN

    SELECT 

        p.*, 

        CONCAT(e.PriNombre_Emp, ' ', e.SegNombre_Emp, ' ', e.PriApellido_Emp, ' ', e.SegApellido_Emp) AS nombre_empleado

    FROM productividad p

    JOIN empleado e ON p.ID_Emp = e.ID_Emp

    WHERE p.Mes = MONTH(CURDATE()) AND p.Anio = YEAR(CURDATE());

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerPuestos` ()   BEGIN

    SELECT ID_Puesto, Nombre_Puesto FROM Puesto;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarProductividad` (IN `p_ID_Emp` INT, IN `p_Mes` INT, IN `p_Anio` INT, IN `p_HorasTrabajadas` DECIMAL(5,2), IN `p_HorasExtras` DECIMAL(5,2), IN `p_HorasDescanso` DECIMAL(5,2))   BEGIN

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

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spResumenNomina` (IN `nomina_id` INT)   BEGIN

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

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdProdu` (IN `p_ID_Prod` INT, IN `p_HorasTrabajadas` DECIMAL(5,2), IN `p_HorasExtras` DECIMAL(5,2), IN `p_HorasDescanso` DECIMAL(5,2))   BEGIN

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

END$$

DELIMITER ;

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
  `ID_Puesto` int(11) DEFAULT NULL,
  `Horas_Extras` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ID_Emp`, `PriNombre_Emp`, `SegNombre_Emp`, `PriApellido_Emp`, `SegApellido_Emp`, `DPI_Emp`, `FechaNacimiento_Emp`, `Direccion_Emp`, `Telefono_Emp`, `Email_Emp`, `FechaIngreso_Emp`, `FechaBaja_Emp`, `Estado_Emp`, `ID_Puesto`, `Horas_Extras`) VALUES
(1, 'Monica', 'Gabriela', 'Perez', 'Velásquez', '3017792360101', '2003-03-28', 'zona 17', '846513', 'monica@gmail.com', '2024-12-01', NULL, 'Activo', 1, 0.00),
(2, 'Axel', 'Jorge', 'Alvarado', 'Arana', '1234567890101', '2004-02-02', 'zona 5', '45215632', 'axel@gmail.com', '2025-02-17', NULL, 'Activo', 4, 0.00),
(3, 'Lester', 'Ivan', 'Mendez', 'Jose', '1236547890101', '2000-01-06', 'zona 4', '87569830', 'lester@gmail.com', '2025-05-05', NULL, 'Activo', 7, 0.00),
(4, 'Diego', 'Pablo', 'Perez', 'Velasquez', '7896452190101', '2000-11-22', 'zona 17', '78541236', 'diego@gmail.com', '2019-08-08', '2025-05-11', 'Baja', 6, 0.00),
(5, 'Fernando', 'Jorge', 'Alvarado', 'Arana', '222222222', '2002-01-02', '21 Av. A 12-61 Alameda 4 Zona 18', '36707871', 'aranaaxel22@gmail.com', '2015-06-26', NULL, 'Activo', 8, 0.00),
(6, 'Isabel', 'Merly', 'Chavez', 'Lopez', '789645210101', '1993-02-10', 'zona 8', '78965234', 'isa@gmail.com', '2023-08-01', NULL, 'Activo', 3, 0.00);

--
-- Disparadores `empleado`
--
DELIMITER $$
CREATE TRIGGER `trg_ActualizarVacacionesAlDarBaja` AFTER UPDATE ON `empleado` FOR EACH ROW BEGIN

    -- Si el empleado fue dado de baja

    IF NEW.Estado_Emp = 'Baja' AND OLD.Estado_Emp = 'Activo' THEN

        -- Calcular vacaciones pendientes

        CALL spCalcularVacacionesPendientes(NEW.ID_Emp);

        

        -- Actualizar el saldo de vacaciones

        -- Este trigger solo calcula; el pago sería un proceso separado

    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialvacaciones`
--

CREATE TABLE `historialvacaciones` (
  `ID` int(11) NOT NULL,
  `ID_PeriodoVacaciones` int(11) NOT NULL,
  `ID_Emp` int(11) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `DiasTomados` decimal(10,2) NOT NULL,
  `Motivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historialvacaciones`
--

INSERT INTO `historialvacaciones` (`ID`, `ID_PeriodoVacaciones`, `ID_Emp`, `FechaInicio`, `FechaFin`, `DiasTomados`, `Motivo`) VALUES
(1, 43, 5, '2025-03-03', '2025-03-07', 5.00, 'Personal'),
(2, 116, 6, '2025-05-05', '2025-05-09', 5.00, 'Personal'),
(3, 118, 6, '2025-05-12', '2025-05-16', 5.00, 'Personal 10 acumulados '),
(4, 120, 6, '2024-10-07', '2024-10-10', 4.00, 'Personal'),
(5, 122, 6, '2025-05-06', '2025-05-06', 1.00, 'Personal 15 acumulados'),
(6, 127, 6, '2025-05-21', '2025-05-21', 1.00, 'Personal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `ID_Nomina` int(11) NOT NULL,
  `ID_Emp` int(11) NOT NULL,
  `Tipo_Nomina` enum('Semanal','Quincenal','Mensual') NOT NULL,
  `Fecha_Nomina` date NOT NULL,
  `Salario_Base` decimal(10,2) NOT NULL,
  `Bono_Incentivo` decimal(10,2) DEFAULT 250.00,
  `Bono_Antiguedad` decimal(10,2) DEFAULT 0.00,
  `Bono_HorasExtras` decimal(10,2) DEFAULT 0.00,
  `ISR` decimal(10,2) DEFAULT 0.00,
  `IGSS` decimal(10,2) DEFAULT 0.00,
  `Total_Neto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nomina`
--

INSERT INTO `nomina` (`ID_Nomina`, `ID_Emp`, `Tipo_Nomina`, `Fecha_Nomina`, `Salario_Base`, `Bono_Incentivo`, `Bono_Antiguedad`, `Bono_HorasExtras`, `ISR`, `IGSS`, `Total_Neto`) VALUES
(22, 3, 'Mensual', '2025-05-19', 7200.00, 250.00, 0.00, 540.00, 360.00, 347.76, 7282.24),
(24, 5, 'Mensual', '2025-05-19', 8000.00, 250.00, 900.00, 0.00, 400.00, 386.40, 8363.60),
(25, 2, 'Semanal', '2025-05-19', 5800.00, 250.00, 0.00, 271.88, 0.00, 280.14, 6041.74),
(27, 1, 'Mensual', '2025-05-21', 5750.00, 250.00, 0.00, 1078.20, 0.00, 277.73, 6800.47);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodosvacaciones`
--

CREATE TABLE `periodosvacaciones` (
  `ID` int(11) NOT NULL,
  `ID_Emp` int(11) NOT NULL,
  `PeriodoInicial` date NOT NULL,
  `PeriodoFinal` date NOT NULL,
  `DiasLaborados` int(11) NOT NULL,
  `CantDias` decimal(10,2) NOT NULL,
  `DiasTomados` decimal(10,2) DEFAULT 0.00,
  `DiasPendientes` decimal(10,2) GENERATED ALWAYS AS (`CantDias` - `DiasTomados`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodosvacaciones`
--

INSERT INTO `periodosvacaciones` (`ID`, `ID_Emp`, `PeriodoInicial`, `PeriodoFinal`, `DiasLaborados`, `CantDias`, `DiasTomados`) VALUES
(11, 4, '2019-08-08', '2020-08-08', 366, 15.00, 0.00),
(12, 4, '2020-08-08', '2021-08-08', 365, 15.00, 0.00),
(13, 4, '2021-08-08', '2022-08-08', 365, 15.00, 0.00),
(14, 4, '2022-08-08', '2023-08-08', 365, 15.00, 0.00),
(15, 4, '2023-08-08', '2024-08-08', 366, 15.00, 0.00),
(16, 4, '2024-08-08', '2025-05-11', 276, 11.34, 0.00),
(19, 3, '2025-05-05', '2025-05-20', 15, 0.62, 0.00),
(95, 1, '2024-12-01', '2025-05-20', 170, 6.99, 0.00),
(106, 5, '2015-06-26', '2016-06-26', 366, 15.00, 5.00),
(107, 5, '2016-06-26', '2017-06-26', 365, 15.00, 0.00),
(108, 5, '2017-06-26', '2018-06-26', 365, 15.00, 0.00),
(109, 5, '2018-06-26', '2019-06-26', 365, 15.00, 0.00),
(110, 5, '2019-06-26', '2020-06-26', 366, 15.00, 0.00),
(111, 5, '2020-06-26', '2021-06-26', 365, 15.00, 0.00),
(112, 5, '2021-06-26', '2022-06-26', 365, 15.00, 0.00),
(113, 5, '2022-06-26', '2023-06-26', 365, 15.00, 0.00),
(114, 5, '2023-06-26', '2024-06-26', 366, 15.00, 0.00),
(115, 5, '2024-06-26', '2025-05-20', 328, 13.48, 0.00),
(128, 6, '2023-08-01', '2024-08-01', 366, 15.00, 15.00),
(129, 6, '2024-08-01', '2025-05-20', 292, 12.00, 1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productividad`
--

CREATE TABLE `productividad` (
  `ID_Prod` int(11) NOT NULL,
  `ID_Emp` int(11) NOT NULL,
  `Mes` int(11) NOT NULL,
  `Anio` int(11) NOT NULL,
  `HorasTrabajadas` decimal(5,2) NOT NULL,
  `HorasExtras` decimal(5,2) DEFAULT 0.00,
  `HorasDescanso` decimal(5,2) DEFAULT 0.00,
  `TiempoProductivo` decimal(5,2) GENERATED ALWAYS AS (`HorasTrabajadas` - `HorasDescanso`) STORED,
  `PorcentajeProductividad` decimal(5,2) GENERATED ALWAYS AS (round((`HorasTrabajadas` - `HorasDescanso`) / 140 * 100,2)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productividad`
--

INSERT INTO `productividad` (`ID_Prod`, `ID_Emp`, `Mes`, `Anio`, `HorasTrabajadas`, `HorasExtras`, `HorasDescanso`) VALUES
(1, 1, 4, 2025, 150.00, 20.00, 10.00),
(2, 2, 4, 2025, 145.00, 5.00, 15.00),
(3, 3, 4, 2025, 155.00, 8.00, 18.00),
(4, 5, 4, 2025, 140.00, 0.00, 10.00),
(5, 2, 5, 2025, 80.00, 12.00, 10.00),
(12, 1, 5, 2025, 150.00, 15.00, 20.00),
(13, 3, 5, 2025, 150.00, 2.00, 20.00),
(15, 1, 1, 2025, 100.00, 50.00, 20.00),
(16, 1, 2, 2025, 150.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `ID_Puesto` int(11) NOT NULL,
  `Nombre_Puesto` varchar(100) NOT NULL,
  `SalarioBase_Puesto` decimal(10,2) NOT NULL,
  `ID_Dep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`ID_Puesto`, `Nombre_Puesto`, `SalarioBase_Puesto`, `ID_Dep`) VALUES
(1, 'Analista de Datos', 5750.00, 1),
(2, 'Soporte Técnico', 5000.00, 1),
(3, 'Analista de Recursos Humanos', 6000.00, 2),
(4, 'Reclutador', 5800.00, 2),
(5, 'Contador General', 7000.00, 3),
(6, 'Auxiliar Contable', 4500.00, 3),
(7, 'Auditor Interno', 7200.00, 4),
(8, 'Supervisor de Auditoría', 8000.00, 4);

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `historialvacaciones`
--
ALTER TABLE `historialvacaciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`ID_Nomina`),
  ADD KEY `ID_Emp` (`ID_Emp`);

--
-- Indices de la tabla `periodosvacaciones`
--
ALTER TABLE `periodosvacaciones`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Emp` (`ID_Emp`);

--
-- Indices de la tabla `productividad`
--
ALTER TABLE `productividad`
  ADD PRIMARY KEY (`ID_Prod`),
  ADD UNIQUE KEY `emp_mes_anio` (`ID_Emp`,`Mes`,`Anio`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`ID_Puesto`),
  ADD KEY `fk_departamento` (`ID_Dep`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `ID_Dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `ID_Emp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historialvacaciones`
--
ALTER TABLE `historialvacaciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `ID_Nomina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `periodosvacaciones`
--
ALTER TABLE `periodosvacaciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `productividad`
--
ALTER TABLE `productividad`
  MODIFY `ID_Prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `ID_Puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD CONSTRAINT `nomina_ibfk_1` FOREIGN KEY (`ID_Emp`) REFERENCES `empleado` (`ID_Emp`);

--
-- Filtros para la tabla `periodosvacaciones`
--
ALTER TABLE `periodosvacaciones`
  ADD CONSTRAINT `periodosvacaciones_ibfk_1` FOREIGN KEY (`ID_Emp`) REFERENCES `empleado` (`ID_Emp`);

--
-- Filtros para la tabla `productividad`
--
ALTER TABLE `productividad`
  ADD CONSTRAINT `fk_productividad_empleado` FOREIGN KEY (`ID_Emp`) REFERENCES `empleado` (`ID_Emp`);

--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `fk_departamento` FOREIGN KEY (`ID_Dep`) REFERENCES `departamento` (`ID_Dep`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
