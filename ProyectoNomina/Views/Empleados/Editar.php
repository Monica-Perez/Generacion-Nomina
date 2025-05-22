<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
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
            <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="index.php?controller=empleado&action=ver" class="active"><i class="fas fa-users"></i> Empleados</a></li>
            <li><a href="index.php?controller=prestacion&action=ver"><i class="fas fa-coins"></i> Prestaciones</a></li>
            <li><a href="index.php?controller=indemnizacion&action=ver"><i class="fas fa-money-check"></i> Indemnización</a></li>
            <li><a href="index.php?controller=nomina&action=ver"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
            <li><a href="index.php?controller=productividad&action=ver"><i class="fas fa-chart-line"></i> Productividad</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="content-container">
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-user-edit text-primary"></i> Editar Empleado</h1>
                    <p class="text-muted">Actualizar información del empleado</p>
                </div>
            </div>

            <div class="card">
                <?php if (isset($mensaje)): ?>
                    <div class="alert <?php echo strpos($mensaje, '❌') === 0 ? 'alert-danger' : 'alert-success'; ?> m-3">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <form method="POST" action="index.php?controller=empleado&action=actualizar">
                        <input type="hidden" name="id_emp" value="<?php echo $empleado['ID_Emp']; ?>">
                        
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

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                            <a href="index.php?controller=empleado&action=ver" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>