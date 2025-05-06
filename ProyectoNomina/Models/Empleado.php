<?php
require_once 'config/db.php';

class Empleado {
    private $conn;

    public function __construct() {
        $this->conn = Database::conectar();
    }

    public function crear($datos) {
        $stmt = $this->conn->prepare("CALL InsertarEmpleado(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Ejecutar el procedimiento almacenado
        $stmt->execute([
            $datos['pri_nombre'],
            $datos['seg_nombre'],
            $datos['pri_apellido'],
            $datos['seg_apellido'],
            $datos['dpi'],
            $datos['fecha_nacimiento'],
            $datos['direccion'],
            $datos['telefono'],
            $datos['email'],
            $datos['fecha_ingreso'],
            $datos['fecha_baja'],
            $datos['estado']
        ]);

        // Aquí va la parte que preguntaste
        if ($stmt->rowCount() > 0) {
            return true; // Se insertó correctamente
        } else {
            return false; // No se insertó nada
        }
    }
}
