<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Nómina</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Public/CSS/styleVerEmp.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                    <h1><i class="fas fa-file-invoice-dollar text-primary"></i> Generar Nómina Individual</h1>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Seleccione el empleado y tipo de nómina</h5>
                </div>

                <div class="card-body">
                    <?php if (empty($empleados)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Todos los empleados ya tienen nómina este mes.
                        </div>
                    <?php else: ?>
                        <form action="index.php?controller=nomina&action=generarIndividual" method="POST">
                            <div class="form-group">
                                <label for="ID_Emp">Empleado:</label>
                                <select name="ID_Emp" id="ID_Emp" class="form-control" required>
                                    <option value="">Seleccione un empleado</option>
                                    <?php foreach ($empleados as $emp): ?>
                                        <option value="<?= $emp['ID_Emp'] ?>">
                                            <?= htmlspecialchars($emp['nombre_completo']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tipo_nomina">Tipo de Nómina:</label>
                                <select name="tipo_nomina" id="tipo_nomina" class="form-control" required>
                                    <option value="Mensual">Mensual</option>
                                    <option value="Quincenal">Quincenal</option>
                                    <option value="Semanal">Semanal</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mes">Mes:</label>
                                <select name="mes" id="mes" class="form-control" required>
                                    <?php for ($m = 1; $m <= 12; $m++): ?>
                                        <option value="<?= $m ?>"><?= date('F', mktime(0, 0, 0, $m, 10)) ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="anio">Año:</label>
                                <select name="anio" id="anio" class="form-control" required>
                                    <?php
                                    $anioActual = date('Y');
                                    for ($y = $anioActual; $y >= $anioActual - 25; $y--): ?>
                                        <option value="<?= $y ?>"><?= $y ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-cogs"></i> Generar Nómina
                            </button>
                        </form>
                    <?php endif; ?>
                </div>

                <div class="card-footer text-right">
                    <a href="index.php?controller=nomina&action=ver" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
                
                <div>              
                    <?php if (isset($_GET['error']) && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars(urldecode($_GET['error'])) ?>
                        </div>
                    <?php endif; ?>

                </div>    
 
            </div>
        </div>
    </div>
</body>
</html>
