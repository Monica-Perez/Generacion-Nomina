<?php
require_once __DIR__ . '/../Config/db.php';

class UsuarioModelo {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function crearUsuario($datos) {
        try {
            $stmt = $this->conn->prepare("CALL spCrearUsuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
            error_log("Parámetros enviados al SP: " . json_encode($datos));

            $params = [
                $datos['ID_Emp'],
                $datos['Nombre_Usuario'],
                $datos['Contrasena'],
                $datos['Rol'],
                $datos['Pregunta1'],
                $datos['Respuesta1'],
                $datos['Pregunta2'],
                $datos['Respuesta2'],
                $datos['Pregunta3'],
                $datos['Respuesta3'],
                $datos['Pregunta4'],
                $datos['Respuesta4']
            ];

            error_log("Parámetros enviados al SP: " . json_encode($params));
            
            $stmt->execute($params);

            $rowCount = $stmt->rowCount();
            error_log("Filas afectadas: " . $rowCount);

            return $rowCount > 0;
        } catch (PDOException $e) {
            error_log("Error PDO al crear usuario: " . $e->getMessage());
            error_log("SQL: CALL spCrearUsuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            error_log("Parámetros: " . json_encode($params));
            return false;
        }
    }

    public function eliminarUsuario($id) {
        $stmt = $this->conn->prepare("CALL spEliminarUsuario(:id)");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function actualizar($datos) {
        $sql = "CALL spActualizarUsuario(
            :ID_Usuario, :Nombre_Usuario, :Rol, :Contrasena,
            :Pregunta1, :Respuesta1, :Pregunta2, :Respuesta2,
            :Pregunta3, :Respuesta3, :Pregunta4, :Respuesta4
        )";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ID_Usuario', $datos['ID_Usuario']);
        $stmt->bindParam(':Nombre_Usuario', $datos['Nombre_Usuario']);
        $stmt->bindParam(':Rol', $datos['Rol']);
        $stmt->bindParam(':Contrasena', $datos['Contrasena']);
        $stmt->bindParam(':Pregunta1', $datos['Pregunta1']);
        $stmt->bindParam(':Respuesta1', $datos['Respuesta1']);
        $stmt->bindParam(':Pregunta2', $datos['Pregunta2']);
        $stmt->bindParam(':Respuesta2', $datos['Respuesta2']);
        $stmt->bindParam(':Pregunta3', $datos['Pregunta3']);
        $stmt->bindParam(':Respuesta3', $datos['Respuesta3']);
        $stmt->bindParam(':Pregunta4', $datos['Pregunta4']);
        $stmt->bindParam(':Respuesta4', $datos['Respuesta4']);
        
        $stmt->execute();
    } 


    public function obtenerEmpleadosRH() {
        $stmt = $this->conn->prepare("CALL spObtenerEmpleadosSinUsuarioRH()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarios() {
        $stmt = $this->conn->prepare("CALL spObtenerUsuarios()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorId($id) {
        $stmt = $this->conn->prepare("CALL spObtenerUsuarioPorId(:id)");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
