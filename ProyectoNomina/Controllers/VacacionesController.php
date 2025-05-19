<?php
require_once 'Config/db.php';

class VacacionesController {

    private $vacaciones;
    
    // Constructor para inicializar las dependencias
    public function __construct() {
        $db = db::conectar();
        $this->vacaciones = new Vacaciones($db);
    }

    public function ver() {
        $id = $_GET['id'] ?? null;

        if ($id && is_numeric($id)) {
            $this->vacaciones->actualizarPeriodosVacaciones($id);
            $vacaciones = $this->vacaciones->obtenerPeriodosVacaciones($id);
        } else {
            $vacaciones = []; // ⚠ Si no hay ID, tratamos como sin vacaciones
        }

        include 'Views/Vacaciones/Ver.php';
    }



    public function ingresar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'ID_periodo'   => $_POST['ID_periodo'] ?? null,
                'FechaInicio'  => $_POST['FechaInicio'] ?? null,
                'FechaFin'     => $_POST['FechaFin'] ?? null,
                'DiasTomados'  => $_POST['DiasTomados'] ?? null,
                'Motivo'       => $_POST['Motivo'] ?? null,
            ];

            foreach ($datos as $clave => $valor) {
                if (empty($valor)) {
                    echo "Error: El campo $clave es obligatorio.";
                    return;
                }
            }

            $resultado = $this->vacaciones->Registrar($datos);

            if ($resultado) {
                // Obtenemos el ID del empleado para redirigir
                $id_emp = $_POST['id_emp'] ?? null;
                
                if ($id_emp) {
                    header("Location: index.php?controller=vacaciones&action=ver&id=" . $id_emp);
                    exit; 
                } else {
                    header("Location: index.php?controller=prestacion&action=ver");
                    exit;
                }
            } else {
                echo "Error al registrar las vacaciones.";
            }
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $vac = $this->vacaciones->obtenerPeriodosVacaciones($id); // 🔁 Este método debe existir en tu modelo
            } else {
                $vac = null;
            }
            include 'Views/Vacaciones/Registrar.php';
        }
    }

}
?>