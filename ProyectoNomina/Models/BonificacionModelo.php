<?php
require_once 'config/db.php';

class Bonificacion {
    private $conn;

    // Constructor que inyecta la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear un bonificacion
    public function crear($datos) {
        try {
            $stmt = $this->conn->prepare("CALL InsertarBonificacion(?, ?)");
            
            // Depurar parámetros
            error_log("Parámetros enviados al SP: " . json_encode($datos));
            
            $params = [
                $datos['nombre'],
                $datos['monto']
            ];
            
            $stmt->execute($params);
            
            $rowCount = $stmt->rowCount();
            error_log("Filas afectadas: " . $rowCount);
            
            return $rowCount > 0;
        } catch (PDOException $e) {
            // Loggear el error en producción
            error_log("Error PDO al crear bonificacion: " . $e->getMessage());
            // También registra la consulta SQL
            error_log("SQL: CALL InsertarBonificacion(?, ?)");
            error_log("Parámetros: " . json_encode($params));
            return false;
        }
    }

    // Método para obtener todos los bonificaciones
    public function obtenerBonificaciones() {
        try {
            $query = "CALL spObtenerBonificaciones();";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Para depuración
            // echo '<pre>';
            // print_r($resultados);
            // echo '</pre>';
    
            return $resultados;
        } catch (PDOException $e) {
            error_log("Error al obtener bonificaciones: " . $e->getMessage());
            return [];
        }
    }
    

}
