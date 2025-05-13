<?php
require_once 'Config/db.php';

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
    $stmt = $this->conn->prepare("
        SELECT 
            n.*, 
            CONCAT(emp.PriNombre_Emp, ' ', emp.SegNombre_Emp, ' ', emp.PriApellido_Emp, ' ', emp.SegApellido_Emp) AS nombre_empleado
        FROM nomina n
        JOIN empleado emp ON n.ID_Emp = emp.ID_Emp
        ORDER BY n.Fecha_Nomina DESC
    ");
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
        $stmt = $this->conn->prepare("
            SELECT 
                n.*, 
                CONCAT(emp.PriNombre_Emp, ' ', emp.SegNombre_Emp, ' ', emp.PriApellido_Emp, ' ', emp.SegApellido_Emp) AS nombre_empleado
            FROM nomina n
            JOIN empleado emp ON n.ID_Emp = emp.ID_Emp
            WHERE n.ID_Nomina = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



}
?>

