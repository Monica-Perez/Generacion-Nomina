<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado | Sistema de Nómina</title>
    <!-- Recursos CSS -->
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
        <div class="container-fluid">
            <!-- Encabezado -->
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-user-edit text-primary"></i> Editar Empleado</h1>
                    <p class="text-muted">Actualizar información del empleado</p>
                </div>
                <div class="header-actions">
                    <a href="index.php?controller=empleado&action=ver" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver a la Lista
                    </a>
                </div>
            </div>

            <!-- Tarjeta principal -->
            <div class="card">
                <!-- Mostrar mensaje si existe -->
                <?php if (isset($mensaje)): ?>
                    <div class="alert <?php echo strpos($mensaje, '❌') === 0 ? 'alert-danger' : 'alert-success'; ?> m-3">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <!-- Formulario de edición -->
                    <form method="POST" action="index.php?controller=empleado&action=actualizar">
                        <!-- Campo oculto para el ID del empleado -->
                        <input type="hidden" name="id_emp" value="<?php echo $empleado['ID_Emp']; ?>">
                        
                        <!-- Datos personales -->
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-user"></i> Datos Personales</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pri_nombre">Primer Nombre <span class="text-danger">*</span></label>
                                        <input type="text" name="pri_nombre" id="pri_nombre" class="form-control" 
                                               value="<?php echo htmlspecialchars($empleado['PriNombre_Emp']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seg_nombre">Segundo Nombre</label>
                                        <input type="text" name="seg_nombre" id="seg_nombre" class="form-control" 
                                               value="<?php echo htmlspecialchars($empleado['SegNombre_Emp'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pri_apellido">Primer Apellido <span class="text-danger">*</span></label>
                                        <input type="text" name="pri_apellido" id="pri_apellido" class="form-control" 
                                               value="<?php echo htmlspecialchars($empleado['PriApellido_Emp']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seg_apellido">Segundo Apellido</label>
                                        <input type="text" name="seg_apellido" id="seg_apellido" class="form-control" 
                                               value="<?php echo htmlspecialchars($empleado['SegApellido_Emp'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dpi">DPI <span class="text-danger">*</span></label>
                                        <input type="text" name="dpi" id="dpi" class="form-control" 
                                               value="<?php echo htmlspecialchars($empleado['DPI_Emp']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" 
                                               value="<?php echo $empleado['FechaNacimiento_Emp']; ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información de contacto -->
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-address-card"></i> Información de Contacto</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="direccion">Dirección <span class="text-danger">*</span></label>
                                        <input type="text" name="direccion" id="direccion" class="form-control" 
                                               value="<?php echo htmlspecialchars($empleado['Direccion_Emp']); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                                        <input type="text" name="telefono" id="telefono" class="form-control" 
                                               value="<?php echo htmlspecialchars($empleado['Telefono_Emp']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control" 
                                               value="<?php echo htmlspecialchars($empleado['Email_Emp']); ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información laboral -->
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-briefcase"></i> Información Laboral</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_puesto">Puesto <span class="text-danger">*</span></label>
                                        <select name="id_puesto" id="id_puesto" class="form-control" required>
                                            <option value="">Seleccione un puesto</option>
                                            <?php foreach ($puestos as $puesto): ?>
                                                <?php 
                                                // Comparar por nombre de puesto en lugar de ID
                                                $seleccionado = ($puesto['Nombre_Puesto'] == $empleado['Nombre_Puesto']) ? 'selected="selected"' : '';
                                                ?>
                                                <option value="<?php echo $puesto['ID_Puesto']; ?>" <?php echo $seleccionado; ?>>
                                                    <?php echo htmlspecialchars($puesto['Nombre_Puesto']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_ingreso">Fecha de Ingreso <span class="text-danger">*</span></label>
                                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" 
                                               value="<?php echo $empleado['FechaIngreso_Emp']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_baja">Fecha de Baja</label>
                                        <input type="date" name="fecha_baja" id="fecha_baja" class="form-control" 
                                               value="<?php echo $empleado['FechaBaja_Emp'] ?: ''; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="estado">Estado <span class="text-danger">*</span></label>
                                        <select name="estado" id="estado" class="form-control" required>
                                            <option value="Activo" <?php echo ($empleado['Estado_Emp'] == 'Activo') ? 'selected' : ''; ?>>Activo</option>
                                            <option value="Baja" <?php echo ($empleado['Estado_Emp'] == 'Baja') ? 'selected' : ''; ?>>Baja</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                            <a href="index.php?controller=empleado&action=ver" class="btn btn-outline-secondary ml-2">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

        /* Menú lateral */
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

        /* Tarjeta */
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

        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 8px 12px;
            height: auto;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }

        /* Mensajes de error y ayuda */
        .text-danger {
            color: var(--danger) !important;
        }

        .form-text {
            font-size: 0.8rem;
        }

        /* Botones de acción */
        .form-actions {
            margin-top: 25px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: #3651d3;
            border-color: #3651d3;
        }

        .btn-outline-secondary {
            color: var(--gray);
            border-color: var(--gray);
        }

        .btn-outline-secondary:hover {
            background-color: var(--gray);
            color: white;
        }

        /* Alertas */
        .alert {
            border-radius: 5px;
            padding: 15px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        /* Estilos responsivos */
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
        }
    </style>
</body>
</html>