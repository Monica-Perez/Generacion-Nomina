<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indemnizaciones </title>
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
            <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="index.php?controller=empleado&action=ver"><i class="fas fa-users"></i> Empleados</a></li>
            <li><a href="index.php?controller=prestacion&action=ver"><i class="fas fa-coins"></i> Prestaciones</a></li>
            <li><a href="index.php?controller=indemnizacion&action=ver" class="active"><i class="fas fa-money-check"></i> Indemnización</a></li>
            <li><a href="index.php?controller=nomina&action=ver"><i class="fas fa-file-invoice-dollar"></i> Nómina</a></li>
            <li><a href="index.php?controller=productividad&action=ver"><i class="fas fa-chart-line"></i> Productividad</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="content-container">
            <div class="header">
                <div class="header-title">
                    <h1><i class="fas fa-coins text-primary"></i> Indemnizaciones </h1>
                    <p class="text-muted">Indemnizaciones de los empleados dados de Baja</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">Indemnizaciones por Empleados</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group search-box">
                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar empleado...">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="card-body p-0">
                    <?php if (empty($indemnizaciones)): ?>
                        <div class="alert alert-info m-3">
                            <i class="fas fa-info-circle"></i> No hay indemnizaciones registradas en el sistema.
                        </div>
                    <?php else: ?>
                        <div class="table-container">
                            <table class="table table-striped table-hover" id="employeeTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Fecha Ingreso</th>
                                        <th>Fecha Baja</th>
                                        <th>Salario Base</th>
                                        <th>Bono 14</th>
                                        <th>Aguinaldo</th>
                                        <th>Indemnización</th>
                                        <th>Vacaciones sin Gozar</th>
                                        <th>Pago de Vacaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($indemnizaciones as $indem): ?>
                                        <tr>
                                            <td><?php echo $indem['ID_Emp'];?></td>
                                            <td><?php echo $indem['Nombre']; ?></td>
                                            <td><span class="badge badge-danger"><?php echo $indem['Estado']; ?></span></td>
                                            <td><?php echo date('d/m/Y', strtotime($indem['Ingreso'])); ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($indem['Baja'])); ?></td>
                                            <td>Q<?php echo number_format($indem['SalarioBase'], 0, '.', ','); ?></td>
                                            <td>Q<?php echo number_format($indem['Bono14'], 2, '.', ','); ?></td>
                                            <td>Q<?php echo number_format($indem['Aguinaldo'], 2, '.', ','); ?></td>
                                            <td>Q<?php echo number_format($indem['Indemnizacion'], 2, '.', ','); ?></td>
                                            <td><?php echo $indem['DiasPendientesV']; ?></td>
                                            <td>Q<?php echo number_format($indem['PagoVacaciones'], 2, '.', ','); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-footer bg-white">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="btn btn-info btn-sm mr-2" onclick="window.print()">
                                <i class="fas fa-print"></i> Imprimir
                            </button>
                            <a href="index.php" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
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