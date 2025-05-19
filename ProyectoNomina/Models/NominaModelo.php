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

    public function actualizarTipoNomina($idNomina, $nuevoTipo) {
        // 1. Obtener ID del empleado
        $stmt = $this->conn->prepare("SELECT ID_Emp FROM nomina WHERE ID_Nomina = ?");
        $stmt->execute([$idNomina]);
        $emp = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($emp) {
            // 2. Actualizar tipo de nómina
            $stmt2 = $this->conn->prepare("UPDATE nomina SET Tipo_Nomina = ? WHERE ID_Nomina = ?");
            $stmt2->execute([$nuevoTipo, $idNomina]);

            // 3. Volver a calcular la nómina para ese empleado y tipo
            $stmt3 = $this->conn->prepare("CALL spCalcularNomina(:idEmp, :tipo)");
            $stmt3->bindParam(':idEmp', $emp['ID_Emp'], PDO::PARAM_INT);
            $stmt3->bindParam(':tipo', $nuevoTipo);
            $stmt3->execute();
        }
    }

}