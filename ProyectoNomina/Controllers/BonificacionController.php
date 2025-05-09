<?php
require('Config/db.php');

class BonificacionController {

    private $bonificacion;
    
    // Inyectamos la dependencia en el constructor del controlador
    public function __construct() {
        $db = db::conectar();
        $this->bonificacion = new Bonificacion($db);
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $datos = [
                'nombre'       => $_POST['nombre'],
                'monto'     => $_POST['monto'],
            ];
    
            $resultado = $this->bonificacion->crear($datos);
            //var_dump($_POST); exit;

            if ($resultado) {
                header('Location: index.php?controller=bonificacion&action=ver');
                exit;
            } else {
                echo "❌ No se insertó ningún bonificacion. Revisa los campos.";
            }
        } else {
            include 'Views/bonificaciones/crear.php';
        }
    }

    public function ver() {
        $bonificaciones = $this->bonificacion->obtenerBonificaciones();
        extract(['bonificaciones' => $bonificaciones]);
        include 'Views/Bonificaciones/Ver.php';
    }
}
?>