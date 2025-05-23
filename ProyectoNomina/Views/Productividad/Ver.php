<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productividad General</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Public/CSS/styleVerEmp.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <h1><i class="fas fa-chart-line text-primary"></i> Productividad Mensual</h1>
                    <p class="text-muted">Resumen de productividad de empleados Ultimo Registro</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-table"></i> Tabla de Productividad</h5>

                    <div class="search-box mr-3">
                         <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Buscar empleado...">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="index.php?controller=productividad&action=crear" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle"></i> Generar Productividad
                        </a>
                        <a href="core/exportar_productividad.php" class="btn btn-success btn-sm">
                            <i class="fas fa-file-excel"></i> Exportar Excel
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <?php if (empty($productividad)): ?>
                        <div class="alert alert-info m-3">
                            <i class="fas fa-info-circle"></i> No hay registros de productividad para este mes.
                        </div>
                    <?php else: ?>
                        <div class="table-container">
                            <table class="table table-bordered table-hover" id="productividadTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Empleado</th>
                                        <th>Mes</th>
                                        <th>Año</th>
                                        <th>Horas Trabajadas</th>
                                        <th>Horas Extras</th>
                                        <th>Horas Descanso</th>
                                        <th>Tiempo Productivo</th>
                                        <th>% Productividad</th>
                                        <th>Historial</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($productividad as $p): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($p['nombre_empleado']) ?></td>
                                            <td><?= isset($p['Mes']) ? $p['Mes'] : '<span class="badge badge-secondary">No registrado</span>' ?></td>
                                            <td><?= isset($p['Anio']) ? $p['Anio'] : '<span class="badge badge-secondary">No registrado</span>' ?></td>
                                            <td><?= isset($p['HorasTrabajadas']) ? $p['HorasTrabajadas'] . ' hrs' : '<span class="badge badge-secondary">—</span>' ?></td>
                                            <td><?= isset($p['HorasExtras']) ? $p['HorasExtras'] . ' hrs' : '<span class="badge badge-secondary">—</span>' ?></td>
                                            <td><?= isset($p['HorasDescanso']) ? $p['HorasDescanso'] . ' hrs' : '<span class="badge badge-secondary">—</span>' ?></td>
                                            <td>
                                                <?= isset($p['TiempoProductivo']) ? 
                                                    $p['TiempoProductivo'] . ' hrs' : 
                                                    '<span class="badge badge-warning"><i class="fas fa-exclamation-circle"></i> No registrado</span>' ?>
                                            </td>
                                            <td>
                                                <?= isset($p['PorcentajeProductividad']) ? 
                                                    $p['PorcentajeProductividad'] . '%' : 
                                                    '<span class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i> No registrado</span>' ?>
                                            </td>
                                            <td>
                                                <a href="index.php?controller=productividad&action=historial&id=<?= $p['ID_Emp'] ?>" 
                                                class="btn btn-sm btn-info" title="Ver historial">
                                                    <i class="fas fa-history"></i> Ver
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-bar"></i> Gráficas de Productividad</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" style="height: 350px; padding: 10px;">
                            <canvas id="graficaBarras"></canvas>
                        </div>
                        <div class="col-md-6" style="height: 350px; padding: 10px;">
                            <canvas id="graficaPastel"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const graficaLabels = <?= json_encode($labels) ?>;
    const graficaDatos = <?= json_encode($porcentajes) ?>;
    </script>

</body>

<script src="Public/JS/Productividad.js?v=<?= time() ?>"></script>

</html>