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

    // Método para obtener el historial de vacaciones
    public function obtenerHistorialVacaciones($idEmpleado) {
        try {
            $query = "SELECT hv.*, pv.PeriodoInicial, pv.PeriodoFinal 
                     FROM HistorialVacaciones hv
                     JOIN PeriodosVacaciones pv ON hv.ID_PeriodoVacaciones = pv.ID
                     WHERE pv.ID_Emp = ?
                     ORDER BY hv.FechaInicio DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$idEmpleado]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener historial de vacaciones: " . $e->getMessage());
            return [];
        }
    }
}
