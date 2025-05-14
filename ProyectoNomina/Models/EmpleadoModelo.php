<?php
require_once 'Config/db.php';

class Empleado {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($datos) {
        try {
            $stmt = $this->conn->prepare("CALL InsertarEmpleado(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
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
            error_log("Error PDO al crear empleado: " . $e->getMessage());
            error_log("SQL: CALL InsertarEmpleado(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            error_log("Parámetros: " . json_encode($params));
            return false;
        }
    }
    public function obtenerEmpleados() {
        try {
            $query = "CALL spObtenerEmpleados();";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // echo '<pre>';
            // print_r($resultados);
            // echo '</pre>';
    
            return $resultados;
        } catch (PDOException $e) {
            error_log("Error al obtener empleados: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerPuestos() {
        try {
            $query = "CALL spObtenerPuestos();";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            error_log("Error al obtener puestos: " . $e->getMessage());
            return [];
        }
    }
    
    public function obtenerEmpleadoPorId($id) {
        try {
            $query = "CALL spObtenerEmpleado_ID(?)";
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$resultado) {
                return false;
            }
            
            return $resultado;
        } catch (PDOException $e) {
            error_log("Error al obtener empleado por ID: " . $e->getMessage());
            return false;
        }
    }

    public function actualizar($id, $datos) {
        try {
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
            
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al actualizar empleado: " . $e->getMessage());
            return false;
        }
    }
    
}
