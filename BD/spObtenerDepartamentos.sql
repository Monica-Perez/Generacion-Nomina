DELIMITER $$

CREATE PROCEDURE spObtenerDepartamentos()
BEGIN
    SELECT ID_Dep, Nombre_Dep FROM Departamento;
END$$

DELIMITER ;
