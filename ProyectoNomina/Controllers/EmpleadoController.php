<?php
require_once __DIR__ . '/../Models/EmpleadoModelo.php';

class EmpleadoController {

    private $empleado;
    
    public function __construct() {
        $this->empleado = new EmpleadoModelo(db::conectar());
    }

    public function ver() {
        $empleados = $this->empleado->ver();
        extract(['empleados' => $empleados]);
        include 'Views/Empleados/Ver.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                'fecha_ingreso'    => $_POST['fecha_ingreso'],
                'fecha_baja'       => !empty($_POST['fecha_baja']) ? $_POST['fecha_baja'] : null,
                'estado'           => $_POST['estado'] ?? 'Activo',
                'id_puesto'        => $_POST['id_puesto']
            ];
    
            $resultado = $this->empleado->crear($datos);

            if ($resultado) {
                header('Location: index.php?controller=empleado&action=ver');
                exit;
            } else {
                echo "No se insertó ningún empleado. Revisa los campos.";
            }
        } else {
            $puestos = $this->empleado->obtenerPuestos();
            include 'Views/Empleados/Crear.php';
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id_emp'];
            $datos = [
                'pri_nombre'       => $_POST['pri_nombre'],
                'seg_nombre'       => $_POST['seg_nombre'] ?? '',
                'pri_apellido'     => $_POST['pri_apellido'],
                'seg_apellido'     => $_POST['seg_apellido'] ?? '',
                'dpi'              => $_POST['dpi'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                'direccion'        => $_POST['direccion'] ?? '',
                'telefono'         => $_POST['telefono'] ?? '',
                'email'            => $_POST['email'] ?? '',
                'fecha_ingreso'    => $_POST['fecha_ingreso'],
                'fecha_baja' => ($_POST['estado'] === 'Baja' && !empty($_POST['fecha_baja'])) ? $_POST['fecha_baja'] : null,
                'estado'           => $_POST['estado'] ?? 'Activo',
                'id_puesto'        => $_POST['id_puesto']
            ];
            
            $resultado = $this->empleado->actualizar($id, $datos);
            $mensaje = $resultado ? "Empleado actualizado correctamente." : "Error al actualizar el empleado.";

            $empleado = $this->empleado->obtenerEmpleadoPorId($id);
            $puestos = $this->empleado->obtenerPuestos();

            include 'Views/Empleados/Editar.php';
        } else {
            header('Location: index.php?controller=empleado&action=ver');
            exit;
        }
    }

    public function editar() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=empleado&action=ver');
            exit;
        }
        
        $id = (int)$_GET['id'];
        $empleado = $this->empleado->obtenerEmpleadoPorId($id);
        
        if (!$empleado) {
            $_SESSION['mensaje'] = "El empleado no existe.";
            header('Location: index.php?controller=empleado&action=ver');
            exit;
        }

        $puestos = $this->empleado->obtenerPuestos();

        include 'Views/Empleados/Editar.php';
    }
}