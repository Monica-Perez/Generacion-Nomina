<?php
session_start();

$controller = $_GET['controller'] ?? 'login';
$action = $_GET['action'] ?? 'login';

$accionesPublicas = ['login', 'restaurar', 'preguntas'];

if (!isset($_SESSION['ID_Usuario']) &&
    !($controller === 'login' && in_array($action, $accionesPublicas))) {
    header("Location: index.php?controller=login&action=login");
    exit;
}

$controller = $_GET['controller'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

require_once 'Config/db.php';

require_once 'Models/LoginModelo.php';
require_once 'Models/EmpleadoModelo.php';
require_once 'Models/UsuarioModelo.php';
require_once 'Models/PrestacionModelo.php';
require_once 'Models/NominaModelo.php';
require_once 'Models/VacacionesModelo.php';
require_once 'Models/IndemnizacionModelo.php';
require_once 'Models/ProductividadModelo.php';

require_once 'Controllers/DashboardController.php';
require_once 'Controllers/LoginController.php';
require_once 'Controllers/EmpleadoController.php';
require_once 'Controllers/UsuarioController.php';
require_once 'Controllers/PrestacionController.php';
require_once 'Controllers/NominaController.php';
require_once 'Controllers/VacacionesController.php';
require_once 'Controllers/IndemnizacionController.php';
require_once 'Controllers/ProductividadController.php';

switch ($controller) {
    case 'dashboard':
        $controlador = new DashboardController();
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Dashboard.";
        }
        break;
    case 'login':
        $controlador = new LoginController();
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Login.";
        }
        break;
    case 'empleado':
        $controlador = new EmpleadoController();
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada.";
        }
        break;
    case 'usuario':
        $controlador = new UsuarioController();
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Usuarios.";
        }
        break;
    case 'prestacion':
        $controlador = new PrestacionController(); 
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Prestaciones.";
        }
        break;
    case 'nomina':
        $controlador = new NominaController();
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Nómina.";
        }
        break;
    case 'vacaciones':
        $controlador = new VacacionesController();
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Vacaciones.";
        }
        break;
    case 'indemnizacion':
        $controlador = new IndemnizacionController();
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Indemnizacion.";
        }
        break;

    case 'productividad':
        $controlador = new ProductividadController();
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Productividad.";
        }
        break;

    default:
        echo "Controlador no válido.";
        break;
        
}

