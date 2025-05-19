<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacaciones de Empleado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Public/CSS/styleVerEmp.css">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Sistema de Nómina</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="index.php?controller=empleado&action=ver"><i class="fas fa-users"></i> Empleados</a></li>
            <li><a href="index.php?controller=prestacion&action=ver"><i class="fas fa-coins"></i> Prestaciones</a></li>
            <li><a href="index.php?controller=vacaciones&action=ver"><i class="fas fa-file-invoice-dollar"></i> Vacaciones</a></li>
            <li><a href="index.php?controller=nomina&action=ver"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-umbrella-beach text-success"></i> Registrar Vacaciones</h1>
                    <p class="text-muted">Formulario para asignar vacaciones a un empleado</p>
                </div>
                <div class="header-actions">
                    <a href="index.php?controller=vacaciones&action=ver" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Ver Vacaciones
                    </a>
                </div>
            </div>

            <div class="card">
                <?php if (isset($mensaje)): ?>
                    <div class="alert <?php echo strpos($mensaje, '❌') === 0 ? 'alert-danger' : 'alert-success'; ?> m-3">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <form method="POST" action="index.php?controller=vacaciones&action=ingresar">
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-user-tag"></i> Datos del Empleado</h5>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ID_periodo">Periodo Vacaciones <span class="text-danger">*</span></label>
                                        <input type="text" name="ID_periodo" id="ID_periodo" class="form-control" 
                                            value="<?php echo isset($_GET['ID_periodo']) ? htmlspecialchars($_GET['ID_periodo']) : ''; ?>" required readonly>

                                    </div>
                                </div> 
                            </div>
                        </div>

                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-calendar-alt"></i> Fechas de Vacaciones</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FechaInicio">Fecha de Inicio <span class="text-danger">*</span></label>
                                        <input type="date" name="FechaInicio" id="FechaInicio" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FechaFin">Fecha de Fin <span class="text-danger">*</span></label>
                                        <input type="date" name="FechaFin" id="FechaFin" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="DiasTomados">Dias Tomados <span class="text-danger">*</span></label>
                                        <input type="number" name="DiasTomados" id="DiasTomados" class="form-control" min="1" max="15" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Motivo">Motivo <span class="text-danger">*</span></label>
                                        <input type="text" name="Motivo" id="Motivo" class="form-control" min="1" max="15" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar Vacaciones
                            </button>
                            <a href="index.php?controller=vacaciones&action=ver" class="btn btn-outline-secondary ml-2">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .main-content {
            padding: 30px;
        }
    </style>

</body>
</html>
