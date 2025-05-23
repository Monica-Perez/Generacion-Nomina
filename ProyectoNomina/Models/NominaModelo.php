<?php
require_once __DIR__ . '/../Config/db.php';

class NominaModelo {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function ver() {
        $stmt = $this->conn->prepare("CALL spObtenerNominas()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear() {
        $stmt = $this->conn->prepare("CALL spObtenerEmpleadoActivo()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($idNomina) {
        $stmt = $this->conn->prepare("CALL spEliminarNomina(:id)");
        $stmt->bindParam(':id', $idNomina, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function actualizar($idNomina, $nuevoTipo) {
        $stmt = $this->conn->prepare("CALL spActualizarTipoNominaYRecalcular(:idNomina, :tipo)");
        $stmt->bindParam(':idNomina', $idNomina, PDO::PARAM_INT);
        $stmt->bindParam(':tipo', $nuevoTipo);
        $stmt->execute();
    }

    public function eliminarMultiples($ids) {
        $lista = implode(',', array_map('intval', $ids));
        $stmt = $this->conn->prepare("CALL spEliminarNominasMultiples(:ids)");
        $stmt->bindParam(':ids', $lista, PDO::PARAM_STR);
        $stmt->execute();
    }


    public function obtenerEmpleadosSinNominaActual() {
        $stmt = $this->conn->prepare("CALL spEmpleadosSinNominaMesActual()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function generarNominaEmpleado($idEmp, $tipo, $mes, $anio) {
        $stmt = $this->conn->prepare("CALL spGenerarNominaIndividualPorMes(:idEmp, :tipo, :mes, :anio)");
        $stmt->bindParam(':idEmp', $idEmp, PDO::PARAM_INT);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':mes', $mes, PDO::PARAM_INT);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
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