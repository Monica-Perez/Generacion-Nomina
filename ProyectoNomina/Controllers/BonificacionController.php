<?php
require_once 'Models/BonificacionModelo.php';
require_once 'config/db.php';

class BonificacionController {

    private $modeloBonificacion;

    public function __construct() {
        $db = db::conectar();  // Obtener la conexión a la base de datos
        $this->modeloBonificacion = new BonificacionModelo($db);  // Pasar la conexión al modelo
    }

    public function verBonificaciones() {
        $bonificaciones = $this->modeloBonificacion->obtenerBonificaciones();  // Obtener las bonificaciones
        // Aquí puedes incluir la vista para mostrar las bonificaciones, por ejemplo:
        require_once 'Views/Bonificaciones/ver.php';
    }

    public function crearBonificacion() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'TipoBonificacion_Bonif' => $_POST['TipoBonificacion_Bonif'],
                'Monto_Bonif' => $_POST['Monto_Bonif'],
                'Motivo_Bonif' => $_POST['Motivo_Bonif']
            ];
            $this->modeloBonificacion->crearBonificacion($datos);
            header('Location: index.php?controller=bonificacion&action=verBonificaciones');
        }
        // Incluir vista para crear bonificación
        require_once 'Views/Bonificaciones/crear.php';
    }
}
?>

