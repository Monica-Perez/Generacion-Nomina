<?php
require('Config/db.php');

class EmpleadoController {

    private $empleado;
    
    // Inyectamos la dependencia en el constructor del controlador
    public function __construct() {
        $db = db::conectar();
        $this->empleado = new Empleado($db);
    }
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fechaIngreso = $_POST['fecha_ingreso'];
            $fechaBaja = !empty($_POST['fecha_baja']) ? $_POST['fecha_baja'] : $fechaIngreso;
    
            $datos = [
                'pri_nombre'       => $_POST['pri_nombre'],
                'seg_nombre'       => $_POST['seg_nombre'] ?? '',
                'pri_apellido'     => $_POST['pri_apellido'],
                'seg_apellido'     => $_POST['seg_apellido'] ?? '',
                'dpi'              => $_POST['dpi'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
                'direccion'        => $_POST['direccion'] ?? '',
                'telefono'         => $_POST['telefono'] ?? '',
                'email'            => $_POST['email'] ?? '',
                'fecha_ingreso'    => $fechaIngreso,
                'fecha_baja'       => $fechaBaja,
                'estado'           => $_POST['estado'] ?? 'Activo'
            ];
    
            $resultado = $this->empleado->crear($datos);
    
            if ($resultado) {
                header('Location: index.php?controller=empleado&action=ver');
            } else {
                echo "❌ No se insertó ningún empleado. Revisa los campos.";
            }
        } else {
            include 'Views/empleados/crear.php';
        }
    }    
    
    public function ver() {
        $empleados = $this->empleado->obtenerEmpleados();
        extract(['empleados' => $empleados]);
        include 'Views/Empleados/Ver.php';
    }
    
    
}
?>