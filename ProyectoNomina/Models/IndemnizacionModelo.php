<?php
require_once __DIR__ . '/../Config/db.php';
class Indemnizacion {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerIndemnizaciones() {
        try {
            $query = "CALL spCalculoIndemnizacion();";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            error_log("Error al obtener las Indemnizaciones de Empleados: " . $e->getMessage());
            return [];
        }
    }
}
