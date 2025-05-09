<?php
if (!isset($_GET['controller']) && !isset($_GET['action'])) {
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
                    <li><a href="index.php?controller=bonificacion&action=verBonificaciones">💰 Bonificaciones</a></li>
                    <li><a href="index.php?controller=deduccion&action=index">📉 Deducciones</a></li>
                    <li><a href="index.php?controller=nomina&action=index">📅 Nomina</a></li>
                </ul>
            </div>
        </div>
    </body>
    </html>';
    exit;
}

// Lógica MVC original
require_once 'Controllers/EmpleadoController.php';
require_once 'Models/EmpleadoModelo.php';
require_once 'Config/db.php';
require_once 'Controllers/BonificacionController.php';
require_once 'Models/BonificacionModelo.php';  // Incluye el modelo para bonificaciones

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

    case 'bonificacion':
        $controlador = new BonificacionController();  // Instancia el controlador de Bonificaciones
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Bonificaciones.";
        }
        break;
        /*
    case 'deduccion':
        $controlador = new DeduccionController();  // Instancia el controlador de Deducciones
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Deducciones.";
        }
        break;

    case 'nomina':
        $controlador = new NominaController();  // Instancia el controlador de Nómina
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción no encontrada en Nómina.";
        }
        break;
        */

    default:
        echo "Controlador no válido.";
        break;
}
?>


