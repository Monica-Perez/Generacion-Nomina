CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerEmpleados`()
BEGIN
    SELECT 
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
END