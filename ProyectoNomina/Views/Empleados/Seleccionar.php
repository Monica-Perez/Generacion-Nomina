<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Empleado | Sistema de Nómina</title>
    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                    <h1><i class="fas fa-user-edit text-primary"></i> Seleccionar Empleado</h1>
                    <p class="text-muted">Selecciona el empleado que deseas editar</p>
                </div>
                <div class="header-actions">
                    <a href="index.php?controller=empleado&action=ver" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver a la Lista
                    </a>
                </div>
            </div>

            <!-- Tarjeta principal -->
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">Empleados Disponibles</h5>
                        </div>
                        <div class="col-md-6">
                            <!-- Buscador -->
                            <div class="input-group search-box">
                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar empleado...">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if (empty($empleados)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No hay empleados registrados en el sistema.
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($empleados as $empleado): ?>
                                <!-- Tarjeta de empleado -->
                                <div class="col-md-4 mb-4 employee-card">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <!-- Avatar con iniciales -->
                                            <div class="avatar">
                                                <?php 
                                                    $iniciales = strtoupper(substr($empleado['PriNombre_Emp'], 0, 1) . substr($empleado['PriApellido_Emp'], 0, 1));
                                                    echo $iniciales;
                                                ?>
                                            </div>
                                            
                                            <h5 class="mt-3">
                                                <?php echo $empleado['PriNombre_Emp'] . ' ' . $empleado['PriApellido_Emp']; ?>
                                            </h5>
                                            
                                            <p class="badge badge-info"><?php echo $empleado['Nombre_Puesto']; ?></p>
                                            
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-id-card"></i> <?php echo $empleado['DPI_Emp']; ?>
                                            </p>
                                            
                                            <!-- Estado del empleado -->
                                            <p>
                                                <?php if ($empleado['Estado_Emp'] == 'Activo'): ?>
                                                    <span class="badge badge-success">Activo</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Inactivo</span>
                                                <?php endif; ?>
                                            </p>
                                            
                                            <!-- Botón para editar este empleado específico -->
                                            <a href="index.php?controller=empleado&action=editar&id=<?php echo $empleado['ID_Emp']; ?>" 
                                               class="btn btn-primary btn-block mt-3">
                                                <i class="fas fa-edit"></i> Editar Empleado
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para el buscador -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const employeeCards = document.querySelectorAll('.employee-card');
            
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                
                employeeCards.forEach(function(card) {
                    const cardText = card.textContent.toLowerCase();
                    if (cardText.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <style>
        /* Variables CSS */
        :root {
            --primary: #4361ee;
            --secondary: #3f3d56;
            --success: #2ecc71;
            --info: #3498db;
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
            max-width: 1500px;
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

        .card-header {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-header h5 {
            font-weight: 600;
            color: var(--secondary);
        }

        .card-body {
            padding: 20px;
        }

        /* Avatar */
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 600;
            margin: 0 auto;
        }

        /* Badges */
        .badge {
            padding: 5px 10px;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .badge-success {
            background-color: rgba(46, 204, 113, 0.15);
            color: var(--success);
        }

        .badge-danger {
            background-color: rgba(231, 76, 60, 0.15);
            color: var(--danger);
        }

        .badge-info {
            background-color: rgba(52, 152, 219, 0.15);
            color: var(--info);
        }

        /* Búsqueda */
        .search-box {
            max-width: 300px;
            margin-left: auto;
        }

        .search-box .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .search-box .input-group-text {
            background-color: white;
            border-left: none;
        }

        /* Tarjeta de empleado */
        .employee-card .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .employee-card .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
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

            .card-header .row {
                flex-direction: column;
            }

            .card-header .col-md-6:last-child {
                margin-top: 15px;
            }

            .search-box {
                max-width: 100%;
            }

            .col-md-4 {
                max-width: 50%;
            }
        }

        @media (max-width: 575.98px) {
            .col-md-4 {
                max-width: 100%;
            }
        }
    </style>
</body>
</html>