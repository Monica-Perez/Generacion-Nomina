<?php
require_once 'Config/db.php'; 
class Vacaciones {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerPeriodosVacaciones($Id) {
        try {
            $query = "CALL spObtenerPeriodosVacaciones_ID(?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$Id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener periodos: " . $e->getMessage());
            return [];
        }
    }
    public function Registrar($datos) {
        try {
            $stmt = $this->conn->prepare("CALL spIngresarVacaciones(?, ?, ?, ?, ?)");
            
            error_log("Parámetros enviados al SP: " . json_encode($datos));
            
            $params = [
                $datos['ID_periodo'],
                $datos['FechaInicio'],
                $datos['FechaFin'],
                $datos['DiasTomados'],
                $datos['Motivo']
            ];
            
            $stmt->execute($params);
            
            $rowCount = $stmt->rowCount();
            error_log("Filas afectadas: " . $rowCount);
            
            return $rowCount > 0;
        } catch (PDOException $e) {
            error_log("Error al registrar vacaciones: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarPeriodosVacaciones($Id) {
        try {
            $stmt = $this->conn->prepare("CALL spActualizarPeriodosVacaciones(?)");
            $stmt->execute([$Id]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al actualizar periodos de vacaciones: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPeriodoPorId($IdPeriodo) {
        try {
            $stmt = $this->conn->prepare("CALL spObtenerPeriodo_ID(?)");
            $stmt->execute([$IdPeriodo]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al obtener un periodo por ID: " . $e->getMessage());
            return false;
        }
    }
}
