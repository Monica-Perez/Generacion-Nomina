<?php
require_once __DIR__ . '/../Models/IndemnizacionModelo.php';

class IndemnizacionController {

    private $indem;
    
    public function __construct() {
        $db = db::conectar();
        $this->indem = new Indemnizacion(db::conectar());
    }

    public function ver() {
        $indemnizaciones = $this->indem->obtenerIndemnizaciones();
        extract(['indemnizaciones' => $indemnizaciones]);
        include 'Views/Indemnizacion/Ver.php';
    }
}
?>