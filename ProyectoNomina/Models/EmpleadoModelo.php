<?php
require_once 'config/db.php';

class EmpleadoModelo {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($datos) {
        try {
            $sql = "INSERT INTO Empleado (
                        Nombre_Emp, Apellido_Emp, DPI_Emp, FechaNacimiento_Emp, 
                        Direccion_Emp, Telefono_Emp, Email_Emp, FechaIngreso_Emp, 
                        FechaBaja_Emp, Estado_Emp, ID_Puesto, ID_Dep
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $datos['Nombre_Emp'],
                $datos['Apellido_Emp'],
                $datos['DPI_Emp'],
                $datos['FechaNacimiento_Emp'],
                $datos['Direccion_Emp'],
                $datos['Telefono_Emp'],
                $datos['Email_Emp'],
                $datos['FechaIngreso_Emp'],
                $datos['FechaBaja_Emp'] ?? null,
                $datos['Estado_Emp'] ?? 'Activo',
                $datos['ID_Puesto'] ?? null,
                $datos['ID_Dep'] ?? null
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al crear empleado: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerEmpleados() {
        try {
            $stmt = $this->conn->prepare("CALL spObtenerEmpleados()");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener empleados: " . $e->getMessage());
            return [];
        }
    }
}