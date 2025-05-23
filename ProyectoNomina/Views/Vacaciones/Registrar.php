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
            <li><a href="index.php"  class="active"><i class="fas fa-home"></i> Inicio</a></li>
            <?php if ($_SESSION['Rol'] === 'admin'): ?>
                <li><a href="index.php?controller=empleado&action=ver"><i class="fas fa-users"></i> Empleados</a></li>
                <li><a href="index.php?controller=usuario&action=ver"><i class="fas fa-user-shield"></i> Usuarios</a></li>
            <?php endif; ?>
            <li><a href="index.php?controller=prestacion&action=ver"><i class="fas fa-coins"></i> Prestaciones</a></li>
            <li><a href="index.php?controller=indemnizacion&action=ver"><i class="fas fa-money-check"></i> Indemnización</a></li>
            <li><a href="index.php?controller=nomina&action=ver"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
        <li><a href="index.php?controller=productividad&action=ver"><i class="fas fa-chart-line"></i> Productividad</a></li>
        <li><a href="index.php?controller=login&action=logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-umbrella-beach text-primary"></i> Registrar Vacaciones</h1>
                    <p class="text-muted">Formulario para asignar vacaciones a un empleado</p>
                </div>
            </div>

            <div class="card">
                <?php if (isset($vacaciones['DiasPendientes']) && $vacaciones['DiasPendientes'] == 0): ?>
                    <div class="alert alert-info m-3">
                        <i class="fas fa-info-circle"></i> Todas las vacaciones de este periodo han sido gozadas.
                    </div>
                <?php else: ?>

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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ID_Emp">Empleado <span class="text-danger">*</span></label>
                                        <input type="text" name="ID_Emp" id="ID_Emp" class="form-control" 
                                            value="<?php echo isset($_GET['ID_Emp']) ? htmlspecialchars($_GET['ID_Emp']) : ''; ?>" required readonly>
                                            <small class="form-text text-muted">Empleado: <?= htmlspecialchars($_GET['Nombre']) ?></small>
                                    </div>
                                </div> 

                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Nombre">Empleado <span class="text-danger">*</span></label>
                                        <input type="text" name="Nombre" id="Nombre" class="form-control" 
                                            value="<?php echo isset($_GET['Nombre']) ? htmlspecialchars($_GET['Nombre']) : ''; ?>" required readonly>
                                    </div>
                                </div>  -->

                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ID_emp">Empleado <span class="text-danger">*</span></label>
                                        <select name="ID_Emp" required class="form-control">
                                            <option value="">Seleccione un empleado</option>
                                            <?php foreach ($empleados as $empleado): ?>
                                                <option value="<?= htmlspecialchars($empleado['ID_Emp']) ?>">
                                                    <?= htmlspecialchars($empleado['PriNombre_Emp']. ' ' .$empleado['PriApellido_Emp']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select><br><br>
                                    </div>
                                </div>  -->

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
                                        <input type="number" name="DiasTomados" id="DiasTomados" class="form-control" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Motivo">Motivo <span class="text-danger">*</span></label>
                                        <input type="text" name="Motivo" id="Motivo" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endif; ?>

                        <div class="form-actions">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Guardar Vacaciones
                                </button>
                                <a href="index.php?controller=prestacion&action=ver" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                            </div>
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fechaInicio = document.getElementById("FechaInicio");
            const fechaFin = document.getElementById("FechaFin");
            const diasTomados = document.getElementById("DiasTomados");

            function calcularDias() {
                const inicio = new Date(fechaInicio.value);
                const fin = new Date(fechaFin.value);

                if (fechaInicio.value && fechaFin.value && fin >= inicio) {
                    const diferenciaMs = fin - inicio;
                    const diferenciaDias = Math.floor(diferenciaMs / (1000 * 60 * 60 * 24)) + 1; // Convertir un dia a milisegundos y +1 para contar los extremos
                    diasTomados.value = diferenciaDias;
                } else {
                    diasTomados.value = '';
                }
            }

            fechaInicio.addEventListener("change", calcularDias);
            fechaFin.addEventListener("change", calcularDias);
        });
    </script>


</body>
</html>