<?php
require_once 'Config/db.php';

class PrestacionController {

    private $prestacion;
    
    public function __construct() {
        $db = db::conectar();
        $this->prestacion = new Prestacion($db);
    }

    public function ver() {
        $prestaciones = $this->prestacion->obtenerPrestaciones();
        extract(['prestaciones' => $prestaciones]);
        include 'Views/Prestaciones/Ver.php';
    }

}
?>