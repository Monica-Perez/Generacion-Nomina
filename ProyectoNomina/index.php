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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="Public/CSS/styleVer.css">
    </head>
    <body>
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>Sistema de Nómina</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="index.php"  class="active"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="index.php?controller=empleado&action=ver"><i class="fas fa-users"></i> Empleados</a></li>
                <li><a href="index.php?controller=prestacion&action=ver"><i class="fas fa-coins"></i> Prestaciones</a></li>
                <li><a href="index.php?controller=indemnizacion&action=ver"><i class="fas fa-money-check"></i> Indemnización</a></li>
                <li><a href="index.php?controller=nomina&action=ver"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
            <li><a href="index.php?controller=productividad&action=ver"><i class="fas fa-chart-line"></i> Productividad</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div class="content-container">
                <div class="card">
                    <div class="header">
                        <div class="header-title">
                            <h1><i class="fas fa-folder-open text-primary"></i> Recursos Humanos</h1>
                        </div>
                    </div>
                    <img src="Public/IMG/rrhh3.jpg" alt="RRHH" class="imagen-rrhh">
                </div>
            </div>
        </div>
        
        <style>
            .main-content {
                flex: 1;
                margin-left: var(--sidebar-width);
                height: 100vh;
                overflow-y: auto;
            }
            .content-container {
                padding: 30px;
                max-width: 1800px;
                height: 100vh;
                margin: 0 auto;
            }
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 40px;
                margin-left: 60px;
                margin-bottom: 10px;
            }
            .header-title h1 {
                margin: 1;
                font-size: 3.5rem;
                color: var(--secondary);
                display: flex;
                align-items: center;
            }
            .imagen-rrhh {
                max-width: 800px;
                width: 45%;
                height: auto;
                margin-left: 30rem;
            } 
        </style>
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
require_once 'Models/IndemnizacionModelo.php';
require_once 'Models/ProductividadModelo.php';

require_once 'Controllers/EmpleadoController.php';
require_once 'Controllers/PrestacionController.php';
require_once 'Controllers/NominaController.php';
require_once 'Controllers/VacacionesController.php';
require_once 'Controllers/IndemnizacionController.php';
require_once 'Controllers/ProductividadController.php';

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

