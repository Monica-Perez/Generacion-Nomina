<?php
if (!isset($_GET['controller']) && !isset($_GET['action'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    echo '
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Nómina</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Public/CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body>
        <div class="menu-container">
            <h1>Nómina</h1>
            <div class="menu-box">
                <h2>Menú Principal</h2>
                <ul class="menu-list">
                    <li><a href="index.php?controller=empleado&action=crear">➕ Crear Empleado</a></li>
                    <li><a href="index.php?controller=empleado&action=ver">📄 Ver Empleados</a></li>
                    <li><a href="index.php?controller=empleado&action=editar"> Editar Empleados</a></li>
                    <li><a href="index.php?controller=prestacion&action=ver">💰 Prestaciones</a></li>
                    <li><a href="index.php?controller=vacaciones&action=ver">Vacaciones</a></li>
                    <li><a href="index.php?controller=nomina&action=ver">📅 Nomina</a></li>
                </ul>
            </div>
        </div>
    </body>
    </html>';
    exit;
}


// Lógica MVC original
require_once 'Config/db.php';

require_once 'Models/EmpleadoModelo.php';
require_once 'Models/PrestacionModelo.php';
require_once 'Models/NominaModelo.php';
require_once 'Models/VacacionesModelo.php';

require_once 'Controllers/EmpleadoController.php';
require_once 'Controllers/PrestacionController.php';
require_once 'Controllers/NominaController.php';
require_once 'Controllers/VacacionesController.php';

$controller = $_GET['controller'] ?? 'empleado';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'empleado':
        $controlador = new EmpleadoController();
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada.";
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

    default:
        echo "Controlador no válido.";
        break;
        
}

