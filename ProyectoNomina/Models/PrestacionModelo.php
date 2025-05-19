<?php
require_once 'Config/db.php'; 
class Prestacion {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerPrestaciones() {
        try {
            $query = "CALL spCalcularB14_Agui();";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            error_log("Error al obtener Prestaciones de Empleados: " . $e->getMessage());
            return [];
        }
    }

    // // Método para obtener las prestaciones por 1 empleado
    // public function obtenerBonoyAguinaldo($id) {
    //     try {
    //         // Preparar la llamada al procedimiento almacenado
    //         $query = "CALL spCalcularB14_Agui(?)";
    //         $stmt = $this->conn->prepare($query);
            
    //         // Vincular el parámetro ID
    //         $stmt->bindParam(1, $id, PDO::PARAM_INT);
    //         $stmt->execute();
            
    //         // Obtener el resultado
    //         $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
    //         // Si no hay resultados, devolver false
    //         if (!$resultado) {
    //             return false;
    //         }
            
    //         // Devolver los datos del empleado
    //         return $resultado;
    //     } catch (PDOException $e) {
    //         // Registrar el error y devolver false
    //         error_log("Error al obtener las prestaciones por Empleado: " . $e->getMessage());
    //         return false;
    //     }
    // }
    
}
