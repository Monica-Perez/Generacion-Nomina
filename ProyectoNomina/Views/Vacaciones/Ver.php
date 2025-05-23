<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacaciones por Empleado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Public/CSS/styleVer.css">
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
                    <h1><i class="fas fa-umbrella-beach text-primary"></i> Vacaciones</h1>
                    <p class="text-muted">Periodos de Vacaciones por Empleado</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-umbrella-beach text-primary"></i> Vacaciones por Empleado</h5>
                    <div class="search-box">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Buscar periodo...">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <?php if (empty($vacaciones)): ?>
                        <div class="alert alert-info m-3">
                            <i class="fas fa-info-circle"></i> No hay vacaciones registradas en el sistema.
                        </div>
                    <?php else: ?>
                        <div class="table-container">
                            <table class="table table-bordered table-hover" id="employeeTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Empleado</th>
                                        <th>Nombre</th>
                                        <th>Periodo Inicial</th>
                                        <th>Periodo Final</th>
                                        <th>Días Laborados</th>
                                        <th>Días por Periodo</th>
                                        <th>Días Tomados</th>
                                        <th>Días Pendientes</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vacaciones as $vac): ?>
                                        <tr>
                                            <td><?= $vac['ID']; ?></td>
                                            <td><?= $vac['ID_Emp']; ?></td>
                                            <td><?= $vac['Nombre']; ?></td>
                                            <td><?= date('d/m/Y', strtotime($vac['PeriodoInicial'])); ?></td>
                                            <td><?= date('d/m/Y', strtotime($vac['PeriodoFinal'])); ?></td>
                                            <td><?= number_format($vac['DiasLaborados'], 0); ?></td>
                                            <td><?= number_format($vac['CantDias'], 0); ?></td>
                                            <td><?= number_format($vac['DiasTomados'], 0); ?></td>
                                            <td><?= number_format($vac['DiasPendientes'], 0); ?></td>
                                            <td>
                                                <a href="index.php?controller=vacaciones&action=Ingresar&ID_periodo=<?= $vac['ID']; ?>&ID_Emp=<?= $vac['ID_Emp']; ?>&Nombre=<?= $vac['Nombre']; ?>" 
                                                class="btn btn-sm btn-success mb-1" title="Registrar Vacaciones">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-info btn-sm mr-2" onclick="window.print()" title="Imprimir tabla">
                            <i class="fas fa-print"></i> Imprimir
                        </button>
                        <a href="index.php?controller=prestacion&action=ver" class="btn btn-secondary btn-sm" title="Volver a prestaciones">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#employeeTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</body>
</html>