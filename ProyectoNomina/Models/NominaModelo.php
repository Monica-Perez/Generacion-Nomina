<?php
require_once __DIR__ . '/../Config/db.php';

class NominaModelo {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function calcularNomina() {
        $stmt = $this->conn->prepare("CALL spCalcularNomina()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerNominas() {
        $stmt = $this->conn->prepare("CALL spObtenerNominas()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerEmpleadosSinNominaActual() {
        $stmt = $this->conn->prepare("CALL spEmpleadosSinNominaMesActual()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function generarNominaEmpleado($idEmp, $tipoNomina) {
        $stmt = $this->conn->prepare("CALL spCalcularNomina(:idEmp, :tipoNomina)");
        $stmt->bindParam(':idEmp', $idEmp, PDO::PARAM_INT);
        $stmt->bindParam(':tipoNomina', $tipoNomina);
        $stmt->execute();
    }

    public function obtenerNominaPorId($id) {
        $stmt = $this->conn->prepare("CALL spObtenerNominaPorId(:id)");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function calcularDistribucion($id) {
        $stmt = $this->conn->prepare("CALL spDistribucionNomina(:id)");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resumenNomina($id) {
        $stmt = $this->conn->prepare("CALL spResumenNomina(:id)");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}