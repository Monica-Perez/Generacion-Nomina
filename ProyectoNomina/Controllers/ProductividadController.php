<?php
require_once __DIR__ . '/../Models/ProductividadModelo.php';

class ProductividadController {
    private $productividad;

    public function __construct() {
        $this->productividad = new ProductividadModelo(db::conectar());
    }

    public function ver() {
        $data = $this->productividad->ver();

        $labels = [];
        $porcentajes = [];

        foreach ($data as $row) {
            $labels[] = $row['nombre_empleado'];
            $porcentajes[] = isset($row['PorcentajeProductividad']) ? (float)$row['PorcentajeProductividad'] : 0;
        }

        $productividad = $data;
        require_once 'Views/Productividad/ver.php';
    }

    public function crear() {
        $empleados = $this->productividad->EmpleadoActivo();
        $idSeleccionado = $_GET['id'] ?? null;
        require_once 'Views/Productividad/crear.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->productividad->eliminar($id);
        }
        header("Location: index.php?controller=productividad&action=ver");
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['ID_Prod'];
            $horasTrabajadas = $_POST['HorasTrabajadas'];
            $horasExtras = $_POST['HorasExtras'];
            $horasDescanso = $_POST['HorasDescanso'];

            $this->productividad->actualizar($id, $horasTrabajadas, $horasExtras, $horasDescanso);
            header("Location: index.php?controller=productividad&action=historial&id=" . $_POST['ID_Emp']);
            exit;
        }
        header("Location: index.php?controller=productividad&action=ver");
    }

    public function historial() {
        $id = $_GET['id'] ?? null;
        if (!$id) { echo "Empleado no válido."; return; }

        $historial = $this->productividad->HistorialProductividadEmpleado($id);
        require_once 'Views/Productividad/historial.php';
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultado = $this->productividad->crear(
                $_POST['ID_Emp'], $_POST['Mes'], $_POST['Anio'],
                $_POST['HorasTrabajadas'], $_POST['HorasExtras'], $_POST['HorasDescanso']
            );

            if ($resultado === true) {
                header("Location: index.php?controller=productividad&action=ver&status=success");
            } else {
                header("Location: index.php?controller=productividad&action=crear&error=" . urlencode($resultado));
            }
            exit;
        }

        header("Location: index.php?controller=productividad&action=ver");
        exit;
    }
}