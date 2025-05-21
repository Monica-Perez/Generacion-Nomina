<?php
require_once 'Models/ProductividadModelo.php';

class ProductividadController {
    private $productividad;

    public function __construct() {
        $this->productividad = new ProductividadModelo(db::conectar());
    }

    public function ver() {
        $data = $this->productividad->obtenerProductividadActual();

        $labels = [];
        $porcentajes = [];
        foreach ($data as $row) {
            $labels[] = $row['nombre_empleado'];
            $porcentajes[] = $row['PorcentajeProductividad'];
        }

        $productividad = $data;
        require_once 'Views/Productividad/ver.php';
    }


    public function historial() {
        $id = $_GET['id'] ?? null;
        if (!$id) { echo "Empleado no válido."; return; }

        $historial = $this->productividad->obtenerHistorialPorEmpleado($id);
        require_once 'Views/Productividad/historial.php';
    }

    public function crear() {
        $empleados = $this->productividad->empleadosSinProductividad();
        require_once 'Views/Productividad/crear.php';
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productividad->generarRegistro(
                $_POST['ID_Emp'], $_POST['Mes'], $_POST['Anio'],
                $_POST['HorasTrabajadas'], $_POST['HorasExtras'], $_POST['HorasDescanso']
            );
        }
        header("Location: index.php?controller=productividad&action=ver");
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->productividad->eliminar($id);
        }
        header("Location: index.php?controller=productividad&action=ver");
    }

    public function modificar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productividad->modificar(
                $_POST['ID_Prod'], $_POST['HorasTrabajadas'], $_POST['HorasExtras'], $_POST['HorasDescanso']
            );
        }
        header("Location: index.php?controller=productividad&action=ver");
    }
}