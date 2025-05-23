<?php

if (!class_exists('db')) {
    class db {
        private static $conn;
        
        public static function conectar() {
            if (self::$conn === null) {
                try {
                    self::$conn = new PDO("mysql:host=127.0.0.1:3308;dbname=rrhh", "root", "1234");
                    self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Error de conexión: " . $e->getMessage());
                }
            }
            return self::$conn;
        }
    }
}
?>