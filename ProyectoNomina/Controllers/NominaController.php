<?php
require_once __DIR__ . '/../Models/NominaModelo.php';

class NominaController {
    private $nomina;

    public function __construct() {
        $this->nomina = new NominaModelo(db::conectar());
    }

    public function ver() {
    $nominas = $this->nomina->ver();
    require_once 'Views/Nomina/ver.php';
    }

    public function crear() {
        $empleados = $this->nomina->crear();
        require_once 'Views/Nomina/crear.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->nomina->eliminar($id);
        }
        header("Location: index.php?controller=nomina&action=ver");
        exit;
    }

    public function actualizarTipoNomina() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idNomina = $_POST['ID_Nomina'] ?? null;
            $nuevoTipo = $_POST['Tipo_Nomina'] ?? null;

            if ($idNomina && in_array($nuevoTipo, ['Semanal', 'Quincenal', 'Mensual'])) {
                $this->nomina->actualizar($idNomina, $nuevoTipo);
                echo json_encode(['success' => true]);
                return;
            }
        }

        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    }

    public function eliminarMultiples() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ids'])) {
            $ids = $_POST['ids'];
            $this->nomina->eliminarMultiples($ids);
        }
        header("Location: index.php?controller=nomina&action=ver");
        exit;
    }

    public function generarIndividual() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEmp = (int) $_POST['ID_Emp'];
            $tipo = $_POST['tipo_nomina'];
            $mes = (int) $_POST['mes'];
            $anio = (int) $_POST['anio'];

            $resultado = $this->nomina->generarNominaEmpleado($idEmp, $tipo, $mes, $anio);

            if ($resultado === true) {
                header("Location: index.php?controller=nomina&action=ver&status=success");
                exit;
            } else {
                header("Location: index.php?controller=nomina&action=crear&error=" . urlencode($resultado));
                exit;
            }
        }

        header("Location: index.php?controller=nomina&action=crear");
        exit;
    }

    public function detalle() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID no válido.";
            return;
        }

        $nomina = $this->nomina->obtenerNominaPorId($id);
        $detalle = $this->nomina->calcularDistribucion($id);
        $resumen = $this->nomina->resumenNomina($id);

        require_once 'Views/nomina/detalle.php';
    }

}