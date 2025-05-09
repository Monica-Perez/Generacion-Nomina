<?php
require_once 'config/db.php';

class BonificacionModelo {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerBonificaciones() {
        $stmt = $this->conn->prepare("SELECT * FROM bonificaciones");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerBonificacionPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Bonificaciones WHERE ID_Bonif = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearBonificacion($datos) {
        $stmt = $this->conn->prepare("INSERT INTO Bonificaciones (TipoBonificacion_Bonif, Monto_Bonif, Motivo_Bonif) VALUES (?, ?, ?)");
        return $stmt->execute([
            $datos['TipoBonificacion_Bonif'],
            $datos['Monto_Bonif'],
            $datos['Motivo_Bonif']
        ]);
    }

    public function actualizarBonificacion($id, $datos) {
        $stmt = $this->conn->prepare("UPDATE Bonificaciones SET TipoBonificacion_Bonif = ?, Monto_Bonif = ?, Motivo_Bonif = ? WHERE ID_Bonif = ?");
        return $stmt->execute([
            $datos['TipoBonificacion_Bonif'],
            $datos['Monto_Bonif'],
            $datos['Motivo_Bonif'],
            $id
        ]);
    }

    public function eliminarBonificacion($id) {
        $stmt = $this->conn->prepare("DELETE FROM Bonificaciones WHERE ID_Bonif = ?");
        return $stmt->execute([$id]);
    }
}
