<?php
require_once __DIR__ . '/../Models/PrestacionModelo.php';

class PrestacionController {

    private $prestacion;
    
    public function __construct() {
        $this->prestacion = new Prestacion(db::conectar());
    }

    public function ver() {
        $prestaciones = $this->prestacion->obtenerPrestaciones();
        extract(['prestaciones' => $prestaciones]);
        include 'Views/Prestaciones/Ver.php';
    }
}
?>