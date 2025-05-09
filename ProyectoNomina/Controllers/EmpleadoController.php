<?php
require('Config/db.php');
require_once __DIR__ . '/../Models/EmpleadoModelo.php';

class EmpleadoController {

    private $empleado;
    
    // Inyectamos la dependencia en el constructor del controlador
    public function __construct() {
        $db = db::conectar();
        $this->empleado = new EmpleadoModelo($db);
    }
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = db::conectar();
            $empleadoModel = new EmpleadoModelo($db);

            $datos = [
                'Nombre_Emp' => $_POST['nombre'] ?? '',
                'Apellido_Emp' => $_POST['apellido'] ?? '',
                'DPI_Emp' => $_POST['dpi'] ?? '',
                'FechaNacimiento_Emp' => $_POST['fecha_nacimiento'] ?? '',
                'Direccion_Emp' => $_POST['direccion'] ?? '',
                'Telefono_Emp' => $_POST['telefono'] ?? '',
                'Email_Emp' => $_POST['email'] ?? '',
                'FechaIngreso_Emp' => $_POST['fecha_ingreso'] ?? '',
                'FechaBaja_Emp' => $_POST['fecha_baja'] ?? null,
                'Estado_Emp' => $_POST['estado'] ?? 'Activo',
                'ID_Puesto' => $_POST['id_puesto'] ?? null,
                'ID_Dep' => $_POST['id_dep'] ?? null
            ];

            if ($empleadoModel->crear($datos)) {
                header("Location: index.php?controller=empleado&action=ver");
                exit;
            } else {
                echo "<script>alert('Error al crear el empleado');</script>";
            }
        }

        require_once 'views/Empleados/Crear.php';
    }

    public function ver() {
        $empleados = $this->empleado->obtenerEmpleados();
        require 'Views/Empleados/ver.php';
    }
    
    
}
?>