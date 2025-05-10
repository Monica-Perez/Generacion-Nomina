<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado | Sistema de Nómina</title>
    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- jQuery para la funcionalidad dinámica -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Menú lateral -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Sistema de Nómina</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="index.php?controller=empleado&action=ver" class="active"><i class="fas fa-users"></i> Empleados</a></li>
            <li><a href="index.php?controller=bonificacion&action=crearbon"><i class="fas fa-gift"></i> Bonificaciones</a></li>
            <li><a href="index.php?controller=deduccion&action=index"><i class="fas fa-hand-holding-usd"></i> Deducciones</a></li>
            <li><a href="index.php?controller=nomina&action=index"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
        </ul>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        <div class="content-container">
            <!-- Encabezado -->
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-user-edit text-primary"></i> Editar Empleado</h1>
                    <p class="text-muted">Actualiza la información del empleado</p>
                </div>
                <div class="header-actions">
                    <a href="index.php?controller=empleado&action=ver" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver a la Lista
                    </a>
                </div>
            </div>

            <!-- Tarjeta principal -->
            <div class="card">
                <!-- Si hay mensaje de éxito o error, mostrarlo -->
                <?php if (isset($mensaje)): ?>
                    <div class="alert <?php echo strpos($mensaje, '❌') === 0 ? 'alert-danger' : 'alert-success'; ?> m-3">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <!-- Selector de empleado -->
                    <div class="form-group">
                        <label for="empleado_selector" class="font-weight-bold">Seleccionar Empleado:</label>
                        <select id="empleado_selector" class="form-control form-control-lg" onchange="cargarEmpleado()">
                            <option value="">-- Seleccione un empleado --</option>
                            <?php foreach ($empleados as $emp): ?>
                                <option value="<?php echo $emp['ID_Emp']; ?>" 
                                        <?php echo (isset($empleado) && $empleado['ID_Emp'] == $emp['ID_Emp']) ? 'selected' : ''; ?>>
                                    <?php echo $emp['PriNombre_Emp'] . ' ' . $emp['PriApellido_Emp'] . ' - ' . $emp['DPI_Emp']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-muted">Seleccione un empleado para editar sus datos</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para cargar datos del empleado seleccionado -->
    <script>
        function cargarEmpleado() {
            var empleadoId = document.getElementById('empleado_selector').value;
            
            if (empleadoId) {
                // Redirigir a la página de edición con el ID seleccionado
                window.location.href = 'index.php?controller=empleado&action=editar&id=' + empleadoId;
            } else {
                // Ocultar el formulario si no hay empleado seleccionado
                document.getElementById('formulario_edicion').style.display = 'none';
            }
        }
    </script>

    <style>
        /* Variables CSS */
        :root {
            --primary: #4361ee;
            --secondary: #3f3d56;
            --success: #2ecc71;
            --danger: #e74c3c;
            --light: #f8f9fa;
            --dark: #343a40;
            --gray: #6c757d;
            --sidebar-width: 250px;
        }

        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--secondary);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
        }

        .sidebar-header {
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .sidebar-menu li {
            margin-bottom: 2px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--primary);
        }

        .sidebar-menu i {
            margin-right: 12px;
        }

        /* Contenido principal */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 30px;
            overflow-y: auto;
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Encabezado */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header-title h1 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--secondary);
            display: flex;
            align-items: center;
        }

        .header-title h1 i {
            margin-right: 10px;
        }

        .header-title p {
            margin: 5px 0 0;
            font-size: 0.9rem;
        }

        /* Card */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            background-color: white;
        }

        .card-body {
            padding: 25px;
        }

        /* Secciones del formulario */
        .form-section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .section-title {
            color: var(--primary);
            font-size: 1.1rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 8px;
        }

        /* Campos del formulario */
        .form-group label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 5px;
        }

        /* Selector de empleado destacado */
        #empleado_selector {
            border: 2px solid var(--primary);
            padding: 12px;
            font-size: 1.1rem;
            transition: all 0.3s;
            background-color: #f8f9fa;
        }

        #empleado_selector:focus {
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }

        /* Mensajes */
        .alert {
            border-radius: 5px;
            padding: 15px;
        }

        /* Botones de acción */
        .form-actions {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            margin-top: 25px;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                width: 70px;
            }

            .sidebar-header h3 {
                display: none;
            }

            .sidebar-menu a span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
            }
        }

        @media (max-width: 767.98px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-actions {
                margin-top: 15px;
                align-self: flex-end;
            }

            .row {
                margin-right: -10px;
                margin-left: -10px;
            }

            .col-md-6 {
                padding-right: 10px;
                padding-left: 10px;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</body>
</html>