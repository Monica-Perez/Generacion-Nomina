<?php
require_once __DIR__ . '/../Models/VacacionesModelo.php';

class VacacionesController {

    private $vacaciones;
    
    public function __construct() {
        $this->vacaciones = new Vacaciones(db::conectar());
    }

    public function ver() {
        $id = $_GET['id'] ?? null;

        if ($id && is_numeric($id)) {
            $this->vacaciones->actualizarPeriodosVacaciones($id);
            $vacaciones = $this->vacaciones->obtenerPeriodosVacaciones($id);
        } else {
            $vacaciones = []; 
        }

        include 'Views/Vacaciones/Ver.php';
    }

    public function ingresar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'ID_periodo'   => $_POST['ID_periodo'] ?? null,
                'ID_Emp'       => $_POST['ID_Emp'] ?? null,
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
                $id_emp = $_POST['ID_Emp'] ?? null;
                
                if ($id_emp) {
                    header("Location: index.php?controller=vacaciones&action=ver&id=". $id_emp);
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
                $vac = $this->vacaciones->obtenerPeriodosVacaciones($id); 
            } else {
                $vac = null;
            }

            $conn = db::conectar();
            $empleados = [];

            $stmt = $conn->prepare("CALL spObtenerEmpleados()");
            $stmt->execute();
            $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            include 'Views/Vacaciones/Registrar.php';

        }
    }

}
?>