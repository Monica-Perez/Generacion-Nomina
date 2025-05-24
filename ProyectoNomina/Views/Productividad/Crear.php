<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Productividad</title>
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
        <div class="content-container">
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-plus text-primary"></i> Registrar Productividad</h1>
                    <p>Complete los campos para generar el registro de productividad mensual</p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <?php if (empty($empleados)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Todos los empleados tienen productividad registrada.
                        </div>
                    <?php else: ?>
                        <form action="index.php?controller=productividad&action=registrar" method="POST">
                            <div class="form-group">
                                <label for="ID_Emp">Empleado:</label>
                                <input type="hidden" name="ID_Emp" id="ID_Emp_hidden" value="<?= $idSeleccionado ?? $empleados[0]['ID_Emp'] ?? '' ?>">

                                <select id="ID_Emp_select" class="form-control" <?= isset($idSeleccionado) ? 'disabled' : '' ?> required>
                                    <option value="">Seleccione un empleado</option>
                                    <?php foreach ($empleados as $e): ?>
                                        <option 
                                            value="<?= $e['ID_Emp'] ?>" 
                                            data-ingreso="<?= $e['FechaIngreso_Emp'] ?>"
                                            <?= (isset($idSeleccionado) && $idSeleccionado == $e['ID_Emp']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($e['nombre_completo']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="Mes">Mes:</label>
                                <select name="Mes" class="form-control" required>
                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        echo "<option value='$i'>" . date('F', mktime(0, 0, 0, $i, 10)) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Anio">Año:</label>
                                <input type="number" name="Anio" class="form-control" value="<?= date('Y') ?>" min="2000" required>
                            </div>

                            <div class="form-group">
                                <label for="HorasTrabajadas">Horas Trabajadas:</label>
                                <input type="number" name="HorasTrabajadas" class="form-control" step="0.01" required>
                            </div>

                            <div class="form-group">
                                <label for="HorasExtras">Horas Extras:</label>
                                <input type="number" name="HorasExtras" class="form-control" step="0.01" value="0.00" required>
                            </div>

                            <div class="form-group">
                                <label for="HorasDescanso">Horas Descanso:</label>
                                <input type="number" name="HorasDescanso" class="form-control" step="0.01" value="0.00" required>
                            </div>

                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Productividad</button>
                            <a href="index.php?controller=productividad&action=ver" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                        </form>

                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i>
                                <?= htmlspecialchars($_GET['error']) ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<script src="Public/JS/Productividad.js?v=<?= time() ?>"></script>

</body>
</html>
