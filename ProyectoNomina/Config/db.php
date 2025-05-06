<?php
class db {
    private static $conn;
    
    public static function conectar() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=localhost;dbname=rrhh", "root", "");
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>