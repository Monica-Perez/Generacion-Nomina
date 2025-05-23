<?php
require_once __DIR__ . '/../Config/db.php';

class LoginModelo {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function autenticar($nombreUsuario) {
        $sql = "CALL spLoginUsuario(:nombreUsuario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $usuario;
    }

    public function obtenerPreguntasYRespuestas($usuario) {
        $sql = "CALL spObtenerPreguntasYRespuestas(:usuario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datos;
    }

    public function actualizarContrasena($idUsuario, $hash) {
        $sql = "CALL spActualizarContrasenaUsuario(:id, :pass)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $idUsuario);
        $stmt->bindParam(':pass', $hash);
        $stmt->execute();
    }
}
