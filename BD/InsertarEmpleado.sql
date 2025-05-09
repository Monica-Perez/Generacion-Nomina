CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarEmpleado`(
    IN p_PriNombre_Emp VARCHAR(50),
    IN p_SegNombre_Emp VARCHAR(50),
    IN p_PriApellido_Emp VARCHAR(50),
    IN p_SegApellido_Emp VARCHAR(50),
    IN p_DPI_Emp VARCHAR(20),
    IN p_FechaNacimiento_Emp DATE,
    IN p_Direccion_Emp VARCHAR(255),
    IN p_Telefono_Emp VARCHAR(15),
    IN p_Email_Emp VARCHAR(50),
    IN p_FechaIngreso_Emp DATE,
    IN p_FechaBaja_Emp DATE,
    IN p_Estado_Emp VARCHAR(20),
    IN p_ID_Puesto INT
)
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
END