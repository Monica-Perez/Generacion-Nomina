<?php
require_once 'Config/db.php';  // Cambia require a require_once

class EmpleadoController {

    private $empleado;
    
    // Inyectamos la dependencia en el constructor del controlador
    public function __construct() {
        $db = db::conectar();
        $this->empleado = new Empleado($db);
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
            $conn = db::conectar();
            $puestos = [];

            $stmt = $conn->prepare("CALL spObtenerPuestos()");
            $stmt->execute();
            $puestos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            include 'Views/empleados/crear.php';
        }
    }

    public function ver() {
        $empleados = $this->empleado->obtenerEmpleados();
        extract(['empleados' => $empleados]);
        include 'Views/Empleados/Ver.php';
    }

    public function editar() {
        $puestos = $this->empleado->obtenerPuestos();
        
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
        
        $conn = db::conectar();
        $puestos = [];

        $stmt = $conn->prepare("CALL spObtenerPuestos()");
        $stmt->execute();
        $puestos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'Views/Empleados/Editar.php';
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
                'fecha_baja'       => !empty($_POST['fecha_baja']) ? $_POST['fecha_baja'] : null,
                'estado'           => $_POST['estado'] ?? 'Activo',
                'id_puesto'        => $_POST['id_puesto']
            ];
            
            $resultado = $this->empleado->actualizar($id, $datos);
            
            // Preparar mensaje de resultado
            if ($resultado) {
                $mensaje = "Empleado actualizado correctamente.";
            } else {
                $mensaje = "Error al actualizar el empleado. Por favor, revise los datos e intente nuevamente.";
            }
            
            // Obtener datos actualizados del empleado
            $empleado = $this->empleado->obtenerEmpleadoPorId($id);
            
            $puestos = $this->empleado->obtenerPuestos();
            
            // Cargar la vista con los datos actualizados
            include 'Views/Empleados/Editar.php';
        } else {
            // Si alguien intenta acceder directamente a esta acción sin enviar el formulario
            header('Location: index.php?controller=empleado&action=ver');
            exit;
        }
    }

}
?>