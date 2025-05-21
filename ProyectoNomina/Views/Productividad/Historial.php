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
            <li><a href="index.php?controller=nomina&action=ver"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
            <li><a href="index.php?controller=productividad&action=ver" class="active"><i class="fas fa-chart-line"></i> Productividad</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="content-container">
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-chart-line text-primary"></i> Productividad Mensual</h1>
                    <p>Resumen de productividad de empleados correspondiente al mes actual</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-table"></i> Tabla de Productividad</h5>
                    <div>
                        <a href="core/exportar_historial.php?id=<?= $_GET['id'] ?>" class="btn btn-success btn-sm mb-3">
                            <i class="fas fa-file-excel"></i> Exportar Excel
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="container mt-4">
                        <h3 class="mb-3">
                            <i class="fas fa-history text-info"></i> Historial de Productividad - <?= htmlspecialchars($historial[0]['nombre_empleado'] ?? '') ?>
                        </h3>

                        <a href="index.php?controller=productividad&action=crear&id=<?= $_GET['id'] ?>" class="btn btn-success mb-3">
                            <i class="fas fa-plus-circle"></i> Generar Productividad
                        </a>

                        <div class="table-responsive">
                            <form method="POST" action="index.php?controller=productividad&action=modificar">
                                <input type="hidden" name="ID_Emp" value="<?= $_GET['id'] ?>">
                                <table class="table table-bordered table-hover" id="tabla-productividad">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Horas Trabajadas</th>
                                            <th>Horas Extras</th>
                                            <th>Horas Descanso</th>
                                            <th>Tiempo Productivo</th>
                                            <th>% Productividad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($historial as $row): ?>
                                            <tr id="fila-<?= $row['ID_Prod'] ?>">
                                                <form method="POST" action="index.php?controller=productividad&action=modificar" class="form-inline">
                                                    <input type="hidden" name="ID_Emp" value="<?= $_GET['id'] ?>">
                                                    <input type="hidden" name="ID_Prod" value="<?= $row['ID_Prod'] ?>">

                                                    <td><?= $row['Mes'] ?></td>
                                                    <td><?= $row['Anio'] ?></td>

                                                    <td>
                                                        <span class="texto"><?= $row['HorasTrabajadas'] ?></span>
                                                        <input type="number" name="HorasTrabajadas" class="form-control form-control-sm d-none" value="<?= $row['HorasTrabajadas'] ?>" step="0.01">
                                                    </td>
                                                    <td>
                                                        <span class="texto"><?= $row['HorasExtras'] ?></span>
                                                        <input type="number" name="HorasExtras" class="form-control form-control-sm d-none" value="<?= $row['HorasExtras'] ?>" step="0.01">
                                                    </td>
                                                    <td>
                                                        <span class="texto"><?= $row['HorasDescanso'] ?></span>
                                                        <input type="number" name="HorasDescanso" class="form-control form-control-sm d-none" value="<?= $row['HorasDescanso'] ?>" step="0.01">
                                                    </td>

                                                    <td><?= $row['TiempoProductivo'] ?></td>
                                                    <td><?= $row['PorcentajeProductividad'] ?>%</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary btn-editar" data-id="<?= $row['ID_Prod'] ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="submit" class="btn btn-sm btn-success btn-guardar d-none" id="guardar-<?= $row['ID_Prod'] ?>">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <a href="index.php?controller=productividad&action=eliminar&id=<?= $row['ID_Prod'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este registro?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </form>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                    <button onclick="window.print()" class="btn btn-info btn-sm mr-2">
                        <i class="fas fa-print"></i> Imprimir
                    </button>
                    <a href="index.php?controller=productividad&action=ver" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-bar"></i> Gráficas de Productividad</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" style="height: 350px; padding: 10px;">
                            <canvas id="graficaBarra"></canvas>
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
    const labels = <?= json_encode(array_map(fn($r) => $r['Mes'] . '/' . $r['Anio'], $historial)) ?>;
    const data = <?= json_encode(array_map(fn($r) => (float)$r['PorcentajeProductividad'], $historial)) ?>;
    </script>
    <script src="Public/JS/ProduHist.js?v=<?= time() ?>"></script>

</body>
</html>