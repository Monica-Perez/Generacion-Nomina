<?php
require_once __DIR__ . '/../Config/db.php';

class ProductividadModelo {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function ver() {
        $stmt = $this->conn->prepare("CALL spObtenerProductivdadEmpleado()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function crear($idEmp, $mes, $anio, $horasTrabajadas, $horasExtras, $horasDescanso) {
        try {
            $stmt = $this->conn->prepare("CALL spCrearProductividad(:idEmp, :mes, :anio, :trabajadas, :extras, :descanso)");
            $stmt->bindParam(':idEmp', $idEmp);
            $stmt->bindParam(':mes', $mes);
            $stmt->bindParam(':anio', $anio);
            $stmt->bindParam(':trabajadas', $horasTrabajadas);
            $stmt->bindParam(':extras', $horasExtras);
            $stmt->bindParam(':descanso', $horasDescanso);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function eliminar($idProd) {
        $stmt = $this->conn->prepare("CALL spEliminarProductividad(:id)");
        $stmt->bindParam(':id', $idProd, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function actualizar($idProd, $horasTrabajadas, $horasExtras, $horasDescanso) {
        $stmt = $this->conn->prepare("CALL spActualizarProductividad(:id, :trab, :extras, :desc)");
        $stmt->bindParam(':id', $idProd);
        $stmt->bindParam(':trab', $horasTrabajadas);
        $stmt->bindParam(':extras', $horasExtras);
        $stmt->bindParam(':desc', $horasDescanso);
        $stmt->execute();
    }

    public function HistorialProductividadEmpleado($idEmp) {
        $stmt = $this->conn->prepare("CALL spHistorialProductividadEmpleado(:idEmp)");
        $stmt->bindParam(':idEmp', $idEmp, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function EmpleadoActivo() {
        $stmt = $this->conn->prepare("CALL spObtenerEmpleadoActivo()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}