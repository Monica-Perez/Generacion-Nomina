<?php
require_once 'config/db.php';

class Empleado {
    private $conn;

    // Constructor que inyecta la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear un empleado
    public function crear($datos) {
        try {
            $stmt = $this->conn->prepare("CALL InsertarEmpleado(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
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
    
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Loggear el error en producción
            error_log("Error al crear empleado: " . $e->getMessage());
            return false;
        }
    }

    // Método para obtener todos los empleados
    public function obtenerEmpleados() {
        try {
            $query = "CALL spObtenerEmpleados();";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Para depuración
            // echo '<pre>';
            // print_r($resultados);
            // echo '</pre>';
    
            return $resultados;
        } catch (PDOException $e) {
            error_log("Error al obtener empleados: " . $e->getMessage());
            return [];
        }
    }
    

}
