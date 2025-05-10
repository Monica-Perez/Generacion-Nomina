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
            $stmt = $this->conn->prepare("CALL InsertarEmpleado(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            // Depurar parámetros
            error_log("Parámetros enviados al SP: " . json_encode($datos));
            
            $params = [
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
                $datos['estado'],
                $datos['id_puesto']
            ];
            
            $stmt->execute($params);
            
            $rowCount = $stmt->rowCount();
            error_log("Filas afectadas: " . $rowCount);
            
            return $rowCount > 0;
        } catch (PDOException $e) {
            // Loggear el error en producción
            error_log("Error PDO al crear empleado: " . $e->getMessage());
            // También registra la consulta SQL
            error_log("SQL: CALL InsertarEmpleado(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            error_log("Parámetros: " . json_encode($params));
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
    
     // Método para ACTUALIZAR un empleado
    public function actualizar($id, $datos) {
        try {
            // Llamar al procedimiento almacenado
            $stmt = $this->conn->prepare("CALL spActualizarEmpleado(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $id,
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
                $datos['estado'],
                $datos['id_puesto']
            ]);
            
            // Verificar si se actualizó correctamente
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al actualizar empleado: " . $e->getMessage());
            return false;
        }
    }

}
