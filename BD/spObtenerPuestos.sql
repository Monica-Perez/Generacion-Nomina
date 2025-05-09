DELIMITER $$

CREATE PROCEDURE spObtenerPuestos()
BEGIN
    SELECT ID_Puesto, Nombre_Puesto FROM Puesto;
END$$

DELIMITER ;
