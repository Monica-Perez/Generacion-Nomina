<?php
require_once __DIR__ . '/../Config/db.php';
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
}
