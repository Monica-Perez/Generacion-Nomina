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


}
