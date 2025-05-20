<?php
require_once 'Config/db.php';
require_once 'Models/NominaModelo.php';

class NominaController {
    private $nomina;

    public function __construct() {
        $db = db::conectar();
        $this->nomina = new NominaModelo($db);
    }

    public function generarNomina() {
        $this->nomina->calcularNomina();
        header("Location: index.php?controller=Nomina&action=ver");
    }

    public function ver() {
    $nominas = $this->nomina->obtenerNominas();
    require_once 'Views/Nomina/ver.php';
    }

    public function crear() {
    $empleados = $this->nomina->obtenerEmpleadosSinNominaActual();
    require_once 'Views/Nomina/crear.php';
    }

    public function generarIndividual() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID_Emp'], $_POST['tipo_nomina'])) {
            $idEmp = (int) $_POST['ID_Emp'];
            $tipo = $_POST['tipo_nomina'];
            $this->nomina->generarNominaEmpleado($idEmp, $tipo);
        }
        header("Location: index.php?controller=nomina&action=ver");
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

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $stmt = db::conectar()->prepare("DELETE FROM nomina WHERE ID_Nomina = ?");
            $stmt->execute([$id]);
        }
        header("Location: index.php?controller=nomina&action=ver");
    }

    public function actualizarTipoNomina() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idNomina = $_POST['ID_Nomina'] ?? null;
            $nuevoTipo = $_POST['Tipo_Nomina'] ?? null;

            if ($idNomina && in_array($nuevoTipo, ['Semanal', 'Quincenal', 'Mensual'])) {
                $this->nomina->actualizarTipoNomina($idNomina, $nuevoTipo);
                echo json_encode(['success' => true]);
                return;
            }
        }

        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    }

    public function eliminarMultiples() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ids'])) {
            $ids = $_POST['ids'];
            $this->nomina->eliminarNominasMultiples($ids);
        }
        header("Location: index.php?controller=nomina&action=ver");
    }

}